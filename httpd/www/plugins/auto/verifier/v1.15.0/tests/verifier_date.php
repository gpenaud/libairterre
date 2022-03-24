<?php
/**
 * Test unitaire de la fonction verifier_date_dist
 * du fichier verifier/date.php
 *
 */

$test = 'verifier_date';

$remonte = "../";
while (!is_dir($remonte . "ecrire"))
	$remonte = "../$remonte";

require $remonte . 'tests/test.inc';


//
// hop ! on y va
//
$verifier_date = charger_fonction('date', 'verifier');
$err = tester_fun($verifier_date, essais_verifier_date());

// si le tableau $err est pas vide ca va pas
if ($err){
	die ('<dl>' . join('', $err) . '</dl>');
}

echo "OK";

function essais_verifier_date(){
	$erreur_standard = _T('verifier:erreur_date_format');
	$erreur_date_inexistante = _T('verifier:erreur_date');
	$essais = [

		// Dates seules
		//ajm
		[$erreur_date_inexistante,'2021/22/03',['format'=>'amj']],// Pas de 22ème mois!
		[$erreur_standard, '03/03/2021',['format'=>'amj']],// Une date mal formatée
		['','2021/03/22',['format' => 'amj']],
		//jma
		[$erreur_date_inexistante,'03/22/2021',['format' => 'jma']],// Pas de 22ème mois!
		['','22/03/2021',['format' => 'jma']],
		//mja
		[$erreur_date_inexistante,'22/03/2021',['format' => 'mja']],// Pas de 22ème mois!
		['','03/22/2021',['format' => 'mja']],
		// Deja formaté en mysql
		['','2021-03-22 12:11:10',['format' => 'mja', 'normaliser' => 'datetime']],
		// Avec les heures
		//Amj
		['',['date'=>'2021/03/22', 'heure' => '20:00'],['format' => 'amj']],
		[_T('verifier:erreur_heure'),['date'=>'2021/03/22', 'heure' => '20:68'],['format' => 'amj']],//Pas de 68'eme minutes
		[_T('verifier:erreur_heure'),['date'=>'2021/03/22', 'heure' => '25:01'],['format' => 'amj']],//Pas de 25ème heure


	];

	return $essais;
}

