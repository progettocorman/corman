<?php
  $id= session('id');
  $publications = \DB::table('friendships')->select('friendships.user_id')->join('users_publications', 'users_publications.user_id', '=', 'friendships.user_id')
                            ->select('publication_id')
                            ->join('publications','publications.id','=','users_publications.publication_id')
                            ->join('users','users.id','=','friendships.user_id')
                            ->select('users_publications.publication_id','users_publications.visibility',
                                   'users.name','users.second_name', 'users.last_name','users.user_image',
                                   'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year', 'publications.type','publications.created_at'
                            )->where('friendships.user_follow',$id)->where('users_publications.visibility',0)->orWhere('users_publications.visibility',1)->where('friendships.user_follow',$id)->orderBy('publications.id','desc')->distinct()->get();
  $posts = \DB::table('friendships')->select('friendships.user_id')->join('users_posts', 'users_posts.user_id', '=', 'friendships.user_id')
                            ->select('posts_id')
                            ->join('posts','posts.id','=','users_posts.posts_id')
                            ->join('users','users.id','=','friendships.user_id')
                            ->select('users_posts.posts_id', 'users_posts.visibility',
                                   'users.name','users.second_name', 'users.last_name','users.user_image',
                                   'posts.text','posts.created_at'
                            )->where('friendships.user_follow',$id)->where('users_posts.visibility',0)->orWhere('users_posts.visibility',1)->where('friendships.user_follow',$id)->orderBy('posts.created_at','desc')->distinct()->get();
  $results = array();
  $i = 0;
  foreach ($publications as $publication) {
    $results[$i] = $publication;
    $i++;
  }
  foreach ($posts as $post) {
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
      <button class="btn btn-primary" onClick="location.href='post'">New Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'"><font size="1px"> New Publication</font></button></br></br>
      <button class="btn btn-primary" onClick="location.href='createGroup'">New Group</button></br></br>

        @include('group_bar')

      </div>
     <div class="col-sm-8 text-left">
      @if (sizeof($results)==0) <p>Seems like you're not following anybody! Try it!</p>@endif
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
              <p><?php if(sizeof($attachments)!=0) echo "Attachments: " ?> @foreach($attachments as $attachment)
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
            @endif

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

  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
