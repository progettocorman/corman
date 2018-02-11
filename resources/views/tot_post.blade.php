<?php
  $id = $_GET['id'];
  $query = \DB::table('users_posts')->join('posts', 'users_posts.posts_id', '=', 'posts.id')->join('users','users.id','=','user_id')
                            ->select('users_posts.posts_id','users_posts.visibility',
                                   'users.name','users.second_name', 'users.last_name',
                                   'posts.text','posts.created_at'
                            )->where('user_id',$id)->orderBy('posts.created_at','desc')->distinct();
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
              <a class="oneprofilenavbar"  href='tot_pubblicazioni?id={{$id}}'> Publication </a>
              <a class="oneprofilenavbar" href='tot_post?id={{$id}}'style="color:DodgerBlue;"> Post </a>
          </div>
        </div>
      </nav>
      <div class="box">
        <div class="box-inner">
      @if (sizeof($results)==0) <p>Non hai ancora fatto un post! Che aspetti?!</p>@endif
      @foreach ($results as $result)
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
            <p>{{$result->name}} {{$result->second_name}} {{$result->last_name}}</p>
        </td>
        <td>
        <a href="modifica_post?idpost={{$result->posts_id}}"><img src="image/modifica_1.png"></a>
        <a href="condivisione?idpub={{$result->posts_id}}&tipo=0"><img src="image/condivisione.png"></a>
      </td>
        <td>
          <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
           <span class="caret"></span>
          </button>
         <div class="dropdown-menu">
          <a class="dropdown-item" href="/setVisibilityPost?id={{$id}}&visibility=0&post_id={{$result->posts_id}}">Pubblico</a><br/>
          <a class="dropdown-item" href="/setVisibilityPost?id={{$id}}&visibility=1&post_id={{$result->posts_id}}">Privato</a><br/>
          <a class="dropdown-item" href="/setVisibilityPost?id={{$id}}&visibility=2&post_id={{$result->posts_id}}">Solo io</a><br/>
         </div>
        </div>
        </td>
        </tr>
          <tr>
        <td>
          <!--Data Post -->
          <p>{{$result->created_at}} @if(isset($result->visibility)) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @if($result->visibility == 0)Pubblico
                                                  @elseif($result->visibility == 1) Privato
                                                  @elseif($result->visibility == 2) Solo Io
                                                @endif
                                      @endif</p>
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
              {{$tag->value}}
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
  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
