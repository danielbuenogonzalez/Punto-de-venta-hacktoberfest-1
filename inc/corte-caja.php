<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>

<div class="row visible-print-block">
    <h1 class="text-center">Reporte corte caja</h1>
</div>
<div class="row hidden-print">
    <div class="col-xs-12">
        <p class="h5 text-justify">Elige el lapso de tiempo en el que quieres que se genere el reporte. Lo que veas aquí
            es lo mismo que aparecerá en él.<br>
        </p>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-xs-4 text-center">
        <h4>Del</h4>
        <input id="fecha_inicio" type="datetime-local" class="form-control">
    </div>
    <div class="col-xs-4 text-center">
        <h4>Hasta</h4>
        <input id="fecha_fin" type="datetime-local" class="form-control">
    </div>
    <div class="col-xs-4 text-center">
        <h4>Dependencia</h4>
        <select name="" id="dependencia" class="form-control dependencia">
                 <option value="*" selected>Todos</option>      
        </select>
    </div>
    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo  $_SESSION["id"];?>">
    <input type="hidden" name="is_admin" id="is_admin" value="<?php echo  $_SESSION["administrador"];?>">
</div>
<br>
<div class="row">
    <div class="col-xs-3">
        <h4 class="text-center" hidden="hidden"><strong>Cantidad de ventas:</strong> <span id="totalventa"></span></h4>
    </div>
    <div class="col-xs-3">
        <h4 class="text-center" hidden="hidden"><strong>Caja chica:</strong><br> <span id="caja_chica"></span></h4>
    </div>
    <div class="col-xs-3">
        <h4 class="text-center" hidden="hidden"><strong>Gastos:</strong><br> <span id="gastos"></span></h4>
    </div>
    <div class="col-xs-3">
        <h4 hidden="hidden" class="text-center"><strong>Ventas:</strong><br> <span id="ventas"></span></h4>
    </div>

    <div class="col-xs-6">
        <h3 hidden="hidden" class="text-center"><strong>Total en caja:</strong> <br><span id="total_caja"></span></h3>
    </div>
    <div class="col-xs-6">
        <h3 hidden="hidden" class="text-center"><strong>Utilidad:</strong> <br><span id="utilidad"></span></h3>
    </div>
    
</div>
<div class="row hidden-print">
    <div class="col-xs-12">

        <button class="btn btn-info form-control" id="generar_reporte">Generar reporte <i class="fa fa-file-pdf-o"></i>
        </button>
    </div>
</div>
<div class="row"><br>
<h1>Ventas</h1>
    <div class="col-xs-12">
        <div id="contenedor_tabla" class="table-responsive">
        </div>
    </div>
</div>
<div class="row"><br>
<h1>Gastos</h1>
    <div class="col-xs-12">
        <div id="contenedor_tabla_gastos" class="table-responsive">
        </div>
    </div>
</div>
<div class="row"><br>
<h1>Caja</h1>
    <div class="col-xs-12">
        <div id="contenedor_tabla_caja" class="table-responsive">
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        dibujarselect();
    });
</script>
<script src="./js/reporte-caja.js"></script>