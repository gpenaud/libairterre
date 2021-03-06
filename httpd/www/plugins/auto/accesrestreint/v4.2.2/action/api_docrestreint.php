<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2009                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/headers');

/**
 * Acces aux documents joints securise
 *
 * verifie soit que le demandeur est authentifie
 * soit que le document est publie, c'est-a-dire
 * joint a au moins 1 article, breve ou rubrique publie
 *
 * URLs de la forme :
 * docrestreint.api/id/cle/file
 *
 * @pipeline_appel accesrestreint_repertoires_toujours_autorises
 * @pipeline_appel accesrestreint_pre_vue_document
 *
 * @param null $arg
 */
function action_api_docrestreint_dist($arg = null) {

	// Obtenir l'argument '{id_document}/{cle_action}/{chemin_fichier.ext}'
	if (is_null($arg)) {
		$arg = _request('arg');
	}
	$arg = explode('/', $arg);

	// Supprimer et vider les buffers qui posent des problemes de memory limit
	accesrestreint_vider_buffers();

	// manque des arguments : 404
	if (count($arg) < 3) {
		accesrestreint_afficher_erreur_document(404);
		return;
	}


	// Séparer les 3 arguments
	// file ($f) exige pour eviter le scan id_document par id_document
	$id_document = intval(array_shift($arg));
	$cle         = array_shift($arg);
	$f           = implode('/', $arg);

	// Objet reprenant toutes les infos connues
	$Document = new Accesrestreint_document($f, $id_document, $cle);

	// Simple test de fonctionnement ?
	if ($Document->est_un_test()) {
		echo 'OK';
		return;
	}

	// Insécurisé ( chemin ../ ou absolu ) : 403
	if ($Document->est_insecurise()) {
		$Document->status = 403;
		accesrestreint_afficher_document_selon_status($Document);
		return;
	}

	// inexistant ou non lisible : 404
	if (!$Document->est_existant() or !$Document->est_lisible()) {
		$Document->status = 404;
		accesrestreint_afficher_document_selon_status($Document);
		return;
	}

	/**
	 * Liste les sous répertoires de IMG qui donnent accès aux fichiers
	 * systématiquement (sans autorisations particulières).
	**/
	$repertoires_autorises = pipeline('accesrestreint_repertoires_toujours_autorises', array('nl'));

	if ($Document->est_dans_repertoire($repertoires_autorises)) {
		$Document->status = 200;
		accesrestreint_afficher_document_selon_status($Document);
		return;
	}

	/**
	 * Propose à des plugins de modifier le Document
	 *
	 * Particulièrement pour donner le status http qui convient pour ce document.
	 *
	 * Si ce 'status' est renseigné par un plugin : on affiche le document (ou l'erreur) avec le statut trouvé
	 *
	 * Sinon, il sera calculé automatiquement ensuite :
	 *
	 * - si le document ne fait pas partie de spip_documents : 404
	 * - sinon, test d'autorisation de voir ce document (par clé d'action si indiquée, sinon par l'api autoriser)
	**/
	$Document = pipeline('accesrestreint_pre_vue_document', $Document);

	if ($Document->status) {
		accesrestreint_afficher_document_selon_status($Document);
		return;
	}

	// Un document sans 'status' doit être analysé
	// Est-ce un document SPIP ? Non = 404
	$doc = $Document->get_spip_document();

	if (!$doc) {
		$Document->status = 404;
		accesrestreint_afficher_document_selon_status($Document);
		return;
	}


	// ETag pour gerer le status 304
	$ETag = $Document->get_Etag();

	if (isset($_SERVER['HTTP_IF_NONE_MATCH'])
		and $_SERVER['HTTP_IF_NONE_MATCH'] == $ETag) {
		$Document->status = 304; // Not modified
		accesrestreint_afficher_document_selon_status($Document);
		exit;
	}

	header('ETag: ' . $ETag);

	// Verifier les droits de lecture du document
	if (!$Document->est_autorise()) {
		$Document->status = 403;
	}

	// envoyer le document
	accesrestreint_afficher_document_selon_status($Document);
}

