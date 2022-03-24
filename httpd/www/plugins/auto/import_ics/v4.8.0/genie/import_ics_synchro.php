<?php

/**
 * Gestion du génie import_ics_synchro
 *
 * @plugin import_ics pour SPIP
 * @license GPL
 *
 */

if (!defined('_PERIODE_IMPORT_ICS')) {
	define ('_PERIODE_IMPORT_ICS', 1.5*3600);
}
if (!defined('_ECRIRE_INC_VERSION')) return;
include_spip('inc/import_ics');
/**
 * Actualise tous les almanachs
 *
 * @genie import_ics_synchro
 *
 * @param int $last
 *     Timestamp de la dernière exécution de cette tâche
 * @return int
 *     Positif : la tâche a été effectuée
 */
function genie_import_ics_synchro_dist($t){
	//on recupère toutes les infos sur les almanachs
	$date_limite = new DateTime();
	$date_limite->modify('-'._PERIODE_IMPORT_ICS.' second');
	$date_limite = sql_quote($date_limite->format('Y-m-d H:m:s'));
	if(
		$resultat = sql_fetsel('*', 'spip_almanachs', "`derniere_synchro` < $date_limite", '' , '`derniere_synchro` ASC', '0,1')
		and is_array($resultat)
	)
	{
		//pour chacun des almanachs, on va importer les evenements
		$id_almanach = $resultat['id_almanach'];
		spip_log ("Import via génie de l'almanach $id_almanach",'import_ics'._LOG_INFO);
		importer_almanach(
			$id_almanach,
			$resultat['url'],
			$resultat['id_article'],
			array(
				'ete' => $r['decalage_ete'],
				'hiver' => $r['decalage_hiver']
			),
			$r['dtend_inclus']
		);
		spip_log ("Fin de l'import via génie de l'almanach $id_almanach",'import_ics'._LOG_INFO);
	}
	return 1;
}

