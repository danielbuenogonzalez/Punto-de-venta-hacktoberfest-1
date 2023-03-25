<?php

#Definimos la raíz del directorio
if ( !defined( "RAIZ" ) ) 
{
	define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}
$dep = $_POST["dep"];
require_once RAIZ . "/modulos/funciones.php";
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/dependencias/dependencias.php";
inicia_sesion_segura();
$resultado = save_dependecias($dep);
echo json_encode($resultado);
?>