<?php

if(!isset($_SESSION['userSession'])) { session_start(); }
require_once('../actions/db.php');

$mjeseci = ["Januar","Februar","Mart","April","Maj","Juni","Juli","August","Septembar","Oktobar","Novembar","Decembar"];

// KREIRANJE UZORKA 


if(isset($_POST['ime_prezime']) && isset($_POST['broj_racuna']) && isset($_POST['ime_uzorka']) && isset($_POST['suma'])) { 
        $racunuzorak = $_POST['broj_racuna']; 
        $stmtmt5 = $db->prepare("SELECT * FROM kartice WHERE iban = ?"); 
        $stmtmt5->execute([$racunuzorak]); 
        if($stmtmt5->rowCount() == 0) { 
            $_SESSION['error'] = 'Ne postoji korisnik s tim brojem računa!';
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
            return true;

        } else {

            $statement15 = $db->prepare("SELECT id_korisnika FROM kartice WHERE iban = ?"); 
            $statement15->execute([$_POST['broj_racuna']]); 
            $rowsime = $statement15->fetchAll(); 
            $idprimaoca = ''; 
            foreach ($rowsime as $row) { $idprimaoca = $row['id_korisnika']; }

            $statement16 = $db->prepare("SELECT ime_prezime FROM korisnici WHERE id_korisnika = ?"); 
            $statement16->execute([$idprimaoca]); 
            $rowsime1 = $statement16->fetchAll(); 
            foreach ($rowsime1 as $row) { $imeprimaoca = $row['ime_prezime']; }

            $stmtmt6 = $db->prepare("INSERT INTO uzorci (id_korisnika, ime_prezime, broj_racuna, ime_uzorka, suma) VALUES (?, ?, ?, ?, ?)");

            $idkorisnika = $_SESSION['clientSQLID'];
            $username = $imeprimaoca;
            $brojracuna = $_POST['broj_racuna'];
            $imeuzorka = $_POST['ime_uzorka'];
            $suma = $_POST['suma'];
    
            $stmtmt6->execute([$idkorisnika, $username, $brojracuna, $imeuzorka, $suma]);
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
            } 

    } 

// PLACANJA - TRANSAKCIJE

