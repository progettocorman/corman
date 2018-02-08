
<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('bootstrap', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <body>
  <?php echo $__env->make('navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid text-center">
  <div class="row content">
      <div class="col-sm-2 sidenav">
      <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
        <?php echo $__env->make('group_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    <div class="col-sm-8 text-left">

      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p>Nome e cognome del seguito </p>
        </td>
        <td>
        <a href="modify"><img src="image/modifica_1.png"></a>
      </td>
        <td>
          <div class="btn-group">
           <button type="button" class="botn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
           <span class="caret"></span>
          </button>
         <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Pubblico</a><br/>
          <a class="dropdown-item" href="#">Solo amici</a><br/>
          <a class="dropdown-item" href="#">Privato</a><br/>
         </div>
        </div>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui v Qui ci sarà il post del ricercatore che segui</p>
    </td>
  </tr>
  <tr>
<td>
<input class="Commenti" placeholder="Commenta" id="comment">
</td>
</tr>
      </table>

  
      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p>Name Surname</p>
        </td>

        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore</p>
    </td>
  </tr>
  <tr>
  <td>
  <input class="Commenti" placeholder="Commenta" id="comment">
  </td>
  </tr>
  </table>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <?php echo $__env->make('profile_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <button class="btn btn-primary" onClick="location.href='userprofile'">profile</button>
      </div>
    </div>
  </div>
  </div>

  </body>

</html>
