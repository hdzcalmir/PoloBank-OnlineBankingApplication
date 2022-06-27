<?php
 
require_once('actions/db.php');

$iduzorka = $_POST['iduzorka'];
 
$statement38 = $db->prepare("SELECT * FROM uzorci WHERE id_uzorka = ?"); 
$statement38->execute([$iduzorka]); 
$rowsuzorak = $statement38 -> fetchAll(); 
foreach( $rowsuzorak as $row ){
?>

<form class="modal__form">
<div>Ime i prezime</div>
<div style="font-weight: 300;" name="imeprimaoca"><?php echo $row['ime_prezime']; ?></div>
<div>Broj računa</div>
<div style="font-weight: 300;" name="racunprimaoca"><?php echo $row['broj_racuna']; ?></div>
<div>Suma</div>
<div style="font-weight: 300;" name="sumaprimaoca" type="number" step="any"><?php echo number_format((float)$row['suma'], 2, '.', ''); ?> KM</div>
<div>Naziv uzorka</div>
<div style="font-weight: 300;"><?php echo $row['ime_uzorka']; ?></div>
<button class="btn-modal" name="izvrsi">Izvrši plaćanje &rarr;</button>
</form>

<?php } ?>

<?php 

// IZVRSAVANJE

?>