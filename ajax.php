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
<div style="font-weight: 300;" id="ime"><?php echo $row['ime_prezime']; ?></div>
<div>Broj računa</div>
<div style="font-weight: 300;" id="racun"><?php echo $row['broj_racuna']; ?></div>
<div>Suma</div>
<div style="font-weight: 300;" id="suma" type="number" step="any"><?php echo $row['suma']; ?></div>
<div>Naziv uzorka</div>
<div style="font-weight: 300;" id="naziv"><?php echo $row['ime_uzorka']; ?></div>
<button class="btn-modal">Izvrši plaćanje &rarr;</button>
</form>

<?php } ?>