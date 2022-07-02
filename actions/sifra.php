<?php 
    if(!isset($_SESSION['userSession'])) { session_start(); }
    require_once('../actions/db.php');

    // PROMJENA SIFRE
    
    if(!empty($_POST['oldpass']) && !empty($_POST['newpass']) && !empty($_POST['newpassagain'])) { 
      $oldpassword = $_POST['oldpass']; 
      $newpassword = $_POST['newpass'];
      $newpasswordagain = $_POST['newpassagain'];

      $sifracheck = $db->prepare("SELECT sifra FROM korisnici WHERE id_korisnika = ?"); 
      $sifracheck->execute([$_SESSION['clientSQLID']]);
      $rows = $sifracheck->fetchAll(); 
      $password = '';

      foreach ($rows as $row) { $password = $row['sifra']; }

      if (password_verify($oldpassword, $password)) {
        $hash = password_hash($newpassword, PASSWORD_BCRYPT);
        if($newpassword == $newpasswordagain) {
          $sifraupdate = $db->prepare("UPDATE korisnici SET sifra = :sifra WHERE id_korisnika = :sqlid"); 
          $sifraupdate->bindParam(':sifra', $hash, PDO::PARAM_STR);
          $sifraupdate->bindParam(':sqlid', $_SESSION['clientSQLID'], PDO::PARAM_INT);
          $sifraupdate->execute();      
          $_SESSION['success'] = 'Uspješno ste promijenili šifru.';
          echo'<script>window.location="../vise.php";</script>';
        }
      } else {  
            $_SESSION['error'] = 'Pogriješili ste šifru, pokušajte ponovo.';
            echo'<script>window.location="../vise.php";</script>';  
        }
    } elseif(empty($_POST['oldpass']) || empty($_POST['newpass'])  || empty($_POST['newpassagain'])) {
      $_SESSION['error'] = 'GREŠKA! Niste unijeli šifru.';
      echo'<script>window.location="../vise.php";</script>'; 
    }

    ?>