<?php  
function registrar_gasto( $importe, $concepto, $descripcion, $no_remision, $usuari,$id )
{
	global $base_de_datos;
	$sentencia = $base_de_datos->prepare("insert into gastos 
		(importe, concepto, descripcion, numero_remision, fecha, id_usuario,nombre_usuario)
		values
		(?,?,?,?,?,?,?)");
	return $sentencia->execute( [$importe, $concepto, $descripcion, $no_remision, date("Y-m-d H:i:s"),$id, $usuari] ) and registrar_gasto_caja( $importe, $usuari,$id);
}


function consultar_todos_los_gastos($fecha_inicio, $fecha_fin,$id,$admin)
{
	global $base_de_datos;
	if($admin == 1){
		$sentencia = $base_de_datos->prepare("select * from gastos where fecha > ? and fecha < ? ;");
		$sentencia->execute([$fecha_inicio, $fecha_fin]);
		return $sentencia->fetchAll();
	}else{
		$sentencia = $base_de_datos->prepare("select * from gastos where fecha > ? and fecha < ? and id_usuario = ?;");
		$sentencia->execute([$fecha_inicio, $fecha_fin,$id]);
		return $sentencia->fetchAll();
	}
	
}


function registrar_gasto_caja( $gasto, $usuario,$id )
{
	global $base_de_datos;
	$sentencia = $base_de_datos->prepare("insert into caja (caja_chica, ventas, gastos, fecha, no_venta, id_usuario,nombre_usuario) values (?,?,?,?,?,?,?)");
	return $sentencia->execute( [0,0, $gasto, date("Y-m-d H:i:s"), "null", $id,$usuario] );
}
?>