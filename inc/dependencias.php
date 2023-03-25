<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>

<link rel="stylesheet" href="./css/abc.css">
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-xs-12">
    <button id="nuevo" class="btn btn-info form-control">Nueva Dependencia </button>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 table-responsive">
        <table id="tabla-contenedora" class="table table-bordered table-striped table-hover table-condensed">
            <thead>
            <tr>

                <th>ID</th>
                <th>Nombre</th>
                
                
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div id="modal_formulario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Dependencia</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usuario">Nombre</label>
                    <input type="text" id="nombe_dependecia" placeholder="Nombre" class="form-control">
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div hidden="hidden" class="alert">
                            <span id="mostrar_resultados">Hola</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <button id="guardar_dep" class="form-control btn btn-success">Guardar</button>
                    </div>
                    <div class="col-xs-6">
                        <button id="cancelar_confirmacion_eliminar" data-dismiss="modal"
                                class="form-control btn btn-warning">Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_formulario_edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Actualizar Dependencia</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usuario">Nombre</label>
                    <input type="text" id="edit_nombe_dependecia" placeholder="Nombre" class="form-control">
                    <input type="hidden" name="" id="id_edit" >
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div hidden="hidden" class="alert">
                            <span id="mostrar_resultados">Hola</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <button id="actualizar_dep" class="form-control btn btn-success">Actualizar</button>
                    </div>
                    <div class="col-xs-6">
                        <button id="cancelar_confirmacion_eliminar" data-dismiss="modal"
                                class="form-control btn btn-warning">Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./js/dependecias.js"></script>
