<?php

#Definimos la raíz del directorio
if ( !defined( "RAIZ" ) ) 
{
	define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}
$id_dep = $_POST["id_dep"];
$nombre = $_POST["nombre"];
require_once RAIZ . "/modulos/funciones.php";
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/dependencias/dependencias.php";
inicia_sesion_segura();
$resultado = actualizar_dependecias($id_dep,$nombre);
echo json_encode($resultado);
?>