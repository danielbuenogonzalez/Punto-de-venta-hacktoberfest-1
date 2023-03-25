<?php
function consultar_todas_las_ventas_por_familia($fecha_inicio, $fecha_fin,$id)
{
    global $base_de_datos;
    $sql = 'SELECT
  familia,
  sum(total)    AS `total`,
  sum(utilidad) AS `utilidad`
FROM ventas
WHERE fecha >= ? AND fecha <= ? AND id_usuario = ?
GROUP BY familia;';
    $sentencia = $base_de_datos->prepare($sql);
    $sentencia->execute(array($fecha_inicio, $fecha_fin,$id));
    return $sentencia->fetchAll();
}

function consultar_todas_las_ventas($fecha_inicio, $fecha_fin, $familia,$id,$is_admin)
{
    
    global $base_de_datos;
    if ($is_admin === 0) {
        if ($familia === "*") {
            $sql = "SELECT * FROM ventas WHERE fecha > ? AND fecha < ? AND Id_usuario = ? ORDER BY numero_venta DESC;";
        } else {
            $sql = "SELECT * FROM ventas WHERE fecha > ? AND fecha < ? AND familia = ? AND Id_usuario = ?  ORDER BY numero_venta DESC;";
        }
    } else {
        if ($familia === "*") {
            $sql = "SELECT * FROM ventas WHERE fecha > ? AND fecha < ?   ORDER BY numero_venta DESC;";
        } else {
            $sql = "SELECT * FROM ventas WHERE fecha > ? AND fecha < ? AND familia = ? AND Id_usuario = ? AND usuario = ? ORDER BY numero_venta DESC;";
        }
    }
    $sentencia = $base_de_datos->prepare($sql);
    if ($_SESSION["administrador"] === 0) {
        if ($familia === "*") {
            $sentencia->execute([$fecha_inicio, $fecha_fin,$id]);
        } else {
            $sentencia->execute([$fecha_inicio, $fecha_fin, $familia,$id]);
        }
    } else {
        if ($familia === "*") {
            $sentencia->execute([$fecha_inicio, $fecha_fin,]);
        } else {
            $sentencia->execute([$fecha_inicio, $fecha_fin, $familia]);
        }
    }
    return $sentencia->fetchAll();
}


function hacer_venta($productos, $total, $ticket, $cambio,$id)
{
    date_default_timezone_set('America/Mexico_City');
    global $base_de_datos;
    require_once "../inventario/inventario.php";
    $numero_venta = ultimo_numero_de_venta();
    $todo_correcto = true;
    foreach ($productos as $producto) {
        $todo_correcto = $todo_correcto and quitar_piezas($producto->cantidad, $producto->rowid);
        $sentencia = $base_de_datos->prepare("INSERT INTO ventas(numero_venta, codigo_producto, nombre_producto, total, fecha, numero_productos, usuario,id_usuario, familia, utilidad) VALUES (?,?,?,?,?,?,?, ?, ?,?);");
        $resultado_sentencia = $sentencia->execute(array($numero_venta, $producto->codigo, $producto->nombre, $producto->cantidad * $producto->precio_venta, date("Y-m-d H:i:s"), $producto->cantidad, $_SESSION["nombre_de_usuario"],$id, $producto->familia, $producto->utilidad * $producto->cantidad));
        $todo_correcto = $todo_correcto and $resultado_sentencia;
         
    }
    $todo_correcto = $todo_correcto and ingresar_dinero_venta_caja($total, $numero_venta,$id);
    if ($ticket === TRUE) {
        include "../ticket.php";
        imprime_ticket($productos, $numero_venta, $cambio);
    }
    return $todo_correcto;
}

function ingresar_dinero_venta_caja($total, $numero_venta,$id)
{
    global $base_de_datos;
    $usuario = $_SESSION["nombre_de_usuario"];
    $sentencia = $base_de_datos->prepare("INSERT INTO caja (caja_chica, ventas, gastos, fecha, no_venta,id_usuario,nombre_usuario) VALUES (?,?,?,?,?,?,?)");
    $resultado_sentencia = $sentencia->execute([0, $total, 0, date("Y-m-d H:i:s"), $numero_venta, $id ,$_SESSION["nombre_de_usuario"]]);
    return $resultado_sentencia;
}


function comprueba_si_existe_codigo($codigo)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT count(*) AS count FROM inventario WHERE codigo = ?;");
    $sentencia->execute([$codigo]);
    $fila = $sentencia->fetch();
    $numero_filas = $fila["count"];
    if ($numero_filas >= 1) {
        $sentencia = $base_de_datos->prepare("SELECT * FROM inventario WHERE codigo = ?;");
        $sentencia->execute([$codigo]);
        return $sentencia->fetch();
    }
    return false;
}


function devolver_datos_autocompletado($busqueda)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT * FROM inventario WHERE codigo LIKE ? OR nombre LIKE ? LIMIT 10;");
    $sentencia->execute(["%$busqueda%", "%$busqueda%",]);
    return $sentencia->fetchAll();
}


function ultimo_numero_de_venta()
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT numero_venta AS ultima_venta FROM ventas ORDER BY numero_venta DESC LIMIT 1;");
    $sentencia->execute();
    $fila = $sentencia->fetch();
    if ($fila === FALSE) return 1;
    return $fila["ultima_venta"] + 1;
}

?>