/**
 * Supprimer et vider les buffers qui posent des problemes de memory limit
 *
 * @link http://www.php.net/manual/en/function.readfile.php#81032
 *
 * @return void
**/
function accesrestreint_vider_buffers() {
	@ini_set('zlib.output_compression', '0'); // pour permettre l'affichage au fur et a mesure
	@ini_set('output_buffering', 'off');
	@ini_set('implicit_flush', 1);
	@ob_implicit_flush(1);
	$level = ob_get_level();
	while ($level--) {
		@ob_end_clean();
	}
}

/**
 * Envoie le document au navigateur, en fonction de son status http
 *
 * @uses accesrestreint_afficher_erreur_document()
 * @uses accesrestreint_afficher_document()
 *
 * @param Accesrestreint_document $Document
 * @return void
**/
function accesrestreint_afficher_document_selon_status(Accesrestreint_document $Document) {
	switch ($Document->status) {
		case 304:
		case 403:
		case 404:
			accesrestreint_afficher_erreur_document($Document->status);
			break;

		default:
			accesrestreint_afficher_document($Document);
			break;
	}
}


/**
 * Affiche une page indiquant un document introuvable ou interdit
 *
 * @param string $status
 *     Numero d'erreur (403 ou 404)
 * @return void
**/
function accesrestreint_afficher_erreur_document($status = 404) {
	switch ($status) {
		case 304:
			// not modified : sortir de suite !
			http_status(304);
			exit;

		case 403:
			include_spip('inc/minipres');
			echo minipres('', '', '', true);
			break;

		case 404:
			http_status(404);
			include_spip('inc/minipres');
			echo minipres(_T('erreur') . ' 404', _T('medias:info_document_indisponible'), '', true);
			break;
	}
}

/**
 * Envoie le document au navigateur
 *
 * Soit en document attaché, soit en direct
 *
 * @param Accesrestreint_document $Document
 * @return void
**/
function accesrestreint_afficher_document(Accesrestreint_document $Document) {

	$chemin_fichier = $Document->get_chemin_complet_fichier();

	// document décrit dans la table spip_documents ?
	if ($doc = $Document->get_spip_document()) {
		if ($doc['extension'] === 'pdf') {
			// les pdf sont non embed quand on les affiche en document dans une page, mais si on les envoi il faut les envoyer inline
			// c'est le comportement natif des navigateur, on introduit donc une exception ici, avant l'appel du pipeline
			// pour permettre aux consommateurs de revert si ils veulent
			$doc['inclus'] = 'oui';
		}
		// On passe les infos précises du document à afficher dans un pipeline
		$doc = pipeline('accesrestreint_afficher_document', array(
			'args' => array('document' => $Document),
			'data' => $doc,
		));

		accesrestreint_envoyer_fichier($chemin_fichier, $Document->get_mime_type(), $doc['inclus'] == 'non');
	} else {
		accesrestreint_envoyer_fichier($chemin_fichier, $Document->get_mime_type());
	}

}

/**
 * Envoyer un fichier dont on fourni le chemin, le mime type, en attachment ou non, avec un expire
 *
 * @use accesrestreint_envoyer_fichier_entetes()
 * @use accesrestreint_envoyer_fichier_entier()
 * @use accesrestreint_envoyer_fichier_partie()
 *
 * @param string $fileName
 * @param string $contentType
 * @param false $attachment
 * @param int $expire
 * @throws Exception
 */
function accesrestreint_envoyer_fichier($fileName, $contentType = 'application/octet-stream', $attachment = false, $expire=3600){
	accesrestreint_envoyer_fichier_entetes($fileName, $contentType, $attachment, $expire);

	if (isset($_SERVER['HTTP_RANGE'])) {
		accesrestreint_envoyer_fichier_partie($fileName, $contentType);
	}
	else {
		accesrestreint_envoyer_fichier_entier($fileName, $contentType);
	}
}

/**
 * Envoyer les entetes du fichier, sauf ce qui est lie au mode d'envoi (entier ou par parties)
 * @see accesrestreint_envoyer_fichier()
 * @param string $fileName
 * @param string $contentType
 * @param false $attachment
 * @param int $expire
 */
