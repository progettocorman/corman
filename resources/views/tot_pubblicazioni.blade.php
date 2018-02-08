<?php
  $id= session('id');
  $query = \DB::table('users_publications')->join('publications', 'users_publications.publication_id', '=', 'publications.id')->join('users','users.id','=','user_id')
                            ->select('users_publications.publication_id',
                                   'users.name','users.second_name', 'users.last_name',
                                   'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year', 'publications.type'
                            )->where('user_id',$id)->distinct();
 $results = $query->get();

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User userlogindone</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="css/logged.css" type="text/css" />
 </head>

  <body>

  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')

      <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
    </div>

<div class="col-sm-8 text-left">
    @foreach ($results as $result)
    <!--Allegati  -->
      <?php $attachments = DB::table('attachments_publications')->select('*')->where('publication_id',$result->publication_id)->get(); ?>
   <!--Tags -->
      <?php $tags = DB::table('publications_tag')->select('value')->where('publications_id',$result->publication_id)->get(); ?>
    <!--Topic -->
      <?php $tags = DB::table('publications_tag')->select('value')->where('publications_id',$result->publication_id)->get(); ?>
      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p>{{$result->name}} {{$result->second_name}} {{$result->last_name}}</p>
        </td>
        <td>
          <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
           <span class="caret"></span>
          </button>
         <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Pubblico</a><br/>
          <a class="dropdown-item" href="#">Solo amici</a><br/>
          <a class="dropdown-item" href="#">Privato</a><br/>
         </div>
        </div>
        </td>
        </tr>
          <tr>
        <td>
          <!--Data Pubblicazione -->
        <p>{{$result->year}}</p>
        </td>
            </tr>
            <tr>
          <td>

            <!--Dati della Pubblicazione  -->
          <p> {{$result->title}} <br> {{$result->type}}<br><br> Published on: {{$result->venue}} <br> Volume:{{$result->volume}} Number: {{$result->number}}, Pages: {{$result->pages}}</p>
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

    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile'">profile</button>
      </div>
    </div>
  </div>
  </div>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
