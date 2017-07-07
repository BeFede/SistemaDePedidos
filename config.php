<?php

/*****
Archivo de configuración - proyecto PHP
*****/

/**UTF-8**/
header('Content-Type: text/html; charset=utf-8');

//Rutas Absolutas
global $PROTOCOL;
global $SERVER_PATH;
global $WEB_PATH;

$PROTOCOL = 'http://';
$SERVER_PATH = dirname(__FILE__) . '/';
$HTTP_HOST = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] . '/' : '/';
$WEB_PATH = $PROTOCOL . $HTTP_HOST . 'SistemaDePedidos/';

/*** Función de error ***/
function ERROR($message = "Ha ocurrido un error",  $absolute_path = null, $status_code = 500){
    global $WEB_PATH;
    if(!isset($absolute_path)){
        $absolute_path = $WEB_PATH . "error.php";
    }

    header("Location: $absolute_path?message=$message"); // Si no se encuentra, Apache te lanzará uno por defecto (404).
}

/*** Se lanza un error si se intenta acceder al config.php directamente ***/
if (basename($_SERVER['PHP_SELF']) === 'config.php') {
    ERROR();
}

define("modo_desarrollo", true);

//Se muestran los errores si se está en desarrollo
if(modo_desarrollo){
	ini_set("display_errors", 1);
}
else {
	ini_set("display_errors", 0);
}

error_reporting(E_ALL);

date_default_timezone_set('America/Argentina/Cordoba');

/*** Headers de caché ***/
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');


define("entorno_local", true);
/*** Base de datos ***/
if (entorno_local){
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'sistema_pedidos';
}
else {
	$DB_HOST = '';
	$DB_USER = '';
	$DB_PASS = '';
	$DB_NAME = '';
}


?>
