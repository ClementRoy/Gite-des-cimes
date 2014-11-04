<?php 
if(isset($_GET['enfant']) && isset($_GET['sejour'])){
	$id = $_GET['enfant'];
	$sejour = $_GET['sejour'];
} else {
	echo 'Erreur, pas d\'ID';
}


$enfant = enfant::get($_GET['enfant']);
$sejour = sejour::get($_GET['sejour']);
$note = note::get($_GET['enfant'], $_GET['sejour']);
ob_start();

?>

	<style type="text/css">
		table {
			width: 100%;
			font-size: 16px;
			vertical-align: top;
		}
		td {width: 100%;}
		tr {width: 100%;}
		.title {
			font-weight: bold;
			text-transform: uppercase;
		}
		h1,h2,h3,h4 {
			margin: 0 0 10px;
		}
		h1 {
			margin-bottom: 0;
			font-size: 30px;
		}
		h2 {
			font-size: 20px;
			margin-top: 5px;
		}
		h3 {
			margin-top: 20px;
			font-size: 16px;
			margin-bottom: 5px;
		}
		table.special p {
			margin: 5px 0;
		}
		p {
			margin: 7px 0;
		}
		ul {
			margin: 0;
			padding-left: 0;
		}
		ul li {
			margin: 0;
			padding-left: 20px;
		}
	</style>
	<page backtop="6mm" backleft="12mm" backright="12mm" backbottom="0mm">
		<table style="width:100%;">
			<tr style="text-align:center;">
				<td style="padding-bottom:80px">
					<h1><?=$enfant->firstname ?> <?=$enfant->lastname ?></h1>
					<h2>Notes suite aux séjours</h2>
				</td>
			</tr>


                <?php $note_creator = user::get($note->creator); ?>
                <?php $note_editor = user::get($note->editor); ?>
                <?php $note_date_created = new DateTime($note->created); ?>
                <?php $note_date_edited = new DateTime($note->edited); ?>

				<?php $date_from = new DateTime($sejour->date_from); ?>
				<?php $date_to = new DateTime($sejour->date_to); ?>               
                <tr>
                    <td style="">
                       <h4>Séjour "<?=$sejour->name ?>" <em>du <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?></em></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?=nl2br($note->message); ?>
                    </td>
                </tr>
                <tr style="text-align:right;">
                    <td style="padding-top:10px;">
                        <em style="color:#858585;font-size:12px;">Par <?=$note_editor->firstname ?> <?=$note_editor->lastname ?> le <?=strftime('%d %B %Y', $note_date_edited->getTimestamp()); ?></em>
                    </td>
                </tr>
		</table>
	</page>

<?php

$content = ob_get_clean(); 
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->writeHTML($content);
	//$pdf->Output($type.'_'.$id.'.pdf');
	$pdf->Output($id.'.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}

?>