<?php

if(!isset($_SESSION['userSession'])) { session_start(); }
require_once('../actions/db.php');

// // KREIRANJE UZORKA 

if(!empty($_POST['imeuzorak']) && !empty($_POST['racunuzorak']) && !empty($_POST['nazivuzorak']) && !empty($_POST['sumauzorak'])) {
 
                echo'<script>window.location="../vise.php";</script>';  

}


// if(!empty($_POST['ime_prezime']) && !empty($_POST['broj_racuna']) && !empty($_POST['ime_uzorka']) && !empty($_POST['suma'])) { 
//         $racunuzorak = $_POST['broj_racuna']; 
//         $stmtmt5 = $db->prepare("SELECT * FROM kartice WHERE iban = ?"); 
//         $stmtmt5->execute([$racunuzorak]); 
//         if($stmtmt5->rowCount() == 1) { 

//             $racunuzorak = $_POST['broj_racuna']; 

//             $stmtmt33 = $db->prepare("SELECT iban FROM kartice WHERE id_korisnika = ?"); 
//             $stmtmt33->execute([$_SESSION['clientSQLID']]); 
//             $racunposiljaoca = '';
//             foreach($stmtmt33 as $racun) $racunposiljaoca = $racun['iban']; 

//             $statement15 = $db->prepare("SELECT id_korisnika FROM kartice WHERE iban = ?"); 
//             $statement15->execute([$_POST['broj_racuna']]); 
//             $rowsime = $statement15->fetchAll(); 
//             $idprimaoca = ''; 
//             foreach ($rowsime as $row) { $idprimaoca = $row['id_korisnika']; }

//             $statement16 = $db->prepare("SELECT ime_prezime FROM korisnici WHERE id_korisnika = ?"); 
//             $statement16->execute([$idprimaoca]); 
//             $rowsime1 = $statement16->fetchAll(); 
//             $imeprimaoca = '';
//             foreach ($rowsime1 as $row) { $imeprimaoca = $row['ime_prezime']; }

//                 if($racunuzorak != $racunposiljaoca) {
//                 $stmtmt6 = $db->prepare("INSERT INTO uzorci (id_korisnika, ime_prezime, broj_racuna, ime_uzorka, suma) VALUES (?, ?, ?, ?, ?)");

//                 $idkorisnika = $_SESSION['clientSQLID'];
//                 $username = $imeprimaoca;
//                 $imeuzorka = $_POST['ime_uzorka'];
//                 $suma = $_POST['suma'];
        
//                 $stmtmt6->execute([$idkorisnika, $username, $racunuzorak, $imeuzorka, $suma]);
//                 killConnection_PDO($db);
//                 echo'<script>window.location="../placanja.php";</script>';  

//                 }   
//                 elseif($racunuzorak == $racunposiljaoca){
//                     $_SESSION['erroraccount'] = 'Pokušajte unijeti drugi broj računa.';
//                     killConnection_PDO($db);
//                     echo'<script>window.location="../placanja.php";</script>';  
//                     return true;
//                     }  
//                 }  
//                 elseif($stmtmt5->rowCount() == 0){
//                     $_SESSION['error'] = 'GREŠKA! Unijeli ste nepostojeći broj računa.';
//                     killConnection_PDO($db);
//                     echo'<script>window.location="../placanja.php";</script>';  
//                     return true;
//                     }    
//                 }
//         elseif(empty($_POST['ime_prezime']) || empty($_POST['broj_racuna']) || empty($_POST['ime_uzorka']) || empty($_POST['suma'])){
//         $_SESSION['errorfield'] = 'Molimo ispunite sva obavezna polja.';
//         killConnection_PDO($db);
//         echo'<script>window.location="../placanja.php";</script>';  
//         return true;
//         }    


?>