<!DOCTYPE html>
<?php
    $id = session('id');
    $query = DB::table('topics')->select('topic_name')->get();
    $types = DB::table('types')->select('value')->distinct()->get();
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
        <form action="addPublication" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <table class="tables" width="100%" border="0">
            <tr>
              <td>
                <label >Title</label>
              </td>
              <td>
                <label >Magazine</label>
              </td>
            </tr>

           <tr>
             <td>
                <input type="text" class="form-control" name="title" required>
             </td>
             <td>
                <input type="text" class="form-control" name="venue" required >
             </td>
           </tr>

            <tr>
              <td>
                 <label >Volume</label>
              </td>
              <td>
                  <label >Number</label>
              </td>
            </tr>

            <tr>
              <td>
                <input type="text" class="form-control" name="volume">
              </td>
              <td>
                <input type="text" class="form-control" name="number">

              </td>
            </tr>

            <tr>
              <td>
                <label>Pages</label>
              </td>
              <td>
                 <label>Year of publication</label>
              </td>
            </tr>

            <tr>
              <td>
                <input type="text" class="form-control" name="pages"required>
              </td>
              <td>
                <input type="text" class="form-control" name="year" required>
              </td>
            </tr>


              <tr>
                <td>
                  <label>Type</label>
                </td>
                <td>
                  <label>Tag</label>
                </td>
              </tr>

              <tr>
                <td>
                  <select class="form-control" name="type" placeholder="Type">
                    @foreach ($types as $type)
                        <option>{{$type->value}}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                    <input type="text" placeholder="Add tag" name ="tags" data-role="tagsinput" />
                </td>
              </tr>
              <tr>
                <td>
                     <label>Co-Authors</label>
                 </td>
                 <td>
                  <label>Topic</label>
            </td>
              </tr>



               <tr>

                  <td>
                       <input type="text" placeholder="Add co-authors" name ="coautori" data-role="tagsinput" />
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
                <label>Attachments</label>
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
                <button type="submit" class="btn btn-primary">Share</button>
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
