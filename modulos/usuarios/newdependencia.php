<?php
/**
 * Created by PhpStorm.
 * User: parzibyte
 * Date: 13/09/2016
 * Time: 04:11 PM
 */

#Definimos la raíz del directorio
if (!defined("RAIZ")) define("RAIZ", dirname(dirname(dirname(__FILE__))));
include RAIZ . "/modulos/db.php";
include RAIZ . "/modulos/usuarios/usuarios.php";
include RAIZ . "/modulos/funciones.php";
inicia_sesion_segura();
$id=$_POST["id"];
$dep=$_POST["dep"];
$resultado = change_dependencia($id, $dep);
echo json_encode($resultado);
?>