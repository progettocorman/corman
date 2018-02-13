<?php
$inf = \DB::table('users')->select('*')->where('id',session('id'))->first();
$user_image = $inf->user_image;
$name = $inf->name;
$last_name = $inf->last_name;
$affiliation = $inf->affiliation;
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
    <div class="col-sm-8 text-left"style="height:120%">

      <h1> f.a.q.<h1>
      <h4> A proposito di Corman<h4>
        <h4> 1. Cos'è Corman? <h4>
          <h4> Corman è un social network adibito a ricercatori i quali sono interessati a condividere le proprie
               ricerche con altri ricercatori. <h4>
        <h4> 2. Qual'è il significato della sigla Corman? <h4>
          <h4> Il significato di Corman è: Collaborative Research Managment. <h4>
       <h4> 3. Chi c'è dietro Corman? <h4>
         <h4> Il Team di sviluppo di Corman sono studenti del dipartimento di Scienze dell'informazione del dipartimento
              di Bari. I loro nomi sono: Palumbo Riccardo, Angelelli Christian, Molinari Nicola, Siena Giovanni,
              Silvielli Enrico e Terraciano Antonio. <h4>
       <h4> 4. Come posso contattare Corman? <h4>
         <h4> Posso contattare Corman attraverso il seguente indirizzo email: progettocorman@gmail.com. <h4>
      <h4> Utilizzando il sito web Corman <h4>
        <h4> 5. Com'è organizzato il sito web? <h4>
          <h4>Nella pagina di benvenuto può effettuare l'accesso o registrarti, in seguito è possibile definire meglio
            il tuo profilo. Una volta effettuato l'accesso si è abilitati a creare post, pubblicazioni o gruppi. <h4>
        <h4> 6. Come posso creare una pubblicazione? <h4>
          <h4> E' possibile creare una pubblicazione premendo il tasto in alto a sinistra "crea pubblicazione", una volta
               aver premuto il bottone è sufficiente compilare i campi e infine premere il bottone "pubblica". La
               comparirà automaticamente comparirà sul proprio profilo. <h4>
        <h4> 6. Come posso creare un post? <h4>
           <h4> E' possibile creare un post premendo il tasto in alto a sinistra "crea post", una volta
                aver premuto il bottone è sufficiente compilare i campi e infine premere il bottone "pubblica". Il post
                comparirà automaticamente sul proprio profilo. <h4>
        <h4> 6. Come posso creare un gruppo? <h4>
           <h4> E' possibile creare un gruppo premendo il tasto in alto a sinistra "crea gruppo", una volta
                aver premuto il bottone è sufficiente compilare i campi e infine premere il bottone "crea". Il gruppo
                comparirà automaticamente nella lista dei gruppi presente nella colonna sinistra. <h4>
        <h4> 7. Come posso visionare il mio profilo? <h4>
          <h4> E' sufficiente preme il bottone "profile" presente nella colonna posta a destra. Una volta aver premuto
               il bottone si visionerà il proprio profilo con i propri dati personali. <h4>
        <h4> 8. Come posso modificare i miei dati personali? <h4>
          <h4> Per poter modificare i proprio dati personali, è sufficiente accedere nel proprio profilo (vedi la domanda 7)
              e successivamente premere il bottone "settings" posto in alto al centro, accanto al proprio nome. <h4>
        <h4> 9. Come posso visualizzare tutte le mie pubblicazioni?<h4>
          <h4> Per poter visualizzare tutte le proprie pubblicazioni, basta accedere nel proprio profilo (vedi domanda 7)
               e successivamente premere su "Pubblicazioni". Una volta effettuatto questo, appariranno tutte le proprie pubblicazioni<h4>
        <h4> 9. Come posso visualizzare tutti i miei post?<h4>
         <h4> Per poter visualizzare tutti i propri post, basta accedere nel proprio profilo (vedi domanda 7) e
           successivamente premere su "Post". Una volta effettuatto questo, appariranno tutti i propri post<h4>
        <h4> 10. Come posso visionare se ho una notifica? <h4>
          <h4> Nella parte superiore della pagina, se l'icona della campanella ha uno sfondo blu, vuol dire che non hai ricevuto
              nessuna notifica, mentre se l'icona della campanella ha uno sfondo rosso, vuol dire che hai ricevuto una notifica <h4>
        <h4> 11. Come posso visionare le mie notifiche? <h4>
          <h4> Per visionare le proprie notifiche basta premere sull'icona della campanella. Una volta aver premuto, appariranno
              tutte le proprie notifiche <h4>
        <h4> 12. Come posso ricercare un ricercatore, un gruppo o un post? <h4>
        <h4> Nella parte superiore della pagina è presenta una barra di ricerca, è sufficiente digitare ciò che si vuole
             ricercatore e premere invio, successivamente apparirà ciò che è stato cercato, se è esistente, altrimenti
             apparirà la scritta "Nessun Utente Trovato" o "Nessun Gruppo Trovato" oppure
             "Nessuna Pubblicazione Trovate". <h4>
        <h4> 13. Come posso uscire da Corman? <h4>
          <h4> Per uscire da Corman basta premere l'incona con la freccia in giù posta in alto, una volta apparso il menù
               a tendina premere su exit.<h4>
        <h4> 14. Come posso seguire un'altro ricercatore? <h4>
          <h4> Per seguire un ricercatore basta ricercarlo (vedi domanda 12), una volta trovato premere il bottone
               "segui" <h4>
               </br>
               </br>

       <link rel="stylesheet" href="css/navbar_profile.css" type="text/css" />


    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')

        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>

      </div>

    </div>
  </div>
  </div>
  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
 </body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>