function accesrestreint_envoyer_fichier_entetes($fileName, $contentType = 'application/octet-stream', $attachment = false, $expire=3600){
	// toujours envoyer un content type, meme vide !
	header('Accept-Ranges: bytes');
	header('Content-Type: ' . $contentType);

	if ($attachment) {
		$f = basename($fileName);
		// ce content-type est necessaire pour eviter des corruptions de zip dans ie6
		header('Content-Type: application/octet-stream');

		header("Content-Disposition: attachment; filename=\"$f\";");
		header('Content-Transfer-Encoding: binary');

		// fix for IE catching or PHP bug issue
		header('Pragma: public');
		header('Expires: 0'); // set expiration time
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	}
	else {
		$f = basename($fileName);
		header("Content-Disposition: inline; filename=\"$f\";");
		header('Expires: ' . intval($expire)); // set expiration time
	}
}

/**
 * Envoyer les contenu entier du fichier
 * @param string $fileName
 * @param string $contentType
 */
function accesrestreint_envoyer_fichier_entier($fileName, $contentType = 'application/octet-stream'){

	if ($size = filesize($fileName)) {
		header('Content-Length: '. $size);
	}

	readfile($fileName);
}

/**
 * Envoyer une partie du fichier
 * Prendre en charge l'entete Range:bytes=0-456 utilise par les player medias
 * source : https://github.com/pomle/php-serveFilePartial/blob/master/ServeFilePartial.inc.php
 *
 * @param string $fileName
 * @param string $contentType
 * @throws Exception
 */
function accesrestreint_envoyer_fichier_partie($fileName, $contentType = 'application/octet-stream'){
	if (!file_exists($fileName)){
		throw new \Exception(sprintf('File not found: %s', $fileName));
	}

	if (!is_readable($fileName)){
		throw new \Exception(sprintf('File not readable: %s', $fileName));
	}


	### Remove headers that might unnecessarily clutter up the output
	header_remove('Cache-Control');
	header_remove('Pragma');


	### Default to send entire file
	$byteOffset = 0;
	$byteLength = $fileSize = filesize($fileName);

	//header('Accept-Ranges: bytes', true);
	//header(sprintf('Content-Type: %s', $contentType), true);

	### Parse Content-Range header for byte offsets, looks like "bytes=11525-" OR "bytes=11525-12451"
	if (isset($_SERVER['HTTP_RANGE']) && preg_match('%bytes=(\d+)-(\d+)?%i', $_SERVER['HTTP_RANGE'], $match)){
		### Offset signifies where we should begin to read the file
		$byteOffset = (int)$match[1];


		### Length is for how long we should read the file according to the browser, and can never go beyond the file size
		if (isset($match[2])){
			$finishBytes = (int)$match[2];
			$byteLength = $finishBytes+1;
		} else {
			$finishBytes = $fileSize-1;
		}

		$cr_header = sprintf('Content-Range: bytes %d-%d/%d', $byteOffset, $finishBytes, $fileSize);

		header("HTTP/1.1 206 Partial content");
		header($cr_header);  ### Decrease by 1 on byte-length since this definition is zero-based index of bytes being sent
	}

	$byteRange = $byteLength-$byteOffset;

	header(sprintf('Content-Length: %d', $byteRange));

	header(sprintf('Expires: %s', date('D, d M Y H:i:s', time()+60*60*24*90) . ' GMT'));


	$buffer = '';  ### Variable containing the buffer
	$bufferSize = 512*16; ### Just a reasonable buffer size
	$bytePool = $byteRange; ### Contains how much is left to read of the byteRange

	if (!$handle = fopen($fileName, 'r')){
		throw new \Exception(sprintf("Could not get handle for file %s", $fileName));
	}

	if (fseek($handle, $byteOffset, SEEK_SET)==-1){
		throw new \Exception(sprintf("Could not seek to byte offset %d", $byteOffset));
	}


	while ($bytePool>0){
		$chunkSizeRequested = min($bufferSize, $bytePool); ### How many bytes we request on this iteration

		### Try readin $chunkSizeRequested bytes from $handle and put data in $buffer
		$buffer = fread($handle, $chunkSizeRequested);

		### Store how many bytes were actually read
		$chunkSizeActual = strlen($buffer);

		### If we didn't get any bytes that means something unexpected has happened since $bytePool should be zero already
		if ($chunkSizeActual==0){
			### For production servers this should go in your php error log, since it will break the output
			trigger_error('Chunksize became 0', E_USER_WARNING);
			break;
		}

		### Decrease byte pool with amount of bytes that were read during this iteration
		$bytePool -= $chunkSizeActual;

		### Write the buffer to output
		print $buffer;

		### Try to output the data to the client immediately
		flush();
	}

	exit();
}


