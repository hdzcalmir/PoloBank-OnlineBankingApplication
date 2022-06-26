<?php 
    require_once('assets/top.php');
    require_once('assets/header.php');
?> 
        <h2 class="wlc-title">Dobro došli u <span class="highlight" style="color:#fff;">Polo banku!</span></h2>   
        <div class="row red">
          <div class="col-3 bg-white expenses">
            <div id="chart">
              <canvas id="myChart"></canvas>
            </div>
          </div>
          <div class="col-4 bg-white transactions">
            <h4 class="card-heading">Posljednje transakcije</h4>
            <div class="movements-index">
              <?php 
              
              $datum = date('d.m.Y');  

              $transakcijacheck = $db->prepare("SELECT * FROM transakcije WHERE id_korisnika = ? ORDER BY id_transakcije DESC"); 
              $transakcijacheck->execute([$_SESSION['clientSQLID']]);
              $transakcije = $transakcijacheck->fetchAll(); 

              foreach($transakcije as $transakcija) { 
                $tiptransakcije = $transakcija['tip_transakcije']; 
                $datum = $transakcija['datum_transakcije'];
                if($tiptransakcije == 'Uplata') { $tipboja = 'withdrawal'; } 
                else if($tiptransakcije == 'Isplata') { $tipboja = 'deposit'; }
              
                echo '<div class="movements__row">';
                echo '<div class="movements__type movements__type--'.$tipboja.'">'.$tiptransakcije.'</div>';
                echo '<div class="movements__date">'.$datum.'</div>';
                echo '<div class="movements__value">';
                echo number_format((float)$transakcija['suma'], 2, '.', ''); 
                echo ' KM</div>';
                echo '</div>';
              } 

              ?>
            </div>
          </div>
        </div>
        <div class="row red">
          <div class="col-sm-7 bg-white analitycs"><canvas id="myCharts"></canvas></div>
          <div class="col-xl-4 cards bg-white d-flex justify-content-center"> 
            <div class="row">
              <div class="inner-card" data-ride="carousel">
              <img src="img/card-logo.png" alt="polo bank logo" class="card-logo">
              <img src="img/debit.png" alt="debit kartica" class="debit">
              <img src="img/chip.png" alt="cip kartice" class="card-chip">
              <div class="debit-text">debit</div>
                <div class="card-number">
                  <?php
                   // Getanje broja računa kartice korisnika
                   $statement = $db->prepare("SELECT broj_kartice FROM kartice WHERE id_korisnika = ?"); 
                   $statement->execute([$_SESSION['clientSQLID']]); 
                   $rows = $statement->fetchAll(); 
                   $iban = ''; 
                   foreach ($rows as $row) { $broj = $row['broj_kartice']; }
                   $filter = substr($broj,0,4).(" ").substr($broj,4,4).(" ").substr($broj,8,4).(" ").substr($broj,12,4);
                  echo $filter;
                  ?>
                </div>
                <div class="cardholder">
                <?php
                   // Getanje imena card holdera
                   $statement = $db->prepare("SELECT ime_prezime FROM korisnici WHERE id_korisnika = ?"); 
                   $statement->execute([$_SESSION['clientSQLID']]); 
                   $rows = $statement->fetchAll(); 
                   $cardholder = ''; 
                   foreach ($rows as $row) { $cardholder = $row['ime_prezime']; }
                   echo strtoupper($cardholder);
                  ?>
                </div>
                <?php 

                 $strlen = '';
                 $charnum = strlen($cardholder);

                 if($charnum > 15) {
                  $strlen = 'long';
                 } else {
                  $strlen = 'short';
                 }

                echo '<div class="valid-date '.$strlen.'">';
                ?>
                <?php
                   // Getanje datuma isteka racuna
                   $statement = $db->prepare("SELECT datum_isteka FROM kartice WHERE id_korisnika = ?"); 
                   $statement->execute([$_SESSION['clientSQLID']]); 
                   $rows = $statement->fetchAll(); 
                   $istek = ''; 
                   foreach ($rows as $row) { $istek = $row['datum_isteka']; }
                   $filter = substr($istek, 0, 2);
                   $filter1 = substr($istek, 5);
                   echo $filter.'/'.$filter1;
                  ?>
                </div>
                <div class="iban-number">TRN  <?php 
                  // Getanje ibana korisnika
                  $statement = $db->prepare("SELECT iban FROM kartice WHERE id_korisnika = ?"); 
                  $statement->execute([$_SESSION['clientSQLID']]); 
                  $rows = $statement->fetchAll(); 
                  $iban = ''; 
                  foreach ($rows as $row) { $iban = $row['iban']; }
                  echo $iban;
                  ?></div>
                   <?php
                   $statement = $db->prepare("SELECT tip_kartice FROM kartice WHERE id_korisnika = ?"); 
                   $statement->execute([$_SESSION['clientSQLID']]); 
                   $rows = $statement->fetchAll(); 
                   $tipkartice = ''; 
                   foreach ($rows as $row) { $tipkartice = $row['tip_kartice']; }
                    if($tipkartice == 'Master Card') {
                      $tipkartice = 'master-card.png';
                    } elseif($tipkartice == 'Visa') {
                      $tipkartice = 'visa.png';
                    }
                    
                   echo '<img src="img/'.$tipkartice.'" alt="" class="card-type">';                
                  ?>
              </div>
            <div class="col details">
              <div class="row card-info text-card">Balans računa</div>
              <div class="row card-info text-card-3">Info o kartici</div>
              <div class="row card-info text-card-4">Statuts</div>
              <div class="row card-info text-card-5">Tip kartice</div>
              <div class="row card-info text-card-6">Valuta</div>
            </div> 
            <div class="col details-1">
              <?php
                echo '<div class="row card-info text-card-2">';
                  // Getanje korisnikovog balansa na računu
                  $statement = $db->prepare("SELECT balans_kartice, tip_kartice FROM kartice WHERE id_korisnika = ?"); 
                  $statement->execute([$_SESSION['clientSQLID']]); 
                  $rows = $statement->fetchAll(); 
                  $balans = $tip_kartice = ''; 
                  foreach ($rows as $row) { $balans = $row['balans_kartice']; $tip_kartice = $row['tip_kartice']; }
                  
                  // Getanje stanja racuna iz baze podataka 
                  $statement = $db->prepare("SELECT stanje_racuna FROM korisnici WHERE id_korisnika = ?"); 
                  $statement->execute([$_SESSION['clientSQLID']]); 
                  $rows = $statement->fetchAll(); 
                  $stanje_racuna = ''; 
                  foreach ($rows as $row) { $stanje_racuna = $row['stanje_racuna'];}

               if($stanje_racuna == 0) {
                echo number_format((float)$balans, 2, '.', '');  
                } else { echo '';}
                  echo' KM</div>';
                  echo '<div class="row card-info text-card-7">Aktivna</div>
                <div class="row card-info text-card-8">';
                  echo $tip_kartice;
                echo '</div>
                <div class="row card-info text-card-9">BAM</div>';
              ?>
            </div>
            <a href="placanja.php"><button type ="button" class="btn align-content-center button-transaction">Transakcija</button></a>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <script src="js/chartload.js"></script>  

<?php require_once('assets/bottom.php'); ?>

