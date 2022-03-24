<?php
/**
 * Test unitaire de la fonction saisies_inserer, avec heritage
 * du fichier ../plugins/saisies/inc/saisies_manipuler.php
 *
 */

$test = 'saisies_inserer';
$remonte = "../";
while (!is_dir($remonte."ecrire"))
	$remonte = "../$remonte";
require $remonte.'tests/test.inc';
find_in_path("../plugins/saisies/inc/saisies.php",'',true);

// chercher la fonction si elle n'existe pas
function tester_saisies_inserer($saisies, $saisie,  $chemin='') {
	if (!function_exists($f='saisies_inserer')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}
	return saisies_supprimer_identifiants($f($saisies, $saisie, $chemin));
}
$g =  'tester_saisies_inserer';

$err = tester_fun($g, essais_saisies_inserer());

// si le tableau $err est pas vide ca va pas
if ($err) {
	die ('<dl>' . join('', $err) . '</dl>');
}

echo "OK";

// On va tester essentiellement sur des set_request, le cas $env étant normalement identique

function essais_saisies_inserer(){
	$essais = array (
		// Premier test unitaire : pas de chemin
		array(
			0 =>  array (
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
				)
			),
			1 => array (
				0 =>
				array (
					'saisie' => 'input',
					'options' =>
					array (
						'nom' => 'input_1',
					)
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
		),
		// Deuxième test unitaire : saisies sans fieldset, on insere avant
		array(
			0 =>  array (
				0 =>
				array (
					'saisie' => 'input',
					'options' =>
					array (
						'nom' => 'input_a_inserer'
					)
				),
				1 =>
				array (
					'saisie' => 'input',
					'options' =>
					array (
						'nom' => 'input_1',
					)
				),
			),
			1 => array (
				0 =>
				array (
					'saisie' => 'input',
					'options' =>
					array (
						'nom' => 'input_1',
					)
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
			'3' => array(0)
		),
		// Troisième test unitaire : saisie avec fieldset, on insère en indiquant la saisie devant laquelle inserer
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
								'nom' => 'input_a_inserer'
							)
						),
						1 =>
						array (
							'saisie' => 'input',
							'options' =>
							array (
								'nom' => 'input_1',
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
		// Quatrième test unitaire : saisie avec fieldset, on insère en indiquant le fieldset à la fin duquel insérer
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
								'nom' => 'input_1'
							)
						),
						1 =>
						array (
							'saisie' => 'input',
							'options' =>
							array (
								'nom' => 'input_a_inserer',
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
			'3' => '[fieldset]'
		),
		// Cinquième test unitaire : saisie avec fieldset, on insère en indiquant le fieldset et la position au sein du fieldset
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
								'nom' => 'input_a_inserer',
							)
						),
						1 =>
						array (
							'saisie' => 'input',
							'options' =>
							array (
								'nom' => 'input_1'
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
			'3' => '[fieldset][0]'
		),
	);
	return $essais;
}


?>
