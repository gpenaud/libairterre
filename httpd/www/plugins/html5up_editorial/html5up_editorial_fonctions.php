<?php
/**
 * Fonctions utiles au plugin Html5up Editorial 
 *
 * @plugin     Html5up Editorial 
 * @copyright  2017
 * @author     chankalan
 * @licence    GNU/GPL
 * @package    SPIP\Html5up_editorial\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Créer une balise image adaptée au thème
 *
 * Équivalent de :
 *
 *     [(#LOGO_RUBRIQUE
 *         |image_passe_partout{300,300}
 *         |image_recadre{300,300,center}
 *         |vider_attribut{height}
 *         |vider_attribut{width}
 *         |vider_attribut{class})]
 *
 */
function html5up_image_reduire($img, $width = 416, $height = 256) {
	if (defined('_DIR_PLUGIN_CENTRE_IMAGE')) {
		$img = filtrer('image_recadre', $img, "$width:$height", '-', 'focus');
	}
	$img = filtrer('image_passe_partout', $img, $width, $height);
	$img = filtrer('image_recadre', $img, $width, $height, 'center');
	$img = filtrer('image_graver', $img);
	$img = vider_attribut($img, 'width');
	$img = vider_attribut($img, 'height');
	$img = vider_attribut($img, 'class');
	return $img;
}