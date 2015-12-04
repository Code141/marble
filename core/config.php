<?php

//--------------------VARIABLES D'ENVIRONEMENT

//TRUE or FALSE = DEV or PROD
define('ENVIRONMENT', TRUE); 

define('SERVER_ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('SITE_ROOT', '/marble/');

define('CORE_PATH', SERVER_ROOT.'core/');
define('APP_PATH', SERVER_ROOT.'app/');

define('CSS_PATH', SITE_ROOT.'app/assets/css/');
define('JS_PATH', SITE_ROOT.'app/script/js/');
define('IMG_PATH', SITE_ROOT.'app/assets/img/');
define('MEDIA_PATH', SITE_ROOT.'app/assets/media/');



//--------------------ROUTE PAR DEFAUT

$defaultController = 'login';
$defaultAction = 'main';


//--------------------DATABASE CONNECT

define('DB_HOST', 'localhost'); // Host name 
define('DB_NAME', 'marble'); // Database name 
define('DB_USER', 'root'); // Mysql username 
define('DB_PASS', 'root'); // Mysql password 


//--------------------TABLES

//tables d'usage
$user="user";
$objet="objet";
$message="message";

//tables de jointure
$marble="marble";
$amis="amis";
$conversation="conversation";
$tree="tree";


?>