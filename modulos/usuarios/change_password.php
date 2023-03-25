<?php
/**
 * Created by PhpStorm.
 * User: parzibyte
 * Date: 13/09/2016
 * Time: 04:11 PM
 */
if (!isset($_POST["data"])) exit("Permission denied");
#Definimos la raíz del directorio
if (!defined("RAIZ")) define("RAIZ", dirname(dirname(dirname(__FILE__))));
include RAIZ . "/modulos/db.php";
include RAIZ . "/modulos/usuarios/usuarios.php";
include RAIZ . "/modulos/funciones.php";
inicia_sesion_segura();
$data = json_decode($_POST["data"]);
if ($data->admin != 1) {
    echo json_encode("Tú no eres administrador.".$_SESSION["administrador"]);
    exit();
}

$resultado = change_password($data->rowid, $data->new_password);
echo json_encode($resultado);
?>