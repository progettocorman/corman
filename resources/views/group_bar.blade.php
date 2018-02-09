<?php
$user_id = session('id');
$groups_partecipation = DB::table('groups')->join('partecipations','groups.id','=','partecipations.group_id')
                        ->select('groups.id','groups.group_name')->get();
 ?>


<h4>Lista dei gruppi a cui ti sei iscritto</h4>
@foreach($groups_partecipation as $group)
      <p><a method="get" href="group/">{{$group->group_name}}</a></p>
@endforeach
