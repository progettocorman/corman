<?php
  $id = $_GET['id'];

  if(isset($_GET['ordBy'])){
    $order = $_GET['ordBy'];
  }else $order = "publications.created_at";
  $query = \DB::table('users_publications')->join('publications', 'users_publications.publication_id', '=', 'publications.id')->join('users','users.id','=','user_id')
                            ->select('users_publications.publication_id','users_publications.visibility as visibility',
                                   'users.name','users.second_name', 'users.last_name',
                                   'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year as year', 'publications.type as type','publications.topics_id as topic'
                            )->where('user_id',$id)->orderBy($order,'desc')->distinct();
 $results = $query->get();
 $inf = \DB::table('users')->select('*')->where('id',$id)->first();
 $user_image = $inf->user_image;
 $name = $inf->name;
 $last_name = $inf->last_name;
 $affiliation = $inf->affiliation;

 ?>



<!DOCTYPE html>
<html lang="en">
@include('bootstrap')
<link rel="stylesheet" href="css/navbar_profile.css" type="text/css" />
  <body>

  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
     <div class="col-sm-2 sidenav">
      <button class="btn btn-primary" onClick="location.href='post'">New Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'">New Publication</button></br></br>
      @include('group_bar')

    </div>

    <div class="col-sm-8 text-left">
      @include('information_profile')
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="collapse navbar-collapse" id="navbarNav">
          <div  id="profilenavbar" class="navbar-nav">
            <table class "tables" width="50%" border="0" style="margin:auto;">
              <tr>
                <td>
              <a class="oneprofilenavbar"  href='tot_pubblicazioni?id={{$id}}'style="color:DodgerBlue;"> Publications </a>
              <div class="btn-group">
               <button type="button" data-toggle="dropdown">
               <span class="caret"></span>
              </button>
             <div class="dropdown-menu">
               <a class="dropdown-item" href="tot_pubblicazioni?id={{$id}}&ordBy=topic">Order by topics</a><br/>
               <a class="dropdown-item" href="tot_pubblicazioni?id={{$id}}&ordBy=type">Order by categories</a><br/>
               <a class="dropdown-item" href="tot_pubblicazioni?id={{$id}}&ordBy=visibility">Order by visibility</a><br/>
               <a class="dropdown-item" href="tot_pubblicazioni?id={{$id}}">Order by date</a><br/>
               <a class="dropdown-item" href="tot_pubblicazioni?id={{$id}}&ordBy=year">Order by year</a><br/>
             </div>
            </div>
          </td>
          <td>
              <a class="oneprofilenavbar" href='tot_post?id={{$id}}'> Post </a>
            </td>
          </tr>
        </table>
          </div>
        </div>
       </nav>
       @if (sizeof($results)==0) <p>You haven't still posted anything!</p>@endif
      @foreach ($results as $result)
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
            <p>{{$result->name}} {{$result->second_name}} {{$result->last_name}}</p>
        </td>
        @if($id == session('id'))<td>

          <a href="modifica_pubblicazione?idpub={{$result->publication_id}}"><img src="image/modifica_1.png"></a>
          <a href="condivisione?idpub={{$result->publication_id}}&tipo=1"><img src="image/condivisione.png"></a>


      </td>
        <td>
          <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
           <span class="caret"></span>
          </button>
         <div class="dropdown-menu">
          <a class="dropdown-item" href="/setVisibilityPub?id={{$id}}&visibility=0&publication_id={{$result->publication_id}}">Pubblico</a><br/>
          <a class="dropdown-item" href="/setVisibilityPub?id={{$id}}&visibility=1&publication_id={{$result->publication_id}}">Privato</a><br/>
          <a class="dropdown-item" href="/setVisibilityPub?id={{$id}}&visibility=2&publication_id={{$result->publication_id}}">Solo Io</a><br/>
         </div>
        </div>
        </td>@endif
        </tr>
          <tr>
        <td>
          <!--Data Pubblicazione -->
        <p>{{$result->year}} @if(isset($result->visibility)) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              @if($result->visibility == 0)Pubblico
                                                @elseif($result->visibility == 1) Privato
                                                @elseif($result->visibility == 2) Solo Io
                                              @endif
                                    @endif</p>
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
          <p><?php if(sizeof($attachments)!=0) echo "Attachments: " ?> @foreach($attachments as $attachment)
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
      @endforeach
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
</br>
  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
   </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</html>
