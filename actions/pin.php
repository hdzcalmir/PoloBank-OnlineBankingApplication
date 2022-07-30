<?php 
    if(!isset($_SESSION['userSession'])) { session_start(); }
    require_once('../actions/db.php');


    // PROMJENA PINA
    
    if(!empty($_POST['oldpin']) && !empty($_POST['newpin']) && !empty($_POST['newpinagain'])) { 
      $oldpin = $_POST['oldpin']; 
      $newpin = $_POST['newpin'];
      $newpinagain = $_POST['newpinagain'];

      $pincheck = $db->prepare("SELECT pin FROM racuni WHERE id_korisnika = ?"); 
      $pincheck->execute([$_SESSION['clientSQLID']]);
      $rows = $pincheck->fetchAll(); 
      $pin = '';

      foreach ($rows as $row) { $pin = $row['pin']; }

      if ($oldpin ==  $pin) {
        if($newpin == $newpinagain) {
          $pinupdate = $db->prepare("UPDATE racuni SET pin = :pin WHERE id_korisnika = :sqlid"); 
          $pinupdate->bindParam(':pin', $newpin, PDO::PARAM_STR);
          $pinupdate->bindParam(':sqlid', $_SESSION['clientSQLID'], PDO::PARAM_INT);
          $pinupdate->execute();    
          $_SESSION['success'] = 'Uspješno ste promijenili pin.'; 
          echo'<script>window.location="../vise.php";</script>';   
         }
      } else {  
            $_SESSION['error'] = 'Pogriješili ste pin, pokušajte ponovo.';
            echo'<script>window.location="../vise.php";</script>';  
        } 
    } elseif(empty($_POST['oldpin']) || empty($_POST['newpin']) || empty($_POST['newpinagain'])) {  
      $_SESSION['error'] = 'GREŠKA! Niste unijeli pin.';
      echo'<script>window.location="../vise.php";</script>';  
  } 


    ?>