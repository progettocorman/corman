<?php
$user_id = session('id');
$groups_partecipation = DB::table('groups')->join('partecipations','groups.id','=','partecipations.group_id')
                        ->select('groups.id','groups.group_name')->get();
 ?>


  <h4>Lista dei gruppi a cui ti sei iscritto</h4>
  @foreach($groups_partecipation as $group)
          <p><a href="#">{{$group->group_name}}</a></p>
  @endforeach

  <a href='group'>L'universo</a> </br>