/**
 * Décrit un document qu'un utilisateur cherche à afficher.
 *
 * @note
 *     La propriété 'status' est publique et servira à déterminer
 *     quel type de status http transmettre.
**/
class Accesrestreint_document {

	/**
	 * Identifiant du document demandé, si connu
	 *
	 * 0 si document inconnu.
	 *
	 * @var int
	**/
	private $id_document = 0;

	/**
	 * Clé d'action auteur, si connue
	 *
	 * 0 si inconnue
	 *
	 * @var int|string
	**/
	private $cle_action = 0;

	/**
	 * Chemin du fichier demandé, depuis IMG/
	 *
	 * @var string
	**/
	private $_fichier = '';

	/**
	 * Status HTTP à utiliser pour ce document
	 *
	 * @var string|int
	**/
	public $status = '';

	/**
	 * Mime type pour ce document
	 *
	 * @var string
	**/
	private $mime_type = '';


	/**
	 * Constructeur
	 *
	 * @param int $_fichier
	 *     Chemin du fichier demandé, depuis IMG/
	 * @param int $id_document
	 *     Identifiant du document, si connu
	 * @param int|string $cle_action
	 *     Clé d'action auteur, si connue
	 * @return
	**/
	public function __construct($_fichier, $id_document = 0, $cle_action = 0) {
		$this->_fichier = $_fichier;
		$this->id_document = $id_document;
		$this->cle_action  = $cle_action;
	}

	/**
	 * Récupérer le chemin du fichier (depuis IMG/)
	 * @return string
	**/
	public function get_chemin_fichier() {
		return $this->_fichier;
	}

	/**
	 * Récupérer le numéro de document
	 * @return int
	**/
	public function get_id_document() {
		return $this->id_document;
	}

	/**
	 * Récupérer la clé d'action
	 * @return int|string
	**/
	public function get_cle_action() {
		return $this->cle_action;
	}

	/**
	 * Test si le document demandé vérifie simplement le fonctionnement correct du .htaccess
	 * dans IMG posé par Acces Restreint
	 *
	 * @see accesrestreint_gerer_htaccess()
	 *
	 * return bool
	 *     True si document de test
	 */
	public function est_un_test() {
		return  $this->id_document == 0
			and $this->cle_action == 1
			and $this->_fichier == 'test_acces/.restreint';
	}

	/**
	 * Test si le document demandé n'a pas un chemin d'accès sécurisé
	 *
	 * Par exemple avec ../ ou url absolue http://
	 *
	 * @return bool
	 *     True si le chemin est insécurisé
	**/
	public function est_insecurise() {
		return (strpos($this->_fichier, '../') !== false)
			or (preg_match(',^\w+://,', $this->_fichier));
	}

	/**
	 * Test si le fichier existe
	 *
	 * @return bool True si existe
	**/
	public function est_existant() {
		$chemin_fichier = $this->get_chemin_complet_fichier();
		return file_exists($chemin_fichier);
	}

	/**
	 * Test si le fichier est accessible en lecture
	 *
	 * @return bool True si lisible
	**/
	public function est_lisible() {
		$chemin_fichier = $this->get_chemin_complet_fichier();
		return is_readable($chemin_fichier);
	}


	/**
	 * Test si un document est dans un sous-répertoire à la racine de IMG
	 *
	 * @param string|array $repertoires
	 *     Nom d'un ou plusieurs répertoires
	 * @return bool
	 *     True si le document est contenu dans un de ces répertoires
	**/
	public function est_dans_repertoire($repertoires) {
		if (!$repertoires) {
			return false;
		}
		if (is_string($repertoires)) {
			$repertoires = array($repertoires);
		}
		$repertoires = array_filter($repertoires);

		return preg_match('%^(' . implode('|', $repertoires) . ')/%', $this->_fichier);
	}


