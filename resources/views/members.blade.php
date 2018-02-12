<?php
  $amm =  \DB::table('partecipations')->select('is_amministrator')->where('user_id',session('id'))->where('group_id',$groupId)->first();
  $groupCreator = \DB::table('groups')->select('created_by')->where('id',$groupId)->first();
?>

<html>
    <head>
        <title>Members </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
      <div class="container">
            <h2 class="subheader">Member</h2>
       <div class="list-group">
            @foreach($members as $member)
            <?php $is_amministrator = \DB::table('partecipations')->select('is_amministrator')->where('user_id',$member->id)->where('group_id',$groupId)->first();?>
            <a> </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">{{$member->getFullName()}}
                    @if($is_amministrator->is_amministrator != 1 && $amm->is_amministrator == 1 ) &nbsp;<button type="button" onClick="location.href = 'setAdmin?to_set={{$member->id}}&where={{$groupId}}'" class="btn btn-primary active">Admin</button>
                    @elseif($is_amministrator->is_amministrator == 1 && $groupCreator->created_by != session('id')) &nbsp;<button type="button" class="btn btn-primary disabled">Admin</button>
                    @elseif($is_amministrator->is_amministrator == 1 && $groupCreator->created_by == session('id') && $member->id != session('id'))  &nbsp;<button type="button" onClick="location.href = 'unsetAdmin?to_unset={{$member->id}}&where={{$groupId}}'" class="btn btn-primary active">Unset Admin</button>@endif

                    @if($is_amministrator->is_amministrator != 1 && $amm->is_amministrator == 1 )  &nbsp;<button type="button" onClick="location.href = 'removeUser?to_remove={{$member->id}}&from={{$groupId}}'" class="btn btn-primary active">Remove</button>@endif
                </h4>
                <p class="list-group-item-text">{{$member->email}}</p>
            </a>
            @endforeach
          </div>
        </div>

    <body>
</html>
