<?php
/**
 * Test unitaire de la fonction normaliser_date_datetime_dist
 * du fichier verifier/date.php
 *
 */

$test = 'normaliser_date_datetime_dist';

$remonte = "../";
while (!is_dir($remonte . "ecrire"))
	$remonte = "../$remonte";

require $remonte . 'tests/test.inc';


//
// hop ! on y va
//
include_spip('verifier/date');
$err = tester_fun('normaliser_date_datetime_dist', essais_normaliser_date_datetime_dist());

// si le tableau $err est pas vide ca va pas
if ($err){
	die ('<dl>' . join('', $err) . '</dl>');
}

echo "OK";

function essais_normaliser_date_datetime_dist(){
	$erreur_standard = _T('verifier:erreur_date_format');
	$essais = [

		// Dates seules
		//ajm
		['2021-03-22 00:00:00','2021/03/22',['format' => 'amj'], ''],
		//jma
		['2021-03-22 00:00:00','22/03/2021',['format' => 'jma'], ''],
		//mja
		['2021-03-22 00:00:00','03/22/2021',['format' => 'mja'], ''],

		// Avec les heures
		//Amj
		['2021-03-22 20:00:00','2021/03/22', ['heure' => '20:00', 'format' => 'amj'], ''],
	];

	return $essais;
}

