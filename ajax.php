<?php

if(!isset($_SESSION['userSession'])) { session_start(); }

require_once('actions/db.php');

$iduzorka = $_POST['iduzorka'];
 
$statement38 = $db->prepare("SELECT * FROM uzorci WHERE id_uzorka = ?"); 
$statement38->execute([$iduzorka]); 
$rowsuzorak = $statement38 -> fetchAll(); 
foreach( $rowsuzorak as $row ){
?>

<form class="modal__form" action="placanja.php" method="post">
<div>Ime i prezime</div>
<div style="font-weight: 300;" value="<?php echo $row['ime_prezime']; ?>" name="imeprimaoca"><?php echo $row['ime_prezime']; ?></div>
<div>Broj računa</div>
<div style="font-weight: 300;" value="<?php echo $row['broj_racuna']; ?>" name="racunprimaoca"><?php echo $row['broj_racuna']; ?></div>
<div>Suma</div>
<div style="font-weight: 300;" value="<?php echo $row['suma']; ?>" name="sumaprimaoca" type="number" step="any"><?php echo number_format((float)$row['suma'], 2, '.', ','); ?> KM</div>
<div>Naziv uzorka</div>
<div style="font-weight: 300;" value="<?php echo $row['ime_uzorka']; ?>" name="imeuzorka"><?php echo $row['ime_uzorka']; ?></div>
<button class="btn-modal" name="izvrsi">Izvrši plaćanje &rarr;</button>
</form>

<?php

$_SESSION['imeprimaoca'] = $row['ime_prezime'];
$_SESSION['racunprimaoca'] = $row['broj_racuna'];
$_SESSION['sumaprimaoca'] = $row['suma'];
$_SESSION['imeuzorka'] = $row['ime_uzorka'];

?>

<?php } ?>
