<!DOCTYPE html>
<?php
    $id = session('id');
    $postid= $_GET ['idpost'];

    $post = DB::table('posts')->select('*')->where('id',$postid)->first();
    $textValue= $post->text;
    $post_tags = DB::table('posts_tags')->select('*')->where('posts_id',$postid)->get();

    foreach($post_tags  as $tag){
        $tags = $tag->value ;
        }

?>



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
        <form method='post' action='modifyPost' >
          {{ csrf_field() }}
          <input type="hidden" name="postid" value="{{$postid}}">
        <table class="tables" width="100%" border="0">
            <tr>
              <td>
                <label >Modify your post </label>
              </td>
            </tr>
            <tr>
              <td>
                <textarea name="testo"  style="width: 100%; height: 100px;">{{$textValue}}</textarea>
              </td>
            </tr>

              <tr>
              <td>
                <label >Tag </label>
              </td>
            </tr>

            <tr>
              <td>
                @if ($tags==null)<input type="text" name ="tags" value="" data-role="tagsinput" />
                @else <input type="text" name ="tags" value="{{$tags}}" data-role="tagsinput" />@endif

              </td>
            </tr>
            <tr>
              <td>
                <input type="file" name="fileUpload1" multiple>
              </td>
            </tr>
             <tr>
              <td>
                <button type="submit" class="btn btn-primary">Post</button>
              </td>
             </tr>
        </table>
      </form>
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
