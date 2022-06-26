<?php 
    require_once('assets/top.php');
    require_once('assets/header.php');
?>
        <h2 class="wlc-title"><span class="highlight" style="color:#fff;">Plaćanja</span></h2>   
        <div class="row payments-row">
          <div class="col-xl transactions-all card">
              <h4 class="card-heading">Transakcije</h4>
              <div class="movements">
              <?php  
              $transakcijacheck = $db->prepare("SELECT * FROM transakcije WHERE id_korisnika = ? ORDER BY id_transakcije DESC"); 
              $transakcijacheck->execute([$_SESSION['clientSQLID']]);
              $transakcije = $transakcijacheck->fetchAll(); 

              foreach($transakcije as $transakcija) { 
                $tiptransakcije = $transakcija['tip_transakcije'];
                $datum = $transakcija['datum_transakcije'];

                if($tiptransakcije == 'Uplata') { $tipboja = 'withdrawal'; } 
                else if($tiptransakcije == 'Isplata') { $tipboja = 'deposit'; }

                echo '<div class="movements__row">';
                echo '<div class="col col_form">';
                echo '<div class="movements__typep movements__type--'.$tipboja.'">'.$tiptransakcije.'</div>';
                echo '</div>';
                echo '<div class="col col_form">';
                echo '<div class="movements__date">'.$datum.'</div>';
                echo '</div>';
                echo '<div class="col col_input">';
                echo '<div class="movements__value">';
                echo number_format((float)$transakcija['suma'], 2, '.', ''); 
                echo ' KM</div>';
                echo '</div>';
                echo '</div>';
              } 

              ?>
          </div>
          </div>
          <form class="col-lg rates card" action="actions/transakcija.php" method="post">  
          <h4 class="card-heading">Novo plaćanje</h4> 
            <div class="new_payments">
              <div class="transactions__row">
              <div class="transactions_form">
                <div class="col col_form">Sa računa</div>
              </div>
              <div class="col col_input">
              <div class="transaction_acc">
              <?php 
                  // Getanje broja računa kartice korisnika
                  $statement = $db->prepare("SELECT iban FROM kartice WHERE id_korisnika = ?"); 
                  $statement->execute([$_SESSION['clientSQLID']]); 
                  $rows = $statement->fetchAll(); 
                  $iban = ''; 
                  foreach ($rows as $row) { $iban = $row['iban']; }
                  echo $iban;
                ?>
              </div>
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
                <div class="col col_form">Ime i prezime</div> 
              </div>
              <div class="col col_input" >
              <input type="text" placeholder="Ime primaoca" class="transaction_acc radius" name="imeprezime">
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
                <div class="col col_form">Na račun</div> 
              </div>
              <div class="col col_input" >
              <input type="number" placeholder="Broj računa" class="transaction_acc radius" name="brojracuna">
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
              <div class="col col_form"> Iznos </div>
              </div>
              <div class="col col_input" >
              <input type="number" placeholder="BAM" class="transaction_acc radius" name="iznos_uplate" step="any">
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
                <div class="col col_form">Hitni nalog?</div>
              </div>
              <div class="col col_input">
              <input type="checkbox" id="switch" /><label for="switch">Toggle</label>
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
              <div class="col col_form"> Svrha uplate </div>
              </div>
              <div class="col col_input">
              <input type="text" placeholder="Unesite svrhu plaćanja" class="transaction_acc radius" name="svrha_uplate">
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
              <div class="col col_form"> Spremite uzorak? </div>
              </div>
              <div class="col col_input">
              <input type="text" placeholder="Unesite naziv uzorka" class="transaction_acc radius" name="imeuzorka">
              </div>
            </div>
            </div>
           <?php
          if(!empty($_SESSION['erroraccount']) && $_SESSION['erroraccount'] == 'GREŠKA! Pokušajte ponovo.'){
            echo '<p class="incorrectpym">';
              echo $_SESSION['erroraccount'];
            echo '</p>';

            echo '
              <script>
                document.querySelector(".incorrectpym").style.display = "block";
              </script>
            ';
            unset($_SESSION['erroraccount']);
          } elseif(!empty($_SESSION['success']) && $_SESSION['success'] == 'Transakcija uspješno izvršena!') {
            echo '<p class="successpym">';
            echo $_SESSION['success'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".successpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['success']);
          } elseif(!empty($_SESSION['erroruser']) && $_SESSION['erroruser'] == 'GREŠKA! Pokušajte unijeti drugi broj računa.') {
            echo '<p class="incorrectpym">';
            echo $_SESSION['erroruser'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".incorrectpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['erroruser']);
          } elseif(!empty($_SESSION['errorbalance']) && $_SESSION['errorbalance'] == 'GREŠKA! Nedovoljno sredstava na računu.') {
            echo '<p class="incorrectpym">';
            echo $_SESSION['errorbalance'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".incorrectpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['errorbalance']);
          } elseif(!empty($_SESSION['successuzorak']) && $_SESSION['successuzorak'] == 'Transakcija uspješno izvršena i uzorak kreiran!') {
            echo '<p class="successpym">';
            echo $_SESSION['successuzorak'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".successpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['successuzorak']);
          }
        ?> 
            <button class="btn btn-primary bg-primary button-payment modal-button">Plati</button>
          </form>
          <div class="col-lg about card">
              <h4 class="card-heading">Uzorci</h4> 
              <div class="samples_div"> 

              <?php
              
              $uzorcicheck = $db->prepare("SELECT * FROM uzorci WHERE id_korisnika = ? ORDER BY id_uzorka DESC"); 
              $uzorcicheck->execute([$_SESSION['clientSQLID']]);
              $uzorci = $uzorcicheck->fetchAll(); 

              foreach($uzorci as $uzorak) { 
              ?>
              <div class="sample__row button-modal view_data" name="view" value="view" id="<?php echo $uzorak['id_uzorka']; ?>">
              <div class="sample_form">Uzorak</div>
              <div class="sample"><?php echo $uzorak['ime_uzorka'] ?></div>
              </div>
                
              <?php 
              }
                
                ?>

              


              <!-- //   $uzorcicheck = $db->prepare("SELECT * FROM uzorci WHERE id_korisnika = ? ORDER BY id_uzorka DESC"); 
              //   $uzorcicheck->execute([$_SESSION['clientSQLID']]);
              //   $uzorci = $uzorcicheck->fetchAll(); 

              //   foreach($uzorci as $uzorak) { 
              //     $imeuzorka = $uzorak['ime_uzorka']; 

              // echo '<div class="sample__row button-modal" data-target="#modalsample">';
              // echo '<div class="sample_form">Uzorak</div>';
              // echo '<div class="sample">'.$imeuzorka.'</div>';
              // echo '</div>';   

              //   } -->
              
          </div>
          <button type ="button" class="btn btn-primary bg-primary button-sample button-modal">Dodaj uzorak</button>
        </div>

        <!-- <div class="modal_window hidden" id="modalpayment">
      <div class="header">
      <h2 class="modal__header">
        Potvrda<span class="highlight" style="color:#fff;"> transakcije.</span>
      </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <div class="body">
      <form class="modal__form">
        <div>Unesite PIN</div>
        <input type="number" name="potvrda"/>
        <button class="btn-modal">Potvrdi &rarr;</button>
      </form>
      </div>
    </div> -->
  	<!-- <div class="overlay hidden"></div> -->
       
    <div class="modal_window hidden modal" id="dataModal">
      <div class="header">
       <h2 class="modal__header">
        Detalji<span class="highlight" style="color:#fff;"> uzorka.</span>
       </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <div class="body" id="uzorak_detalji">
      <form class="modal__form">
          <div>Ime i prezime</div>
          <div style="font-weight: 300;" id="ime"></div>
          <div>Broj računa</div>
          <div style="font-weight: 300;" id="racun"></div>
          <div>Suma</div>
          <div style="font-weight: 300;" id="suma" type="number" step="any"></div>
          <div>Naziv uzorka</div>
          <div style="font-weight: 300;" id="naziv"></div>
        <button class="btn-modal">Izvrši plaćanje &rarr;</button>
      </form>
      </div>
    </div>

      <div class="modal_window hidden" id="modalnewsample">
      <div class="header">
      <h2 class="modal__header">
        Detalji<span class="highlight" style="color:#fff;"> uzorka.</span>
      </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <div class="body">
      <form class="modal__form" action="actions/transakcija.php" method="post">
        <div>Ime i prezime</div>
        <input type="text" name="ime_prezime"/>
        <div>Broj računa</div>
        <input type="text" name="broj_racuna"/>
        <div>Naziv uzorka</div>
        <input type="text" name="ime_uzorka"/>
        <div>Suma</div>
        <input type="text" name="suma"/>
        <?php
          if(!empty($_SESSION['error']) && $_SESSION['error'] == 'Ne postoji korisnik s tim brojem računa!'){
            echo '<p class="incorrect">';
              echo $_SESSION['error'];
            echo '</p>';

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#modalnewsample").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            unset($_SESSION['error']);
          }
        ?>
        <button class="btn-modal">Kreiraj uzorak &rarr;</button>
      </form>
      </div>
    </div>
  	<div class="overlay hidden"></div>

<?php 
    require_once('assets/bottom.php'); 
?>