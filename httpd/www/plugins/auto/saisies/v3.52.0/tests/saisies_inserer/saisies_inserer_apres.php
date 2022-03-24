<?php
/**
 * Test unitaire de la fonction saisies_inserer, avec heritage
 * du fichier ../plugins/saisies/inc/saisies_manipuler.php
 *
 */

$test = 'saisies_inserer_apres';
$remonte = "../";
while (!is_dir($remonte."ecrire"))
	$remonte = "../$remonte";
require $remonte.'tests/test.inc';
find_in_path("../plugins/saisies/inc/saisies.php",'',true);

// chercher la fonction si elle n'existe pas
function tester_saisies_inserer_apres($saisies, $saisie,  $chemin='') {
	if (!function_exists($f='saisies_inserer_apres')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}
	return saisies_supprimer_identifiants($f($saisies, $saisie, $chemin));
}
$g =  'tester_saisies_inserer_apres';

$err = tester_fun($g, essais_saisies_inserer_apres());

// si le tableau $err est pas vide ca va pas
if ($err) {
	die ('<dl>' . join('', $err) . '</dl>');
}

echo "OK";

// On va tester essentiellement sur des set_request, le cas $env étant normalement identique

function essais_saisies_inserer_apres(){
	$essais = array (
		//
		array(
			0 =>  array (
				array(
					'saisie' => 'fieldset',
					'options' => array('nom' => 'fieldset'),
					'saisies' => array(
						0 =>
						array (
							'saisie' => 'input',
							'options' =>
							array (
								'nom' => 'input_1',
							)
						),
						1 =>
						array (
							'saisie' => 'input',
							'options' =>
							array (
								'nom' => 'input_a_inserer'
							)
						),
					)
				),
			),
			1 => array (
				0 => array(
					'saisie' => 'fieldset',
					'options' => array('nom' => 'fieldset'),
					'saisies' => array(
						array (
							'saisie' => 'input',
							'options' =>
							array (
								'nom' => 'input_1',
							)
						)
					),
				)
			),
			2 =>
			array (
				'saisie' => 'input',
				'options' =>
				array (
					'nom' => 'input_a_inserer'
				)
			),
			'3' => 'input_1'
		),
	);
	return $essais;
}


?>
