<?php
function get_dependencias(){
    global $base_de_datos;
	
	$sentencia = $base_de_datos->prepare( "select * from dependencias" );
	$sentencia->execute(  );
	return $sentencia->fetchAll();
}

 function save_dependecias($dp)
{
	global $base_de_datos;
	$sentencia = $base_de_datos->prepare("insert into dependencias 
		(nombre)
		values
		(?)");
	
	return $sentencia->execute([$dp]);
}
function actualizar_dependecias($id,$nombre){
	global $base_de_datos;
	$sentencia = $base_de_datos->prepare('UPDATE dependencias SET nombre=? WHERE id = ?');
	
	return $sentencia->execute([$nombre,$id]);
}
?>
