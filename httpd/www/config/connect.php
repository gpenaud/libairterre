<?php
if (!defined("_ECRIRE_INC_VERSION")) return;
defined('_MYSQL_SET_SQL_MODE') || define('_MYSQL_SET_SQL_MODE',true);
$GLOBALS['spip_connect_version'] = 0.8;
spip_connect_db('db.libairterre.local','','libairterre','libairterre','libairtewhphy','mysql', 'spip','','utf8');
?>