if(!empty($_POST['brojracuna']) && !empty($_POST['imeprezime']) && !empty($_POST['svrha_uplate']) && !empty($_POST['iznos_uplate'])) {
    

    // Getanje broja računa kartice korisnika
    $statement = $db->prepare("SELECT iban FROM kartice WHERE id_korisnika = ?"); 
    $statement->execute([$_SESSION['clientSQLID']]); 
    $rows = $statement->fetchAll(); 
    $broj_kartice = ''; 
    foreach ($rows as $row) { $broj_kartice = $row['iban']; }

     // Getanje korisnikovog balanasa na računu
     $statement = $db->prepare("SELECT balans_kartice, tip_kartice FROM kartice WHERE id_korisnika = ?"); 
     $statement->execute([$_SESSION['clientSQLID']]); 
     $rows = $statement->fetchAll(); 
     $balans = $tip_kartice = ''; 
     foreach ($rows as $row) { $balansusera = $row['balans_kartice'];}

    $brojracuna = $_POST['brojracuna'];
    $stmtmt6 = $db->prepare("SELECT * FROM kartice WHERE iban = ?"); 
    $stmtmt6->execute([$brojracuna]); 
    if($stmtmt6->rowCount() == 0) { 
        $_SESSION['erroraccount'] = 'GREŠKA! Pokušajte ponovo.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;

    } elseif($balansusera < $_POST['iznos_uplate'] + 1) {
        $_SESSION['errorbalance'] = 'GREŠKA! Nedovoljno sredstava na računu.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;

    } elseif($brojracuna == $broj_kartice) {
        $_SESSION['erroruser'] = 'GREŠKA! Pokušajte unijeti drugi broj računa.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;
    }
    
    
    else {
        $balansracuna = $db->prepare("SELECT balans_kartice FROM kartice WHERE iban = ?");
        $balansracuna->execute([$brojracuna]);

        foreach ($balansracuna as $balanskartice) {
            $balans = $balanskartice['balans_kartice'];  
        }

        $idkorisnika = $_SESSION['clientSQLID'];
        $uplata = $_POST['iznos_uplate'] + 1;
        $sumatransakcije = $_POST['iznos_uplate'];
        $balansupdate = $balans + $uplata - 1; 

        $stmtmt6 = $db->prepare("UPDATE kartice SET balans_kartice = ? WHERE iban = ?"); 
        $stmtmt6->execute([$balansupdate, $brojracuna]);  

        $balansrazlika = $balansusera - $uplata;

        $stmtmt7 = $db->prepare("UPDATE kartice SET balans_kartice = ? WHERE iban = ?"); 
        $stmtmt7->execute([$balansrazlika, $broj_kartice]);  

        // ISPLATA

        $stmtmt8 = $db->prepare("INSERT INTO transakcije (tip_transakcije, suma, datum_transakcije, id_korisnika) VALUES (?, ?, ?, ?)");

        $transakcijaisplata = "Isplata";
        $datum = date('d.m.Y');
        $stmtmt8->execute([$transakcijaisplata, $sumatransakcije, $datum, $idkorisnika]);  

        // UPLATA
 
        $getid = $db->prepare("SELECT * FROM kartice WHERE iban = ?"); 
        $getid->execute([$brojracuna]);
        $primaocid = '';
        foreach($getid as $idkorisnika) $primaocid = $idkorisnika['id_korisnika'];  

        $stmtmt9 = $db->prepare("INSERT INTO transakcije (tip_transakcije, suma, datum_transakcije, id_korisnika) VALUES (?, ?, ?, ?)");
        $transakcijauplata = "Uplata";
        $stmtmt9->execute([$transakcijauplata, $sumatransakcije, $datum, $primaocid]);  

        // Ažuriranje analitike za primaoca

        $mjesec = date('m');
        $trimmed = '';
        $mjesec = str_replace('0', '', $mjesec);
        $trenutnimjesec = strtolower($mjeseci[$mjesec-1]);
        $newvar = $trenutnimjesec.'_prihod';

        $getanjeprihoda = $db->prepare("SELECT * FROM analitika WHERE id_korisnika = ?"); 
        $getanjeprihoda->execute([$primaocid]);
        $zadnjiprihod = '';
        foreach($getanjeprihoda as $vrijednost) $zadnjiprihod = $vrijednost[$newvar];  

        $noviprihod = (float)$zadnjiprihod + $uplata-1;

        $updateprihoda = $db->prepare("UPDATE analitika SET juni_prihod = ? WHERE id_korisnika = ?"); 
        $updateprihoda->execute([$noviprihod, $primaocid]); 

        // Ažuriranje analitike za posiljaoca 
        $newvar2 = $trenutnimjesec.'_rashod';

        $getanjerashoda = $db->prepare("SELECT * FROM analitika WHERE id_korisnika = ?"); 
        $getanjerashoda->execute([$_SESSION['clientSQLID']]);
        $zadnjirashod = '';
        foreach($getanjerashoda as $vrijednost) $zadnjirashod = $vrijednost[$newvar2];  

        $novirashod = (float)$zadnjirashod + $uplata;

        $updaterashoda = $db->prepare("UPDATE analitika SET juni_rashod = ? WHERE id_korisnika = ?"); 
        $updaterashoda->execute([$novirashod, $_SESSION['clientSQLID']]);  

        if(!empty($_POST['imeuzorka'])) { 

            $statement16 = $db->prepare("SELECT id_korisnika FROM kartice WHERE iban = ?"); 
            $statement16->execute([$_POST['brojracuna']]); 
            $rowsime3 = $statement16->fetchAll(); 
            $idprimaoca1 = ''; 
            foreach ($rowsime3 as $row) { $idprimaoca1 = $row['id_korisnika']; }

            $statement17 = $db->prepare("SELECT ime_prezime FROM korisnici WHERE id_korisnika = ?"); 
            $statement17->execute([$idprimaoca1]); 
            $rowsime4 = $statement17->fetchAll(); 
            $imeprimaoca1 = '';
            foreach ($rowsime4 as $row) { $imeprimaoca1 = $row['ime_prezime']; }

            $stmtmt6 = $db->prepare("INSERT INTO uzorci (id_korisnika, ime_prezime, broj_racuna, ime_uzorka, suma) VALUES (?, ?, ?, ?, ?)");
    
            $idkorisnika = $_SESSION['clientSQLID'];
            $username = $imeprimaoca1;
            $brojracuna = $_POST['brojracuna'];
            $imeuzorka = $_POST['imeuzorka'];
            $suma = $_POST['iznos_uplate'];
            
            $stmtmt6->execute([$idkorisnika, $username, $brojracuna, $imeuzorka, $suma]);
            
            $_SESSION['successuzorak'] = 'Transakcija uspješno izvršena i uzorak kreiran!';
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
    
        } else { 
            $_SESSION['success'] = 'Transakcija uspješno izvršena!';
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
        }
    }
}  else {
    $_SESSION['fail'] = 'Niste unijeli neko od obaveznih polja!';
    killConnection_PDO($db);
    echo'<script>window.location="../placanja.php";</script>';  
} 


// UZORAK MODAL


?>




