<?php

if(!isset($_SESSION['userSession'])) { session_start(); }
require_once('../actions/db.php');

if(!empty($_POST['imeuzorak']) && !empty($_POST['racunuzorak']) && !empty($_POST['nazivuzorak']) && !empty($_POST['sumauzorak'])) { 
        $racunuzorak = $_POST['racunuzorak']; 
        $stmtmt5 = $db->prepare("SELECT * FROM kartice WHERE iban = ?"); 
        $stmtmt5->execute([$racunuzorak]); 
        if($stmtmt5->rowCount() == 1) { 

            $racunuzorak = $_POST['racunuzorak']; 

            $stmtmt33 = $db->prepare("SELECT iban FROM kartice WHERE id_korisnika = ?"); 
            $stmtmt33->execute([$_SESSION['clientSQLID']]); 
            $racunposiljaoca = '';
            foreach($stmtmt33 as $racun) $racunposiljaoca = $racun['iban']; 

            $statement15 = $db->prepare("SELECT id_korisnika FROM kartice WHERE iban = ?"); 
            $statement15->execute([$_POST['racunuzorak']]); 
            $rowsime = $statement15->fetchAll(); 
            $idprimaoca = ''; 
            foreach ($rowsime as $row)  $idprimaoca = $row['id_korisnika']; 

            $statement16 = $db->prepare("SELECT ime_prezime FROM korisnici WHERE id_korisnika = ?"); 
            $statement16->execute([$idprimaoca]); 
            $rowsime1 = $statement16->fetchAll(); 
            $imeprimaoca = '';
            foreach ($rowsime1 as $row)  $imeprimaoca = $row['ime_prezime']; 

                    if($racunuzorak != $racunposiljaoca) {
                    $stmtmt6 = $db->prepare("INSERT INTO uzorci (id_korisnika, ime_prezime, ime_uzorka, broj_racuna, suma) VALUES (?, ?, ?, ?, ?)");

                    $idkorisnika = $_SESSION['clientSQLID'];
                    $username = $imeprimaoca;
                    $imeuzorka = $_POST['nazivuzorak'];
                    $sumauzorak = $_POST['sumauzorak'];
            
                    $stmtmt6->execute([$idkorisnika, $username, $imeuzorka, $racunuzorak, $sumauzorak]);
                    killConnection_PDO($db);
                    echo'<script>window.location="../placanja.php";</script>';  

                    }   
                    else {
                        $_SESSION['error'] = 'Pokušajte unijeti drugi broj računa.';
                        killConnection_PDO($db);
                        echo'<script>window.location="../placanja.php";</script>';  
                        return true;
                    }
            }  
            elseif($stmtmt5->rowCount() == 0){
                $_SESSION['error'] = 'GREŠKA! Unijeli ste nepostojeći broj računa.';
                killConnection_PDO($db);
                echo'<script>window.location="../placanja.php";</script>';  
                return true;
            } 
        } else{
            $_SESSION['error'] = 'Ispunite sva polja.';
            killConnection_PDO($db);
            echo'<script>window.location="../placanja.php";</script>';  
            return true;
        }

?>