	/**
	 * Test l'autorisation de voir ce document (spip)
	 *
	 * @return bool True si on peut voir le document
	**/
	public function est_autorise() {
		$doc = $this->get_spip_document();
		if (!$doc) {
			spip_log('acces interdit, document hors de spip_documents','accesrestreint');
			return false;
		}

		// en controlant la cle passee en argument si elle est dispo
		// (perf issue : toutes les urls ont en principe cette cle fournie dans la page au moment du calcul de la page)
		if ($this->cle_action && !defined('ACCES_RESTREINT_FORCE_AUTORISE')) {
			if ($this->cle_action !== accesrestreint_calculer_cle_document($doc['id_document'], $this->_fichier)) {
				spip_log("acces interdit $this->cle_action erronee pour #".$doc['id_document'].' : '.$this->_fichier,'accesrestreint');
				return false;
			}
			return true;
		}

		// en verifiant le droit explicitement sinon, plus lent !
		if (!function_exists('autoriser')) {
			include_spip('inc/autoriser');
		}

		if (!autoriser('voir', 'document', $doc['id_document'])) {
			spip_log('acces interdit, pas autorise a voir le document #'.$doc['id_document'].' : '.$this->_fichier,'accesrestreint');
			return false;
		}

		return true;
	}


	/**
	 * Retourne la description du document dans la table spip_documents (et spip_types_documents)
	 *
	 * Seulement si ce fichier est un document dans SPIP
	 *
	 * @return array Description du document dans SPIP
	**/
	public function get_spip_document() {
		static $doc = null;
		if (is_null($doc)) {
			include_spip('inc/documents');
			$where = 'documents.fichier = '.sql_quote(set_spip_doc($this->get_chemin_complet_fichier()))
				. ($this->id_document ? ' AND documents.id_document='.intval($this->id_document): '');
			spip_log($where, 'accesrestreint' . _LOG_DEBUG);

			$doc = sql_fetsel(
				'documents.*, types.mime_type, types.inclus',
				'spip_documents AS documents LEFT JOIN spip_types_documents AS types ON documents.extension=types.extension',
				$where
			);

			spip_log($doc, 'accesrestreint' . _LOG_DEBUG);
			if (!$doc) {
				$doc = array();
			}
		}
		return $doc;
	}

	/**
	 * Calcule et retourne le chemin complet  du fichier (depuis la racine du site)
	 *
	 * @return string
	**/
	public function get_chemin_complet_fichier() {
		static $fichier = null;
		if (is_null($fichier)) {
			include_spip('inc/documents');
			$fichier = get_spip_doc($this->_fichier);
			spip_log($fichier, 'accesrestreint' . _LOG_DEBUG);
		}
		return $fichier;
	}

	/**
	 * Calcule et retourne le hash Etag du fichier
	 *
	 * @return string
	**/
	public function get_ETag() {
		static $ETag = null;
		if (is_null($ETag)) {
			$ETag = md5($this->get_chemin_complet_fichier() . ': '. filemtime($this->get_chemin_complet_fichier()));
		}
		return $ETag;
	}

	/**
	 * Calcule et retourne un content type
	 *
	 * Cherche
	 * - un content type déjà indiqué,
	 * - sinon dans le document spip,
	 * - sinon rien
	 *
	 * @note
	 *     Tester l'extension du fichier si on n'en trouve pas ?
	 *
	 * @param bool $calculer
	 *     Calculer le mime type si absent à partir de spip_documents
	 * @return string
	**/
	public function get_mime_type($calculer = true) {
		if ($this->mime_type) {
			return $this->mime_type;
		}
		if (!$calculer) {
			return '';
		}
		if ($doc = $this->get_spip_document()) {
			if ($doc['mime_type']) {
				return $doc['mime_type'];
			}
		}
		return '';
	}

	/**
	 * Définit un type mime pour ce document
	 *
	 * @param string $mime_type Mime type
	**/
	public function set_mime_type($mime_type) {
		$this->mime_type = $mime_type;
	}
}
