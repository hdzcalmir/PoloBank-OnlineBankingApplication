<?php

if(!isset($_SESSION['userSession'])) { session_start(); }
require_once('../actions/db.php');


// LOGIN
  
  if(!empty($_POST['email_login']) && !empty($_POST['password_login'])) {
      $emailLogin = $_POST['email_login'];
      $passwordLogin = $_POST['password_login']; 

      $statement = $db->prepare("SELECT * FROM korisnici WHERE email = ?"); 
      $statement->execute([$emailLogin]);

      $rows = $statement->fetchAll();
      $realpwd = $name = $usermail = $stanje_racuna = '';

      foreach ($rows as $row) {
          $realpwd = $row['sifra']; 
          $name = $row['ime_prezime'];  
          $usermail = $row['email'];  
          $stanje_racuna = $row['stanje_racuna'];  
          $sqlid = $row['id_korisnika'];  
          
      }

      if(password_verify($passwordLogin, $realpwd)) {
          $_SESSION['clientEmail'] = $usermail;
          $_SESSION['clientSQLID'] = $sqlid;
          $_SESSION['clientName'] = $name;
          $_SESSION['stanje_racuna'] = $stanje_racuna;
          $_SESSION['userSession'] = $name;
          echo'<script>window.location="../panel.php";</script>';
      }
      else {  
          $_SESSION['error'] = 'Vaš email ili lozinka nisu validni, pokušajte ponovo.';
          echo'<script>window.location="../index.php";</script>';
          killConnection_PDO($db);
      } 
  } elseif(empty($_POST['email_login']) && empty($_POST['password_login'])){
      $_SESSION['error'] = 'Unesite Vaše podatke!';
      echo'<script>window.location="../index.php";</script>';
      killConnection_PDO($db);

  }


?>