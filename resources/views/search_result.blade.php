

<!DOCTYPE html>
<html lang="en">

  @include('bootstrap')

<body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')

    </div>
    <div class="col-sm-8 text-left">
      @if(sizeof($users)==0) <p>Nessun Utente Trovato </p>@endif
      @foreach ($users as $user)
        <?php $userInfo = DB::table('users')->where('id',$user)->first() ?>
        <?php $followed = DB::table('friendships')->where('user_id',$user)->where('user_follow',session('id'))->first()?>
        <table class="tables" width="50%" border="0">
        <tr>
          <td>
              <p><img src="/profile_images/{{$userInfo->user_image}}" style="width:56px;height:56px;"></p>
              @if($followed == null && $user != session('id'))<button type="button" onClick="location.href='follow?to_id={{$user}}'" class="btn btn-primary active">Segui</button>
              @elseif($followed != null && $user != session('id'))<button type="button" class="btn btn-primary disabled">Segui già</button>@endif
          </td>
          <td>
              <p>{{$userInfo->name}} {{$userInfo->second_name}} {{$userInfo->last_name}}</p>
              <p>{{$userInfo->affiliation}}</p>
              <button class="btn btn-primary" onClick="location.href='userprofile?id={{$user}}'">User Profile</button></br></br>
          </td>
        </tr>
        </table>
      @endforeach

      <div class="riga">
        <hr>
        <h3></h3>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
      </div>

      @if(sizeof($groups)==0) <p>Nessun Gruppo Trovato </p>@endif
      @foreach ($groups as $group)
          <?php $groupInfo = DB::table('groups')->where('id',$group)->first() ?>
          <?php $partecipation = DB::table('partecipations')->where('user_id',session('id'))->where('group_id',$group)->first()?>
          <table class="tables" width="50%" border="0">
          <tr>
            <td>
                <p><img src="/profile_images/{{$groupInfo->group_image}}" style="width:56px;height:56px;"></p>
              @if ($partecipation == null)  <button type="button" class="btn btn-primary active">Iscriviti</button>
              @else  <button type="button" class="btn btn-primary disabled">Già iscritto</button>@endif
            </td>
            <td>
                <p>{{$groupInfo->group_name}}</p>
                <p>{{$groupInfo->group_description}}</p>
                <button class="btn btn-primary" onClick="location.href=''">Vai al gruppo</button></br></br> <!--TODO-->
            </td>
            </tr>
          </table>
     @endforeach

      <div class="riga">
        <hr>
        <h3></h3>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
      </div>

      @if(sizeof($publications)==0) <p>Nessuna Pubblicazione Trovate
       </p>@endif
      @foreach($publications as $publication)
      <!--Dati della Pubblicazione-->
        <?php $publicationInfo = DB::table('publications')->where('id',$publication)->first() ?>

      <!--Coautori-->
        <?php $authors = DB::table('publications')->join('users_publications','publication_id','=','publications.id')->join('users','users.id','=','user_id')->where('visibility',0)->get()?>

        @foreach($authors as $author)

        <!--Allegati  -->
          <?php $attachments = DB::table('attachments_publications')->select('*')->where('publication_id',$publication)->get(); ?>
       <!--Tags -->
          <?php $tags = DB::table('publications_tag')->select('value')->where('publications_id',$publication)->get(); ?>
       <!--Topic -->
          <?php $topic = DB::table('publications')->join('topics','topics_id','=','topics.id')->select('topic_name')->where('publications.id',$publication)->first(); ?>


          <table class="tables" width="50%" border="0">
            <tr>
              <td>
                  <p><img src="/profile_images/{{$author->user_image}}" style="width:56px;height:56px;">{{$author->name}} {{$author->second_name}} {{$author->last_name}}</p>
              </td>
            </tr>
           <tr>

              <td>
                <p>{{$publicationInfo->title}}</p>
            </td>
          </tr>
                <tr>
            <td>
              <!--Data Pubblicazione -->
            <p>{{$publicationInfo->year}}</p>
            </td>
          </tr>

          <tr>
            <td>
              <!--Dati della Pubblicazione  -->
            <p> {{$publicationInfo->title}}
                <br> {{$publicationInfo->type}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                Published on: {{$publicationInfo->venue}} <br>
                @if(isset($publicationInfo->volume))Volume:{{$publicationInfo->volume}}@endif
                @if(isset($publicationInfo->number)), Number: {{$publicationInfo->number}} ,@endif
                @if(isset($publicationInfo->pages))Pages: {{$publicationInfo->pages}}</p>@endif
            <!--Allegati  -->
            <p><?php if(sizeof($attachments)!=0) echo "Allegati: " ?> @foreach($attachments as $attachment)
                  <a href={{$attachment->namefile}}> {{$attachment->typefile}} </a>
              @endforeach
            </p>
            <!--Tags-->
            <p><?php if(sizeof($tags)!=0) echo "Tag: " ?> @foreach($tags as $tag)
                <!--TODO visualizzazione tag-->
                #{{$tag->value}}
              @endforeach
            </p>
            </td>
          </tr>
          <tr>
            <td>
            <input class="Commenti" placeholder="Commenta" id="comment">
            </td>
        </tr>
          </table>
          @endforeach
      @endforeach

    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">User profile</button>
      </div>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    <p>@Copyright Team Corman</p>
    </div>
  </div>
  </div>
 </body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>
