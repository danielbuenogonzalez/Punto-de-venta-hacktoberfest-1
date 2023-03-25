<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>

<div class="row visible-print-block">
    <h1 class="text-center">Reporte sobre gastos</h1>
</div>
<div class="row hidden-print">
    <div class="col-xs-12">
        <p class="h5 text-justify">Elige el lapso de tiempo en el que quieres que se genere el reporte. Lo que veas aquí
            es lo mismo que aparecerá en él.<br>
        </p>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-xs-6 text-center">
        <h4>Del</h4>
        <input id="fecha_inicio" type="datetime-local" class="form-control">
    </div>
    <div class="col-xs-6 text-center">
        <h4>Hasta</h4>
        <input id="fecha_fin" type="datetime-local" class="form-control">
    </div>
    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo  $_SESSION["id"];?>">
    <input type="hidden" name="is_admin" id="is_admin" value="<?php echo  $_SESSION["administrador"];?>">
</div>
<br>
<div class="row">
    <div class="col-xs-4">
        <h4 class="text-center" hidden="hidden"><strong>Total:</strong> $<span id="total_gastos"></span></h4>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-xs-12">
        <button class="btn btn-info form-control" id="generar_reporte">Generar reporte <i class="fa fa-file-pdf-o"></i>
        </button>
    </div>
</div>
<div class="row"><br>
    <div class="col-xs-12">
        <div id="contenedor_tabla" class="table-responsive">
        </div>
    </div>
</div>
<script src="./js/reporte-gastos.js"></script>