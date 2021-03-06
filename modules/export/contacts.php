<?php
// Affiche toutes les contacts et leurs enfant à charge
$structures = structure::getList();
$datas = array();


foreach ( $structures as $structure ) {

    $contacts = contact::getByStructure( $structure->id );

    foreach ( $contacts as $contact ) {

        $enfants = enfant::getByContact($contact->id);

        $datas[] = array(
            utf8_decode('Civilité') => utf8_decode( $contact->civility ),
            utf8_decode('Nom') => utf8_decode( $contact->lastname ),
            utf8_decode('Prénom') => utf8_decode( $contact->firstname ),
            utf8_decode('Structure') => utf8_decode( $structure->name ),
            utf8_decode('Service') => utf8_decode( $structure->service ),
            utf8_decode('Numéro') => utf8_decode( $structure->address_number ),
            utf8_decode('Rue') => utf8_decode( $structure->address_street ),
            utf8_decode('Complément d\'adresse') => utf8_decode( $structure->address_comp ),
            utf8_decode('Code postal') => utf8_decode( $structure->address_postal_code ),
            utf8_decode('Ville') => utf8_decode( $structure->address_city ),
            utf8_decode('Enfant(s) à charge') => utf8_decode( count($enfants) ),
        );
    }

}

$headline = utf8_decode('Contacts');
$filename = 'Contacts';
CSV::export($datas, $filename, $headline);