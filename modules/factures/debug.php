<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php $year = $_GET['annee']; ?>

<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Factures <?php echo $year; ?> - Debug</h1>
        </div>
    </div>
</div>

<?php $factures = facture::getListByYear($year); ?>

<table class="table">
    <?php foreach ($factures as $facture): ?>
    <tr>
        <td style="border-top: 2px dashed #666;"><?php echo $facture->id; ?></td>
        <td style="border-top: 2px dashed #666;"><?php echo $facture->number; ?></td>
        <td style="border-top: 2px dashed #666;"><?php echo $facture->total_amount; ?></td>
        <td style="border-top: 2px dashed #666;"><?php echo $facture->total_amount_facture; ?></td>
        <?php if ($facture->total_amount == $facture->total_amount_facture): ?>
        <td style="border-top: 2px dashed #666;">-</td>
        <?php else: ?>
        <td style="border-top: 2px dashed #666;">Oui</td>
        <?php endif ?>
    </tr>
    <?php $facture_items = facture_item::getByFacture($facture->id); ?>
    <?php foreach ($facture_items as $facture_item): ?>
        <?php $inscription = inscription::get($facture_item->ref_inscription); ?>
        <?php //tool::output( $facture_item ); ?>
        <?php if ( !empty( $facture_item->ref_inscription )): ?>
            <?php if ( empty( $inscription ) ): ?>
                <tr style="background-color: rgba(240, 157, 157, 0.48);">
            <?php else: ?>
                <tr>
            <?php endif; ?>
        <?php else: ?>
            <tr style="background-color:rgba(47, 47, 47, 0.18);">
        <?php endif; ?>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; #<?php echo $facture_item->id; ?></td>
            <td colspan="2">
                <?php if (!empty($inscription)): ?>
                    <?php echo $inscription->id; ?> - 
                    <?php $enfant = enfant::get($inscription->ref_enfant); ?>
                    <a href="/enfants/infos/id/<?php echo $enfant->id; ?>"><?php echo $enfant->firstname; ?> <?php echo $enfant->lastname; ?></a>
                <?php else: ?>
                    <?php tool::output( $facture_item->ref_inscription ); ?>
                <?php endif; ?>
            </td>
            <td><?php echo $facture_item->payed_amount; ?></td>
            <?php if ($facture_item->amount == $facture_item->payed_amount): ?>
                <td>-</td>
            <?php else: ?>
                <td>Oui</td>
            <?php endif; ?>
        </tr>
        
    <?php endforeach ?>
    <?php endforeach; ?>
</table>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>