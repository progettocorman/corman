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
            <a> </a>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">{{$member->getFullName()}}</h4>
                <p class="list-group-item-text">{{$member->email}}</p>
            </a>
            @endforeach
          </div>
        </div>

    <body>
</html>
