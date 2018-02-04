
<form action="update_file" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
     <input type="file" name="fileUpload1" multiple>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
