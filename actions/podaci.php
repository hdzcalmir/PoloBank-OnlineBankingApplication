<?php 
    if(!isset($_SESSION['userSession'])) { session_start(); }
    require_once('../actions/db.php');


    // ODJAVA

    if(isset($_GET['logout'])) {
		if(isset($_SESSION['userSession'])) { unset($_SESSION['userSession']); session_destroy(); killConnection_PDO($db); }
        echo'<script>window.location="../index.php";</script> '; 
        return true;
	}  


    // REGISTRACIJA


    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['ime_prezime']) && !empty($_POST['grad']) && !empty($_POST['adresa']) && !empty($_POST['cards']) && !empty($_POST['pin']) && !empty($_POST['datum'])) {
        $password = $_POST['password']; 
        $email = $_POST['email'];
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmtmt4 = $db->prepare("SELECT * FROM korisnici WHERE email = ?"); 
        $stmtmt4->execute([$email]);

        if($stmtmt4->rowCount() > 0) { 
            $_SESSION['error'] = 'Već postoji račun sa takvim e-mailom, pokušajte ponovo.';
            echo'<script>window.location="../index.php";</script>';
            killConnection_PDO($db);
            return true;
        }

        $datumRodjenja = $_POST['datum'];
        $trenutnaGodina = date('Y');

        (int)$filterGodina = substr($datumRodjenja, 0,4);

        $konacnaGodina = $trenutnaGodina - $filterGodina;

        if($konacnaGodina >= 18) {

        $stmt = $db->prepare("INSERT INTO korisnici (ime_prezime, email, sifra, datum_rodjenja, grad, adresa) VALUES (?, ?, ?, ?, ?, ?)");
    
        $username = $_POST['ime_prezime']; 
        $datum = $_POST['datum'];
        $grad = $_POST['grad'];
        $adresa = $_POST['adresa'];
        (string)$pin = $_POST['pin'];
        $kartica = $_POST['cards'];

        $stmt->execute([$username, $email, $hash, $datum, $grad, $adresa]);

        // Getanje korisnikovog SQL ID-a
        $statement = $db->prepare("SELECT id_korisnika FROM korisnici WHERE ime_prezime = ?"); 
        $statement->execute([$username]); 
        $rows = $statement->fetchAll(); 
        $sqlid = '';

        foreach ($rows as $row) { 
            $sqlid = $row['id_korisnika'];  
            $_SESSION['clientSQLID'] = $sqlid;  
            $_SESSION['stanje_racuna'] = 0;  
        }
        
        $balans_kartice = 0;
        if($kartica == 'Master Card') {
            $broj_kartice = createMasterCard(rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9));
        } else if($kartica == 'Visa') {
            $broj_kartice = createVisa(rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9));
        }
        $godina = strval(date('Y'));
        $mjesec = date('m');
        $godina += 4; 

        $datum_isteka = '%s/%d'; 
        $datum_isteka = sprintf($datum_isteka, $mjesec, $godina);

        $iban = createIban(rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9), rand(0,9));
        
        $stmtmt = $db->prepare("SELECT iban FROM racuni WHERE iban = ?"); 
        $stmtmt->execute([$iban]);

        $count = count($stmtmt->fetchAll(PDO::FETCH_ASSOC));

            if($count == 0) {
                $stmtmt2 = $db->prepare("SELECT iban FROM racuni WHERE iban = ?"); 
                $stmtmt2->execute([$iban]);

                $noviIban = strval($iban);
                $noviPin = (string)$pin;
                
                // Insertovanje racuna korisnika
                $stmt = $db->prepare("INSERT INTO racuni (id_korisnika, tip_kartice, iban, broj_racuna, datum_isteka, pin, balans_kartice) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$sqlid, $kartica, $noviIban, $broj_kartice, $datum_isteka, $noviPin, $balans_kartice]); 

                // Kreiranje analitike za korisnika
                $stmtanalitika = $db->prepare("INSERT INTO analitika (id_korisnika) VALUES (?)");
                $stmtanalitika->execute([$sqlid]); 

                $_SESSION['userSession'] = $username;
                echo'<script>window.location="../panel.php";</script>'; 
            }
        return true;
        }  else {
            $_SESSION['error'] = 'Morate imati 18 ili više godina da biste otvorili račun!';
                echo'<script>window.location="../index.php";</script>';
                killConnection_PDO($db); 

        }
    }else{
        $_SESSION['error'] = 'Molimo popunite sva polja!';
        echo'<script>window.location="../index.php";</script>';
        killConnection_PDO($db);
    }



    function createIban($br1, $br2, $br3, $br4, $br5, $br6, $br7, $br8, $br9, $br10, $br11, $br12) {
        $default = '1613';
        $iban = '%s%d%d%d%d%d%d%d%d%d%d%d%d';
        $iban = sprintf($iban, $default, $br1, $br2, $br3, $br4, $br5, $br6, $br7, $br8, $br9, $br10, $br11, $br12);
        return $iban;
    } 
    function createMasterCard($br1, $br2, $br3, $br4, $br5, $br6, $br7, $br8, $br9, $br10, $br11, $br12) {
        $default = '5351';
        $mastercard = '%s%d%d%d%d%d%d%d%d%d%d%d%d';
        $mastercard = sprintf($mastercard, $default, $br1, $br2, $br3, $br4, $br5, $br6, $br7, $br8, $br9, $br10, $br11, $br12);
        return $mastercard;
    } 
    function createVisa($br1, $br2, $br3, $br4, $br5, $br6, $br7, $br8, $br9, $br10, $br11, $br12) {
        $default = '4255';
        $visa = '%s%d%d%d%d%d%d%d%d%d%d%d%d';
        $visa = sprintf($visa, $default, $br1, $br2, $br3, $br4, $br5, $br6, $br7, $br8, $br9, $br10, $br11, $br12);
        return $visa;
    } 
    

?>