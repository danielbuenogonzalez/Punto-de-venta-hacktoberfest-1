<?php


function consultar_movimientos( $fecha_inicio, $fecha_fin,$id,$admin,$dependencia)
{
	global $base_de_datos;
	if($admin==1){
		if($dependencia==null){
			$sentencia = $base_de_datos->prepare( "select * from caja where fecha > ? and fecha < ?  ;" );
			$sentencia->execute( [$fecha_inicio, $fecha_fin] );
			$cajaf=$sentencia->fetchAll();
			 $datos =array();
			for ($x = 0; $x < count($cajaf); $x++) {
				
				$sentencia = $base_de_datos->prepare("select * from usuarios where rowid =?");
				$sentencia->execute([$cajaf[$x]['id_usuario']]);
				$users = $sentencia->fetchAll();
				if($users[0]['dependencia']){
					$sentencia = $base_de_datos->prepare("select * from dependencias where id = ?");
					$sentencia->execute([$users[0]['dependencia']]);
					$dependencias = $sentencia->fetchAll();
					 
					$cajaf[$x]['dependencia']= $dependencias[0]['nombre'];
				}else{
					$cajaf[$x]['dependencia']='No aplica';
				}
				
				array_push($datos,$cajaf[$x]); 
					
			
			}
			return $datos;
		}
		if($dependencia == '*'){
			$sentencia = $base_de_datos->prepare( "select * from caja where fecha > ? and fecha < ?  ;" );
			$sentencia->execute( [$fecha_inicio, $fecha_fin] );
			$cajaf=$sentencia->fetchAll();
			 $datos =array();
			for ($x = 0; $x < count($cajaf); $x++) {
				
				$sentencia = $base_de_datos->prepare("select * from usuarios where rowid =?");
				$sentencia->execute([$cajaf[$x]['id_usuario']]);
				$users = $sentencia->fetchAll();
				if($users[0]['dependencia']){
					$sentencia = $base_de_datos->prepare("select * from dependencias where id = ?");
					$sentencia->execute([$users[0]['dependencia']]);
					$dependencias = $sentencia->fetchAll();
					 
					$cajaf[$x]['dependencia']= $dependencias[0]['nombre'];
				}else{
					$cajaf[$x]['dependencia']='No aplica';
				}
				
				array_push($datos,$cajaf[$x]); 
					
			
			}
			return $datos;
		}else{
			$sent = $base_de_datos->prepare("SELECT * FROM usuarios WHERE dependencia = ?;");
			$sent->execute([$dependencia]);
			$users = $sent->fetchAll();
		
			$datos =array();
			for ($x = 0; $x < count($users); $x++) {
				$sentencia = $base_de_datos->prepare( "select * from caja where fecha > ? and fecha < ? and id_usuario = ? ;" );
				$sentencia->execute( [$fecha_inicio,$fecha_fin,$users[$x]['rowid']] );
				$cajaf = $sentencia->fetchAll();
				for ($i = 0; $i < count($cajaf); $i++) {
					$sentencia = $base_de_datos->prepare("select * from dependencias where id = ?");
					$sentencia->execute([$dependencia]);
					$dependencias = $sentencia->fetchAll();
					$cajaf[$i]['dependencia']= $dependencias[0]['nombre'];
					$dependencias = $sent->fetchAll();
					array_push($datos,$cajaf[$i]);
				}
				
			}
			
		
			return $datos;
		}
		
	}else{
		$sentencia = $base_de_datos->prepare( "select * from caja where fecha > ? and fecha < ? and id_usuario = ? ;" );
		$sentencia->execute( [$fecha_inicio, $fecha_fin,$id] );
		$cajaf=$sentencia->fetchAll();
			 $datos =array();
			for ($x = 0; $x < count($cajaf); $x++) {
				
				$sentencia = $base_de_datos->prepare("select * from usuarios where rowid =?");
				$sentencia->execute([$cajaf[$x]['id_usuario']]);
				$users = $sentencia->fetchAll();
				if($users[0]['dependencia']){
					$sentencia = $base_de_datos->prepare("select * from dependencias where id = ?");
					$sentencia->execute([$users[0]['dependencia']]);
					$dependencias = $sentencia->fetchAll();
					 
					$cajaf[$x]['dependencia']= $dependencias[0]['nombre'];
				}else{
					$cajaf[$x]['dependencia']='No aplica';
				}
				
				array_push($datos,$cajaf[$x]); 
					
			
			}
			return $datos;
	}
	
}


function ingresar_dinero( $cantidad, $usuario )
{
	global $base_de_datos;
	$sentencia = $base_de_datos->prepare("insert into caja 
		(caja_chica, ventas, gastos, fecha, no_venta, id_usuario,nombre_usuario)
		values
		(?,?,?,?,?,?,?)");
	$usuario = $_SESSION["id"];
	return $sentencia->execute([$cantidad, 0, 0, date("Y-m-d H:i:s") ,"null", $usuario,$_SESSION["nombre_de_usuario"]]);
}
?>