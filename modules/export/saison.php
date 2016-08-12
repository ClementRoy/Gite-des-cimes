<?php  

extract($_GET);

$sejours_saison = sejour::getBySaison($id, $year);
$saison = saison::get($id);
$datas = array();

if($type == 1) {
    foreach($sejours_saison as $sejour_saison) {
        $inscriptions = inscription::getBySejour($sejour_saison->id);
        $enfants_id = array();

        foreach ($inscriptions as $inscription) {
            $enfant = enfant::get($inscription->ref_enfant);
            $sejour = sejour::get($inscription->ref_sejour);

            if ( !in_array($enfant->id, $enfants_id) ) {
                $enfants_id[] = $enfant->id;
                $date_from = new DateTime($sejour->date_from);
                $date_to = new DateTime($sejour->date_to);
                $structure = structure::get($enfant->organization);
                $contact = contact::get($enfant->contact);
                $dossier = dossier::get($inscription->ref_dossier);

                $self_assurance_expiration_date = trim($enfant->self_assurance_expiration_date);
                if ( !empty($self_assurance_expiration_date) ) {
                    $self_assurance_expiration_date = new DateTime($enfant->self_assurance_expiration_date);
                    if ($self_assurance_expiration_date->getTimestamp() > 0) {
                        $self_assurance_expiration_date = strftime('%d/%m/%G', $self_assurance_expiration_date->getTimestamp() );
                        $self_assurance_expiration_date = ' ('.$self_assurance_expiration_date.')';
                    } else {
                        $self_assurance_expiration_date = ''; 
                    }
                } else {
                    $self_assurance_expiration_date = '';
                }

                $cpam_attestation_expiration_date = trim($enfant->cpam_attestation_expiration_date);
                if ( !empty($cpam_attestation_expiration_date) ) {
                    $cpam_attestation_expiration_date = new DateTime($enfant->cpam_attestation_expiration_date);
                    if ($cpam_attestation_expiration_date->getTimestamp() > 0) {
                        $cpam_attestation_expiration_date = strftime('%d/%m/%G', $cpam_attestation_expiration_date->getTimestamp() );
                        $cpam_attestation_expiration_date = ' ('.$cpam_attestation_expiration_date.')';
                    } else {
                        $cpam_attestation_expiration_date = ''; 
                    }
                } else {
                    $cpam_attestation_expiration_date = '';
                }



                $datas[] = array(
                    utf8_decode('Nom') => utf8_decode($enfant->lastname),
                    utf8_decode('Prénom') => utf8_decode($enfant->firstname),
                    utf8_decode('Séjour') => utf8_decode($sejour->name . ' (' . strftime('%d %B', $date_from->getTimestamp()) . ' au ' . strftime('%d %B %Y', $date_to->getTimestamp()) . ')'),
                    utf8_decode('N° de sécurité sociale') => utf8_decode( ($enfant->number_ss)? $enfant->number_ss : 'NON' ),
                    utf8_decode('Assurance (RC) (validité)') => utf8_decode( ( ($enfant->self_assurance)? 'OUI' : 'NON' ) . $self_assurance_expiration_date ),
                    utf8_decode('Attestation CPAM') => utf8_decode( ( ($enfant->cpam_attestation)? 'OUI' : 'NON' ) . $cpam_attestation_expiration_date ),
                    utf8_decode('Fiche sanitaire de liaison') => utf8_decode( ($enfant->health_record)? 'OUI' : 'NON' ),
                    utf8_decode('Carnet de vaccination') => utf8_decode( ($enfant->vaccination)? 'OUI' : 'NON' ),
                    utf8_decode('Fiche de séjour') => utf8_decode( ($enfant->stay_record)? 'OUI' : 'NON' ),
                    utf8_decode('Prise en charge') => utf8_decode( ($dossier->supported)? 'OUI' : 'NON' ),
                    utf8_decode('Contrat retourné') => utf8_decode( ($dossier->returned_contract)? 'OUI' : 'NON' ),
                    utf8_decode('Structure') => utf8_decode( (!empty($enfant->organization))? $structure->name : '' ),
                    utf8_decode('Tél') => utf8_decode( (!empty($enfant->organization))? $structure->phone : '' ),
                    utf8_decode('Contact') => utf8_decode( (!empty($contact))? $contact->civility . ' ' . $contact->firstname . ' ' . $contact->lastname : '' ),
                );

            }
        }

	}
	$headline = utf8_decode('Récapitulatif des dossiers pour la saison ' . $saison->name. ' ' . $year);
	$filename = 'Récapitulatif dossiers par age ' . $saison->name. ' ' . $year;
	CSV::export($datas, $filename, $headline);
}