<?php
  $id= session('id');
  $groupscondivisione = \DB::table('partecipations')->select('user_id as Id', 'group_id as gruppoId', 'group_name as nomeGruppo')
                            ->join('groups', 'groups.id', '=', 'partecipations.group_id')
                            ->where('user_id',$id)->get();

$idpub= $_GET["idpub"];
$tipo= $_GET["tipo"];
 ?>

 <!DOCTYPE html>
   <html lang="en">

     @include('bootstrap')

 <body>
   @include('navbar')
   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-2 sidenav">
       @include('group_bar')
   </div>
       <div class="col-sm-8 text-left">
         <form method='GET' action='condivisione2' >
           {{ csrf_field() }}
         <table class="tables" width="100%" border="0">
             <tr>
               <td>
                 <label >Scegli gruppo dove condividere</label>
               </td>
             </tr>
             <tr>
               <td>
     <select name="nomegruppo">
          @foreach ($groupscondivisione as $groupcondivision)
          <option value="{{$groupcondivision->gruppoId}}-{{$idpub}}-{{$tipo}}-{{$id}}">{{$groupcondivision->nomeGruppo}}</option>
          @endforeach
 </select>
               </td>
             </tr>


              <tr>
               <td>
                 <button type="submit" class="btn btn-primary">Condividi</button>
               </td>
              </tr>
         </table>
       </form>
       </div>
       <div class="col-sm-2 sidenav">
         <div class="well">
         @include('profile_bar')
             <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
         </div>

       </div>
     </div>
     </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   </html>
