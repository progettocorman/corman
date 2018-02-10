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
        <table class="tables" width="100%" border="0">
            <tr>
              <td>
                <label >Modifica il tuo post </label>
              </td>
            </tr>
            <tr>
              <td>
                <textarea name="testo"  style="width: 100%; height: 100px;">{{$textValue}}</textarea>
              </td>
            </tr>
            <tr>
              <td>
                 <p><label>Visibility</label></P>
              </td>
              </tr>
              <tr>
                <td>
                  <input type="radio" name="visibility[]"  value='publico' checked> Pubblico<br>
                  <input type="radio" name="visibility[]" value='privato'> Privato<br>
                  <input type="radio" name="visibility[]" value='solo io'> Solo io<br>
                </td>
              </tr>
              <tr>
              <td>
                <label >Tag </label>
              </td>
            </tr>

            <tr>
              <td>
   
              <input type="text"  value={{$tags}} name ="tags" data-role="tagsinput" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="file" name="fileUpload1" multiple>
              </td>
            </tr>
             <tr>
              <td>
                <button type="submit" class="btn btn-primary">Pubblica</button>
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
   </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
  </html>
