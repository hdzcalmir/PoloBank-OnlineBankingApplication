<?php 
    require_once('assets/top.php');
    require_once('assets/header.php'); 

    // PROMJENA STANJA RAČUNA

    if(isset($_GET['stanjeracuna'])) { 
        $stanjeracuna = $_GET['stanjeracuna']; 

        $sql = "UPDATE korisnici SET stanje_racuna = ? WHERE id_korisnika = ?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$stanjeracuna, $_SESSION['clientSQLID']]);
        $_SESSION['stanje_racuna'] = $stanjeracuna; 
    }

    echo '<input type="hidden" id="secret" value="';
      echo $_SESSION['stanje_racuna'];
    echo '">';
?>
        <h2 class="wlc-title"><span class="highlight" style="color:#fff;">Više</span></h2>   
        <div class="row more">
          <div class="col-lg acc bg-white">
            <h4 class="card-heading">Moj profil</h4>
            <div class="name_row">
              <div class="profile_form">
                Nosioc računa
              </div>
              <div class="col col_input">
              <div class="my_name"><?php echo $_SESSION['userSession']; ?></div>
              </div>
            </div>
            <div class="name_row">
              <div class="profile_form">
                Broj kartice
              </div>
              <div class="col col_input">
              <div class="my_name">
                <?php 
                  // Getanje broja računa kartice korisnika
                  $statement = $db->prepare("SELECT broj_kartice FROM kartice WHERE id_korisnika = ?"); 
                  $statement->execute([$_SESSION['clientSQLID']]); 
                  $rows = $statement->fetchAll(); 
                  $broj_kartice = ''; 
                  foreach ($rows as $row) { $broj_kartice = $row['broj_kartice']; }
                  $filter = substr($broj_kartice,0,4).(" ").substr($broj_kartice,4,4).(" ").substr($broj_kartice,8,4).(" ").substr($broj_kartice,12,4);
                  echo $filter;
                ?>
              </div>
              </div>
            </div>
            <div class="name_row">
              <div class="profile_form">
                Broj računa
              </div>
              <div class="col col_input">
              <div class="my_name">
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
            <h5 class="tittle_sett">Postavke</h5>
            <div class="name_row pin button-modal" data-target="#modalpin">
            <div class="col col_form">
              <div class="profile_form">
                Promjena pina
              </div>
            </div>
            </div> 
            <div class="name_row pass button-modal" data-target="#modalpass">
            <div class="col col_form">
              <div class="profile_form">
                Promjena lozinke
              </div>
            </div> 
            </div> 
            <div class="name_row">
            <div class="col col_form">
              <div class="profile_form">
                Sakrij stanje računa
              </div>
              </div>  
              <div class="col col_input">
                <input type="checkbox" id="switch_1" name="hidebalance[]" value="hide" /><label for="switch_1" onclick="Redirect()"></label>
              </div> 
            </div>
          </div>
          <div class="col-lg rates bg-white">
            <h4 class="card-heading">Kursna lista</h4>
            <div class="main_row">
              <div class="bam">
                1 BAM 
              </div>
              </div>
            <div class="exchange_div">
              <div class="exchange_row">
                <div class="exchange_form">
                <div class="col col_form">
                  1 EUR
                </div>
                </div>
                <div class="exchange_type">
                <div class="col col_form">
                  <div>Kupovni</div>
                </div>
                  <div class="col col_form">
                  <div>Prodajni</div>
                </div>
                </div>
                <div class="exchange_value">
                <div class="col col_input">
                  <div>1.95583</div>
                  </div>
                  <div class="col col_input">
                  <div>1.95583</div>
                  </div>
                </div>
              </div>
          </div>
          </div>
          <div class="col-xxl about bg-white">
            <h4 class="card-heading">O Banci</h4>
            <h4 class="bank_name"> Polo BANK dd, Bosna i Hercegovina</h4>
            <p class="bank_details">Zmaja od Bosne bb<br>71 000 Sarajevo, BiH</p>
            <p class="bank_details"><b>VAT:</b> 20054480006</p>
            <p class="bank_details"><b>SWIFT:</b> RGCACAH2F</p>
            <p class="bank_details"><b>Broj transakcijskog računa:</b> 181000000000022</p>
            <p class="bank_details"><b>Označenje suda i sudski broj:</b> Općinski sud <br> u Tuzli, 2 - 11622</p>
            <p class="bank_contact">Kontakt</p>
            <p class="bank_info"><b>Email:</b> info@polobank.ba</p>
            <p class="bank_info"><b>Broj telefona:</b> +387 33 21 38 51</p>
          </div>
        </div>

      <!-- PROMJENA PINA -->

      <div class="overlay hidden"></div>

    <div class="modal_window hidden" id="modalpin">
      <div class="header">
      <h2 class="modal__header">
        Promijenite<span class="highlight" style="color:#fff;"> pin.</span>
      </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <form class="modal__form" action="actions/podaci.php" method="POST">
        <div>Stari pin</div>
        <input type="password" pattern="[0-9]*" inputmode="numeric" name="oldpin" minlength="4" maxlength="4"/>
        <div>Novi pin</div>
        <input type="password" pattern="[0-9]*" inputmode="numeric" name="newpin" minlength="4" maxlength="4"/>
        <div>Ponovite novi pin</div>
        <input type="password" pattern="[0-9]*" inputmode="numeric" name="newpinagain" minlength="4" maxlength="4"/>
        <?php
          if(!empty($_SESSION['error']) && $_SESSION['error'] == 'Pogriješili ste pin, pokušajte ponovo.'){
            echo '<p class="incorrect">';
              echo $_SESSION['error'];
            echo '</p>';

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#modalpin").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            unset($_SESSION['error']);
          }
        ?>
        <button class="btn-modal">Potvrdi &rarr;</button>
      </form>
    </div>   



    <div class="modal_window hidden" id="modalpass">
      <div class="header">
      <h2 class="modal__header">
        Promijenite<span class="highlight" style="color:#fff;"> šifru.</span>
      </h2>
        <button class="btn_close-modal">&times;</button>
      </div>
      <form class="modal__form" action="actions/podaci.php" method="POST">
        <div>Stara šifra</div>
        <input type="password" name="oldpass" minlength="8"/>
        <div>Nova šifra</div>
        <input type="password" name="newpass" minlength="8"/>
        <div>Ponovite novu šifru</div>
        <input type="password" name="newpassagain" minlength="8"/>
        <?php
          if(!empty($_SESSION['error']) && $_SESSION['error'] == 'Pogriješili ste šifru, pokušajte ponovo.'){
            echo '<p class="incorrect">';
              echo $_SESSION['error'];
            echo '</p>';

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#modalpass").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            unset($_SESSION['error']);
          }
        ?>
        <button class="btn-modal">Potvrdi &rarr;</button>
      </form>
    </div> 

    <?php
      if($_SESSION['stanje_racuna'] == 0) {
        echo '<script>';
          echo 'function Redirect() { window.location="vise.php?';
            echo "stanjeracuna=1";
            echo '"; }';
        echo '</script>';
      } else if($_SESSION['stanje_racuna'] == 1) {
        echo '<script>';
          echo 'function Redirect() { window.location="vise.php?';
            echo "stanjeracuna=0";
            echo '"; }';
        echo '</script>';
      }
      echo '<script>';
        echo '
          document.addEventListener("DOMContentLoaded", function(){
              const getElement = document.querySelector("#secret").value; 
              const switcher = document.getElementById("switch_1"); 
              if(getElement == 1) { switcher.checked = true; }
              if(getElement == 0) { switcher.checked = false; }
          });
        ';
      echo '</script>';
    ?>

<?php 
    require_once('assets/bottom.php'); 
?>
