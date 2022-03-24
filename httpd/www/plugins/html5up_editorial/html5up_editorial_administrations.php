<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin Html5up Editorial
 *
 * @plugin     Html5up Editorial
 * @copyright  2017
 * @author     chankalan
 * @licence    GNU/GPL
 * @package    SPIP\Html5up_editorial\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Fonction d'installation et de mise à jour du plugin Html5up Editorial .
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function html5up_editorial_upgrade($nom_meta_base_version, $version_cible) {
	$maj = array();
	$maj['create'] = array(
		array('ecrire_config','html5up', array(
			'couleur_accent' => '#f56a6a'
		))
	);
	$maj['1.1.1'] = array(
		array('ecrire_config','html5up', lire_config('html5up_editorial')),
		array('effacer_meta','html5up_editorial')
	);
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}


/**
 * Fonction de désinstallation du plugin Html5up Editorial .
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function html5up_editorial_vider_tables($nom_meta_base_version) {
	effacer_meta($nom_meta_base_version);
	effacer_meta('html5up');
}
