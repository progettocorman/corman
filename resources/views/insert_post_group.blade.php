<form action='insert_post_group2' method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
<table class="tables" width="100%" border="0">
    <tr>
      <td>
        <label >Insert your post </label>
      </td>
    </tr>
    <tr>
      <td>
        <textarea name="testo" style="width: 100%; height: 100px;"></textarea>
      </td>
    </tr>
      <tr>
      <td>
        <label >Tag </label>
      </td>
    </tr>

    <tr>
      <td>
      <input type="text" placeholder="Add tag"  name ="tags" data-role="tagsinput" />
      </td>
    </tr>
    <tr>
      <td>
        <input type="file" name="fileUpload1" multiple>
      </td>
    </tr>
     <tr>
      <td>
        <input type="hidden" name = "passa_group_id" value="{{$group_id}}" />
        <button type="submit" class="btn btn-primary">Share</button>
      </td>
     </tr>
</table>
</form>
