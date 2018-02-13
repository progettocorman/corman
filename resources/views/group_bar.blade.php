<?php
$user_id = session('id');
$groups_partecipation = DB::table('groups')->join('partecipations','groups.id','=','partecipations.group_id')
                        ->select('groups.id','groups.group_name')->where('user_id',$user_id)->get();
 ?>


<h4 style="font-family:verdana;color:black;font-size:180%">List of groups</h4>
</br>

@foreach($groups_partecipation as $group)
      <p><a method="get" href="group?group_id={{$group->id}}"style="font-family:Verdana;color:#337ab7;font-size:100%;">{{$group->group_name}}</a></p>
@endforeach
