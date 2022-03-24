<?php

/*
 * Squelette : plugins/contact/formulaires/contact_champ_texte.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/contact/formulaires/contact_champ_texte.html
// Temps de compilation total: 0.164 ms
//

function html_89bf7e96d0006c5959113de6b78c7f95($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<li class=\'editer editer_texte saisie_texte obligatoire' .
(($t1 = strval(interdire_scripts(((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'texte')) ?' ' :''))))!=='' ?
		(' ' . $t1 . 'erreur') :
		'') .
'\'>
<label for="contact_texte">' .
_T('public|spip|ecrire:info_texte_message') .
' <strong>' .
_T('public|spip|ecrire:info_obligatoire_02') .
'</strong></label>
' .
(($t1 = strval(interdire_scripts(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'texte'))))!=='' ?
		('<span class="erreur_message">' . $t1 . '</span>') :
		'') .
'
<textarea name="texte" id="contact_texte" rows="8" cols="60"' .
(($t1 = strval(interdire_scripts((include_spip('inc/config')?lire_config('contact/barre','no_barre',false):''))))!=='' ?
		(' class="' . $t1 . '"') :
		'') .
'>' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'texte', null),true)) .
'</textarea>
</li>');

	return analyse_resultat_skel('html_89bf7e96d0006c5959113de6b78c7f95', $Cache, $page, 'plugins/contact/formulaires/contact_champ_texte.html');
}
?>