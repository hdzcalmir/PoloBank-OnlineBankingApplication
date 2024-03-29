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
                echo number_format((float)$transakcija['suma'], 2, '.', ','); 
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
                  $statement = $db->prepare("SELECT iban FROM racuni WHERE id_korisnika = ?"); 
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
                <script>
                </script>
              <input type="text" placeholder="Ime primaoca" value ="<?php if(!isset($_SESSION['imeprimaoca'])) {
                echo '';
               }else {
                echo $_SESSION['imeprimaoca'];
                unset($_SESSION['imeprimaoca']); 
               }?>" class="transaction_acc radius" name="imeprezime">
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
                <div class="col col_form">Na račun</div> 
              </div>
              <div class="col col_input" >
              <input type="number" placeholder="Broj računa" id="racun" class="transaction_acc radius" value ="<?php if(!isset($_SESSION['racunprimaoca'])) {
                echo '';
               }else {
                echo $_SESSION['racunprimaoca'];
                unset($_SESSION['racunprimaoca']); 
               }?>" name="brojracuna">
              </div>
            </div>
            <div class="transactions__row">
              <div class="transactions_form">
              <div class="col col_form"> Iznos </div>
              </div>
              <div class="col col_input" >
              <input type="number" placeholder="BAM" class="transaction_acc radius" name="iznos_uplate" step="any" value ="<?php if(!isset($_SESSION['sumaprimaoca'])) {
                echo '';
               }else {
                echo number_format((float)$_SESSION['sumaprimaoca'], 2, '.', ''); 
                unset($_SESSION['sumaprimaoca']); 
               }?>">
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
          if(!empty($_SESSION['error']) && $_SESSION['error'] == 'GREŠKA! Pokušajte ponovo.'){
            echo '<p class="incorrectpym">';
              echo $_SESSION['error'];
            echo '</p>';

            echo '
              <script>
                document.querySelector(".incorrectpym").style.display = "block";
              </script>
            ';
            unset($_SESSION['error']);
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
          } elseif(!empty($_SESSION['error']) && $_SESSION['error'] == 'GREŠKA! Pokušajte unijeti drugi broj računa.') {
            echo '<p class="incorrectpym">';
            echo $_SESSION['error'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".incorrectpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['error']);
          } elseif(!empty($_SESSION['error']) && $_SESSION['error'] == 'GREŠKA! Nedovoljno sredstava na računu.') {
            echo '<p class="incorrectpym">';
            echo $_SESSION['errorbalance'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".incorrectpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['error']);
          } elseif(!empty($_SESSION['success']) && $_SESSION['success'] == 'Transakcija uspješno izvršena i uzorak kreiran!') {
            echo '<p class="successpym">';
            echo $_SESSION['success'];
          echo '</p>';

          echo '
            <script>
              document.querySelector(".successpym").style.display = "block";
            </script>
          ';
          unset($_SESSION['success']);
          } elseif(!empty($_SESSION['error']) && $_SESSION['error'] == 'Niste unijeli neko od obaveznih polja!') {
            echo '<p class="incorrectpym">';
            echo $_SESSION['error'];
          echo '</p>';
          echo '
          <script>
            document.querySelector(".incorrectpym").style.display = "block";
          </script>
        ';
        unset($_SESSION['error']);
          } elseif(!empty($_SESSION['error']) && $_SESSION['error'] == 'GREŠKA! Maksimalna suma po transakciji je 2000KM.') {
            echo '<p class="incorrectpym">';
            echo $_SESSION['error'];
          echo '</p>';
          echo '
          <script>
            document.querySelector(".incorrectpym").style.display = "block";
          </script>
        ';
        unset($_SESSION['error']);
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
              <div data-target="#modalSample" class="sample__row button-modal" data-id="<?php echo $uzorak['id_uzorka']; ?>">
              <div class="sample_form">Uzorak</div>
              <div class="sample"><?php echo $uzorak['ime_uzorka'] ?></div>
              </div>
                
              <?php 
              }
              ?>
          </div>
          <button type ="button" class="btn btn-primary bg-primary button-sample button-modal" data-target="#modalnewsample">Dodaj uzorak</button>
        </div>


        <!-- DINAMICKI PRIKAZ MODALA - ajax -->
    
    <script type='text/javascript'>
            $(document).ready(function(){
                $('.sample__row').click(function(){
                    let iduzorka = $(this).data('id');
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        data: {iduzorka: iduzorka},
                        success: function(response){ 
                            $('.body_sample').html(response); 
                            $('#modalSample').removeClass('hidden'); 
                        }
                    });
                });
            });
      </script>


    <div class="modal_window hidden" id="modalSample">
      <div class="header">
       <h2 class="modal__header">
        Detalji<span class="highlight" style="color:#fff;"> uzorka.</span>
       </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <div class="body_sample">
      </div>
    </div>
  	<div class="overlay hidden"></div>


    <!-- MODAL ZA DODAVANJE UZORAKA -->
    
      <div class="modal_window hidden" id="modalnewsample">
      <div class="header">
      <h2 class="modal__header">
        Detalji<span class="highlight" style="color:#fff;"> uzorka.</span>
      </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <div class="body">
      <form class="modal__form" action="actions/uzorak.php" method="post">
        <div>Ime i prezime</div>
        <input type="text" name="imeuzorak"/>
        <div>Broj računa</div>
        <input type="number" name="racunuzorak"/>
        <div>Naziv uzorka</div>
        <input type="text" name="nazivuzorak"/>
        <div>Suma</div>
        <input type="number" name="sumauzorak" step="any"/>
        <?php
         if(!empty($_SESSION['error']) && $_SESSION['error'] == 'Pokušajte unijeti drugi broj računa.') {
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
        }elseif(!empty($_SESSION['error']) && $_SESSION['error'] == 'Ispunite sva polja.') {
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
        }elseif(!empty($_SESSION['error']) && $_SESSION['error'] == 'GREŠKA! Unijeli ste nepostojeći broj računa.') {
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