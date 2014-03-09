<?php 
if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	echo 'Erreur, pas d\'ID';
}
if(isset($_GET['type'])){
	$type = $_GET['type'];
} else {
	echo 'Erreur, pas de type';
}

$inscription = inscription::getDetails($id);

ob_start();
?>
<page><?php tool::output($inscription);?></page>

<?php $content = ob_get_clean(); 
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->writeHTML($content);
	$pdf->Output('test.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}

?>