<link rel="stylesheet" href="css/navbar.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Corman</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="home">Home</a></li>
        <li><a href="#"><form class="example" action="/search" style="margin:auto;max-width:300px">
<input type="text" class="ricercainput" placeholder="Search.." name="keyword">
<button type="submit"><i class="fa fa-search"></i></button>
</form></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
             <li><a href="notifications"><img src="image/senza_notifica.png"></a></li>
             <li><a href="notifications"><img src="image/notifica_arrivata.png"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logout <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/logout">Exit  </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
