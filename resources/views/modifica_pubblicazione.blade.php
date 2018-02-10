<!DOCTYPE html>
<?php
    $id = session('id');
    $query = DB::table('topics')->select('topic_name')->get();
    $types = DB::table('types')->select('value')->distinct()->get();
    $idpub = $_GET['idpub'];

    $publication = DB::table('publications')->select('*')->where('id',$idpub)->first();
    $tagspub = DB::table('publications_tag')->select('*')->where('publications_id',$idpub)->get();
    $user_publications = DB::table('users_publications')->select('*')->where('publication_id',$idpub)->get();
    
    $title =  $publication->title;
    $venue = $publication->venue;
    $volume = $publication->volume;
    $number = $publication->number;
    $pages = $publication->pages;
    $year = $publication->year;
    $type = $publication->type;
    
    //PER I TAGS
    
   foreach($tagspub as $tag){
        $tags = $tag->value ;
        }

    //PER I COAUTORI
    foreach($user_publications as $coauthor){
        $coautors =  $coauthor->author_name;
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
        <!----------------------------------------FORM ----------------------------------->
        <form action="modifyPublication" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <table class="tables" width="100%" border="0">
            <tr>
              <td>
                <label >Titolo</label>
              </td>
              <td>
                <label >Rivista</label>
              </td>
            </tr>

           <tr>
             <td>
                <input type="text" class="form-control" name="title" value={{$title}}  required>
                
             </td>
             <td>
                <input type="text" class="form-control" name="venue" value={{$venue}} required >
             </td>
           </tr>

            <tr>
              <td>
                 <label >Volume</label>
              </td>
              <td>
                  <label >Numero</label>
              </td>
            </tr>

            <tr>
              <td>
                <input type="text" class="form-control" name="volume" value={{$volume}}>
              </td>
              <td>
                <input type="text" class="form-control" name="number" value={{$number}}>

              </td>
            </tr>

            <tr>
              <td>
                <label>Pagine</label>
              </td>
              <td>
                 <label>Anno di pubblicazione</label>
              </td>
            </tr>

            <tr>
              <td>
                <input type="text" class="form-control" name="pages" value={{$pages}} required>
              </td>
              <td>
                <input type="text" class="form-control" name="year" value={{$year}} required>
              </td>
            </tr>


              <tr>
                <td>
                  <label>Tipologia</label>
                </td>
                <td>
                  <label>Tag</label>
                </td>
              </tr>

              <tr>
                <td>
                  <select class="form-control" name="type" value={{$type}}>
                    @foreach ($types as $type)
                        <option>{{$type->value}}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                 
                <input type="text" name ="tags" value={{$tags}} vadata-role="tagsinput" />
            
                  
                </td>
              </tr>
              <tr>
                <td>
                     <label>Co-Autori</label>
                 </td>
                 <td>
                  <label>Topic</label>
            </td>
              </tr>



               <tr>

                  <td>
                       <input type="text" value={{$coautors}} name ="coautori" data-role="tagsinput" />
                  </td>
                  <td>
                    <select class="form-control" name="topics" placeholder="Topic">
                      @foreach ($query as $topic)
                          <option>{{$topic->topic_name}}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
            <tr>
              <td>
                <label>Allegati</label>
             </td>
             <td>
                <p><label>Visibility</label></P>
             </td>
           </tr>
             <tr>
              <td>
              <input type="file" name="fileUpload1" multiple>
            </td>
            <td>
              <input type="radio" name="visibility[]"  value='publico' checked> Pubblico
              <input type="radio" name="visibility[]" value='privato'> Privato
              <input type="radio" name="visibility[]" value='solo io'> Solo io<br>
            </td>
            </tr>
             <tr>
              <td>
                <button type="submit" class="btn btn-primary">Pubblica</button>
              </td>
             </tr>
        </table>
        </form>

        <!----------------------------------------FORM ----------------------------------->
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
