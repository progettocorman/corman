<p><img src="/profile_images/
<?php 
    $id = session('id');
    $query = DB::table('users')->select('*')->where('id',$id)->first();
    echo $query->user_image; 

?>" style="width:48px;height:48px;"></p>
<p>{{$name}}</p>
<p>{{$last_name}}</p>
<p>{{$affiliation}}</p>
