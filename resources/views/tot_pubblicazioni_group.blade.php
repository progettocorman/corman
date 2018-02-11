<?php
  $id = $_GET['id'];
  $idgroup = $_GET['group_id']

  $query = \DB::table('publications')->join('publications', 'publications_group.publication_id', '=',  'publications.id')
  ->join('condivisions_publications','condivisions_publications.group.id','=','publications.id')
  ->join('condivisions','publications_group.group.id','=','condivisions.group_id')
  ->select('users_publications.publication_id','users_publications.visibility as visibility',
         'users.name','users.second_name', 'users.last_name',
         'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year as year', 'publications.type as type','publications.topics_id as topic'
         
  )->where('publications_group.publication_id',$idgroup)->orderBy($order,'desc')->distinct();
    echo $query;
 ?>
$query = \DB::table('users_publications')->join('publications', 'users_publications.publication_id', '=', 'publications.id')->join('users','users.id','=','user_id')
                            ->select('users_publications.publication_id','users_publications.visibility as visibility',
                                   'users.name','users.second_name', 'users.last_name',
                                   'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year as year', 'publications.type as type','publications.topics_id as topic'
                            )->where('user_id',$id)->orderBy($order,'desc')->distinct();
