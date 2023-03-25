

$(document).ready(function () {
    consultar_dependencias();
    $("#nuevo").click(function () {
        $("#modal_formulario").modal("show");
    });
    $("#guardar_dep").click(function () {
        var dep = $("#nombe_dependecia").val();
          
        var mensaje_error = undefined;
        if (!dep) {
            $("#nombe_dependecia")
                .parent()
                .addClass('has-error')
            $("#nombe_dependecia").focus().animateCss("shake");
            return;
        }
        insertar_dep(dep);
    });

    $("#actualizar_dep").click(function () {
        var id_dep = $("#id_edit").val();
        var nombre =  $("#edit_nombe_dependecia").val();
        var mensaje_error = undefined;
        if (!nombre) {
            $("#nombe_dependecia")
                .parent()
                .addClass('has-error')
            $("#nombe_dependecia").focus().animateCss("shake");
            return;
        }
        actualizar_dep(id_dep,nombre);
    });
});
function actualizar_dep(id_dep,nombre){
    $.post('./modulos/dependencias/actualizar.php', {
        id_dep:id_dep,
        nombre:nombre
    }, function (respuesta) {
        console.log(respuesta)
        respuesta = JSON.parse(respuesta);
        if (respuesta === true) {
            $("#mostrar_resultados").html("Correcto").parent().addClass('alert-success').show();
            $("input").val("");
            setTimeout(function () {
                $("#modal_formulario_edit").modal("hide");
                consultar_dependencias();
            }, 1000)
        } else {
            $("#mostrar_resultados").html("Error: " + respuesta).parent().addClass('alert-danger').show();
        }
    }); 
}
function consultar_dependencias() {
    $.post('./modulos/dependencias/get_dependencias.php', function (respuesta) {
        
        respuesta = JSON.parse(respuesta);
        dibuja_tabla_dependencias(respuesta);

    });
}
function edit(id){
   
    $("#edit_nombe_dependecia").val($("#name-"+id).val()); 
    console.log($("#name-"+id).val());
    $("#id_edit").val(id); 
    $("#modal_formulario_edit").modal("show");
}
function dibuja_tabla_dependencias(respuesta) {
    $("#tabla-contenedora tbody")
        .empty();
    for (var i = respuesta.length - 1; i >= 0; i--) {
        $("#tabla-contenedora tbody")
            .append(
                $("<tr>")
                    .append(
                        $("<td>")
                            .html(respuesta[i].id),
                       $("<td>")
                            .html(respuesta[i].nombre),
                        $("<td>")
                            .html('<input id="name-'+respuesta[i].id+'" type="hidden" name="" value="'+respuesta[i].nombre+'"><button class="btn btn-warning" onclick=edit('+respuesta[i].id+')><i class="fa fa-edit"></i></button>'),
                            
                    )
            );

    }
}

function dibujarselect(){
    $.post('./modulos/dependencias/get_dependencias.php', function (respuesta) {
        console.log(respuesta)
        respuesta = JSON.parse(respuesta);
        dibujaropt(respuesta);
    });
    
}
function dibujaropt(respuesta){
    console.log(respuesta.length);
    for (var i =0;i < respuesta.length ; i ++ ) {
        console.log(respuesta[i])
        $(".dependencia")
            .append(  $("<option>", {
                value: respuesta[i].id,
                text:  respuesta[i].nombre
            })
            );

    }
}

function insertar_dep(dep) {
$("#mostrar_resultados").html("Registrando... <i class='fa fa-spin fa-circle-o-notch'></i>").parent().addClass('alert-warning').show();
dep = JSON.stringify(dep);

$.post('./modulos/dependencias/save_dep.php', {
    dep: dep
}, function (respuesta) {
    respuesta = JSON.parse(respuesta);
    if (respuesta === true) {
        $("#mostrar_resultados").html("Correcto").parent().addClass('alert-success').show();
        $("input").val("");
        setTimeout(function () {
            $("#modal_formulario").modal("hide");
            consultar_dependencias();
        }, 1000)
    } else {
        $("#mostrar_resultados").html("Error: " + respuesta).parent().addClass('alert-danger').show();
    }
});
}