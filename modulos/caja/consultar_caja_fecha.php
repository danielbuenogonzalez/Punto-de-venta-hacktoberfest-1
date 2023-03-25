<?php
if( !isset( $_POST["fecha_inicio"] ) ) exit();
#Definimos la raíz del directorio
if ( !defined( "RAIZ" ) ) 
{
	define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$id = $_POST["id"];
$admin = $_POST["admin"];
$dependencia=null;
if( isset( $_POST["dependencias"])){
	$dependencia = $_POST["dependencias"];
}

require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/caja/caja.php";
$movimientos_caja = consultar_movimientos( $fecha_inicio, $fecha_fin,$id,$admin,$dependencia);
echo json_encode($movimientos_caja);
?>