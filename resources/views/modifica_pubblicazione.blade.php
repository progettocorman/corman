<!DOCTYPE html>
<?php
    $id = session('id');
    $query = DB::table('topics')->select('topic_name')->get();
    $types = DB::table('types')->select('value')->distinct()->get();
    $idpub = $_GET['idpub'];

    $publication = DB::table('publications')->select('*')->where('id',$idpub)->first();
    $tagspub = DB::table('publications_tag')->select('*')->where('publications_id',$idpub)->get();
    $user_publications = DB::table('users_publications')->select('*')->where('publication_id',$idpub)->where('user_id',$id)->get();

    $title =  $publication->title;
    $venue = $publication->venue;
    $volume = $publication->volume;
    $number = $publication->number;
    $pages = $publication->pages;
    $year = $publication->year;
    $type = $publication->type;

    //PER I TAGS
    $tags = "";
    foreach($tagspub as $tag){
        $tags = $tags.",".$tag->value ;
      }

    //PER I COAUTORI
    $coauthors = "";
    foreach($user_publications as $coauthor){
        $coauthors = $coauthors.",".$coauthor->author_name;
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
        <input type="hidden" class="form-control" name="idpub" value="{{$idpub}}" required>
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

                @if ($tags==null)<input type="text" name ="tags" value="" data-role="tagsinput" />
                @else <input type="text" name ="tags" value="{{$tags}}" data-role="tagsinput" />@endif


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
                       <input type="text" value={{$coauthors}} name ="coautori" data-role="tagsinput" />
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
    <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
    </br>
      <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
  </nav>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </html>
