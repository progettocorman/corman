<?php



  $group_id = $_GET['group_id'];
  $iduser = session('id');

  $controlloiscrizione = \DB::table('partecipations')->select('user_id', 'group_id', 'is_amministrator')
                      ->where('group_id', $group_id)
                      ->where('user_id', $iduser)
                      ->first();
$flag = 0;
$subscribed = 0;
  if(sizeof((array)$controlloiscrizione)!=0){
    $flag = 1;
    $subscribed = 1;
  }
  else {
    $controlloiscrizione = \DB::table('groups')->select('id', 'group_public')
                        ->where('id', $group_id)
                        ->first();
      if($controlloiscrizione->group_public==1){
        $flag = 1;
      }
  }
  $isadmin=0;
  if($controlloiscrizione->is_amministrator==1){
    $isadmin = 1;
  }

  $partecipants = \DB::table('partecipations')->where('group_id',$group_id)->get();
  //per pubblicazioni nel gruppo
  $sharepublications = \DB::table('condivision_publications')->select('publication_id')
    ->join('publications','condivision_publications.publication_id', '=','publications.id')
    ->join('users_publications','publications.id','=', 'users_publications.publication_id')
    ->join('users','users.id','=', 'users_publications.user_id')
    ->select('users_publications.publication_id','users_publications.visibility',
           'users.name','users.second_name', 'users.last_name','users.user_image',
           'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year', 'publications.type','publications.created_at')
    ->where('group_id', $group_id)->where('users_publications.visibility',0)->orWhere('group_id', $group_id)->where('users_publications.visibility',1)->orderBy('publications.created_at','desc')->distinct();

  $resultpublications = $sharepublications->get();



  //per post nel gruppo
  $shareposts = \DB::table('condivision_posts')->select('post_id as posts_id', 'users_posts.visibility','users.name','users.second_name', 'users.last_name','users.user_image','posts.text','posts.created_at')
                ->join('posts','condivision_posts.post_id', '=','posts.id')
                ->join('users_posts', 'users_posts.user_id', '=', 'condivision_posts.user_id')
                ->join('users','users_posts.user_id', '=','users.id')
                ->where('group_id', $group_id)->where('users_posts.visibility',0)->orWhere('group_id', $group_id)->where('users_posts.visibility',1)->orderBy('posts.created_at','desc')
                ->distinct();
  $resultposts = $shareposts->get();


 $results = array();
  $i = 0;
  foreach ($resultpublications as $publication) {
    $results[$i] = $publication;
    $i++;
  }
  foreach ($resultposts as $post) {
    $results[$i] = $post;
    $i++;
  }
 ?>

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

       <link rel="stylesheet" href="css/navbar_profile.css" type="text/css" />
        <div class="riga">

          <hr>
          <h3></h3>
          <p></p>
          <p></p>
          <p></p>
          <p></p>
        </div>
        <div class="box">
                @include('information_group')
          <div class="box-inner">
          @if($subscribed==1)
            @include('insert_post_group')
          @endif
          @if($flag == 1)
            @foreach ($results as $result)

              @if (isset($result->posts_id))
                <!--Allegati  -->
                  <?php $attachments = DB::table('attachments_posts')->select('*')->where('posts_id',$result->posts_id)->get(); ?>
               <!--Tags -->
                  <?php $tags = DB::table('posts_tags')->select('value')->where('posts_id',$result->posts_id)->get(); ?>

                  <div class="riga">
                    <hr>
                    <h3></h3>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                  </div>

                <table class="tables" width="50%" border="0">
                <tr>
                  <td>
                      <p><img src="/profile_images/{{$result->user_image}}"style="width:25%; height:25%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px;">
                        &nbsp;&nbsp;{{$result->name}} {{$result->second_name}} {{$result->last_name}}</p>
                        <a href="condivisione?idpub={{$result->posts_id}}&tipo=0"><img src="image/condivisione.png"></a>
                  </td>

                  </td>
                  </tr>
                    <tr>
                  <td>
                    <!--Data Post -->
                  <p>{{$result->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                  </td>
                      </tr>
                      <tr>
                    <td>

                      <!--Dati del Post  -->
                    <p> {{$result->text}}</p>
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

                </table>
                  @else

                  <!--Allegati  -->
                    <?php $attachments = DB::table('attachments_publications')->select('*')->where('publication_id',$result->publication_id)->get(); ?>
                 <!--Tags -->
                    <?php $tags = DB::table('publications_tag')->select('value')->where('publications_id',$result->publication_id)->get(); ?>
                  <!--Topic -->
                    <?php $topic = DB::table('publications')->join('topics','topics_id','=','topics.id')->select('topic_name')->where('publications.id',$result->publication_id)->first(); ?>

                    <div class="riga">
                      <hr>
                      <h3></h3>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    </div>

                  <table class="tables" width="50%" border="0">
                  <tr>
                    <td>
                        <p><img src="/profile_images/{{$result->user_image}}"style="width:25%; height:25%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px;">
                          &nbsp;&nbsp;{{$result->name}} {{$result->second_name}} {{$result->last_name}}</p>
                          <a href="condivisione?idpub={{$result->publication_id}}&tipo=1"><img src="image/condivisione.png"></a>
                    </td>

                    </tr>
                      <tr>
                    <td>
                      <!--Data Pubblicazione -->
                    <p>{{$result->year}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </td>
                        </tr>
                        <tr>
                      <td>

                        <!--Dati della Pubblicazione  -->
                      <p> {{$result->title}}
                          <br> {{$result->type}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          Published on: {{$result->venue}} <br>
                          @if(isset($result->volume))Volume:{{$result->volume}}@endif
                          @if(isset($result->number)), Number: {{$result->number}} ,@endif
                          @if(isset($result->pages))Pages: {{$result->pages}}</p>@endif
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
                   </table>
                 </br>
                 </br>
                  </br>
                  @endif

            @endforeach
            @else
            Non sei iscritto al gruppo
          @endif
          </div>
         </div>
          </div>
          <div class="col-sm-2 sidenav">
            <div class="well">
              @include('profile_bar')
              <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
            </div>
           </div>
        </div>
        </div>
      </br>
  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
 </body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>
