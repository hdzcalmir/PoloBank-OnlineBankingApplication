<?php

if(!isset($_SESSION['userSession'])) { session_start(); }
require_once('../actions/db.php');

$mjeseci = ["Januar","Februar","Mart","April","Maj","Juni","Juli","August","Septembar","Oktobar","Novembar","Decembar"];

// PLACANJA - TRANSAKCIJE


if(!empty($_POST['brojracuna']) && !empty($_POST['imeprezime']) && !empty($_POST['svrha_uplate']) && !empty($_POST['iznos_uplate'])) {
    

    // Getanje broja računa kartice korisnika
    $statement = $db->prepare("SELECT iban FROM racuni WHERE id_korisnika = ?"); 
    $statement->execute([$_SESSION['clientSQLID']]); 
    $rows = $statement->fetchAll(); 
    $broj_kartice = ''; 
    foreach ($rows as $row) { $broj_kartice = $row['iban']; }

     // Getanje korisnikovog balanasa na računu
     $statement = $db->prepare("SELECT balans_kartice, tip_kartice FROM racuni WHERE id_korisnika = ?"); 
     $statement->execute([$_SESSION['clientSQLID']]); 
     $rows = $statement->fetchAll(); 
     $balans = $tip_kartice = ''; 
     foreach ($rows as $row) { $balansusera = $row['balans_kartice'];}

    $brojracuna = $_POST['brojracuna'];
    $stmtmt6 = $db->prepare("SELECT * FROM racuni WHERE iban = ?"); 
    $stmtmt6->execute([$brojracuna]); 



    if($stmtmt6->rowCount() == 0) { 
        $_SESSION['error'] = 'GREŠKA! Pokušajte ponovo.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;

    } elseif($balansusera < $_POST['iznos_uplate'] + 1) {
        $_SESSION['error'] = 'GREŠKA! Nedovoljno sredstava na računu.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;

    } elseif($brojracuna == $broj_kartice) {
        $_SESSION['error'] = 'GREŠKA! Pokušajte unijeti drugi broj računa.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;

    } elseif($_POST['iznos_uplate'] > 2000) {
        $_SESSION['error'] = 'GREŠKA! Maksimalna suma po transakciji je 2000KM.';
        killConnection_PDO($db);
        echo'<script>window.location="../placanja.php";</script>';  
        return true;
    }
    
    
    else {
        $balansracuna = $db->prepare("SELECT balans_kartice FROM racuni WHERE iban = ?");
        $balansracuna->execute([$brojracuna]);

        foreach ($balansracuna as $balanskartice) {
            $balans = $balanskartice['balans_kartice'];  
        }

        $idkorisnika = $_SESSION['clientSQLID'];
        $uplata = $_POST['iznos_uplate'] + 1;
        $sumatransakcije = $_POST['iznos_uplate'];
        $balansupdate = $balans + $uplata - 1; 

        $stmtmt6 = $db->prepare("UPDATE racuni SET balans_kartice = ? WHERE iban = ?"); 
        $stmtmt6->execute([$balansupdate, $brojracuna]);  

        $balansrazlika = $balansusera - $uplata;

        $stmtmt7 = $db->prepare("UPDATE racuni SET balans_kartice = ? WHERE iban = ?"); 
        $stmtmt7->execute([$balansrazlika, $broj_kartice]);  

        // ISPLATA

        $stmtmt8 = $db->prepare("INSERT INTO transakcije (tip_transakcije, suma, datum_transakcije, id_korisnika) VALUES (?, ?, ?, ?)");

        $transakcijaisplata = "Isplata";
        $datum = date('d.m.Y');
        $stmtmt8->execute([$transakcijaisplata, $sumatransakcije, $datum, $idkorisnika]);  

        // UPLATA
 
        $getid = $db->prepare("SELECT * FROM racuni WHERE iban = ?"); 
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

        $updateprihoda = $db->prepare("UPDATE analitika SET $newvar = ? WHERE id_korisnika = ?"); 
        $updateprihoda->execute([$noviprihod, $primaocid]); 

        // Ažuriranje analitike za posiljaoca 
        $newvar2 = $trenutnimjesec.'_rashod';

        $getanjerashoda = $db->prepare("SELECT * FROM analitika WHERE id_korisnika = ?"); 
        $getanjerashoda->execute([$_SESSION['clientSQLID']]);
        $zadnjirashod = '';
        foreach($getanjerashoda as $vrijednost) $zadnjirashod = $vrijednost[$newvar2];  

        $novirashod = (float)$zadnjirashod + $uplata;

        $updaterashoda = $db->prepare("UPDATE analitika SET $newvar2 = ? WHERE id_korisnika = ?"); 
        $updaterashoda->execute([$novirashod, $_SESSION['clientSQLID']]);  

        if(!empty($_POST['imeuzorka'])) { 

            $statement16 = $db->prepare("SELECT id_korisnika FROM racuni WHERE iban = ?"); 
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
    
            $idkorisnika1 = $_SESSION['clientSQLID'];
            $username1 = $imeprimaoca1;
            $brojracuna1 = $_POST['brojracuna'];
            $imeuzorka1 = $_POST['imeuzorka'];
            $suma1 = $_POST['iznos_uplate'];
            
            $stmtmt6->execute([$idkorisnika1, $username1, $brojracuna1, $imeuzorka1, $suma1]);
            
            $_SESSION['success'] = 'Transakcija uspješno izvršena i uzorak kreiran!';
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
    
        } else { 
            $_SESSION['success'] = 'Transakcija uspješno izvršena!';
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
        }
    }
}  elseif(empty($_POST['brojracuna']) || empty($_POST['imeprezime']) || empty($_POST['svrha_uplate']) || empty($_POST['iznos_uplate'])) {
    $_SESSION['error'] = 'Niste unijeli neko od obaveznih polja!';
    killConnection_PDO($db);
    echo'<script>window.location="../placanja.php";</script>';  
} 


?>





