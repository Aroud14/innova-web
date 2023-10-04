var params = '';
var cargando = '<center><br><div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div><br>Cargando ...</center>'; 

var url ='';
$('#lnkLogout').on('click', function(){
    sesionClose();
});

function ocModal(){
    //$(".modal").fadeToggle(200);
   // $(".modal-content").html(""); 
    $(".modal").modal('show');   
}

function ocModalCerrar(){
   //  $(".modal-content").html(""); 
    $('.modal').modal('hide');
}

function sesionClose(){
    var url = "php/logout.php";
    $.ajax({
        type:    "post",
        url:     url,
        success: function(data){
            if(data === "1"){
                window.location = "index.php";
                return false;
            }
        }
    });
}

// INICIO BITACORA
function modal_bitacora(id=0, pagina = 0){
    url    = 'pg/bitacora_modal.php';      

    if(pagina != 0) $("#pagina_modal").val(pagina);

    $.ajax({
        beforeSend: function(){
            $("#contenidomodal").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params+"&id2="+id,
        success: function(data){  
            ocModal();          
            $("#contenidomodal").html(data);
            lista_bitacora_modal(id);
        }
        
    });
}

function lista_bitacora_modal(id=0, pagina = 0){
    url    = 'pg/bitacora_modal_lista.php'; 

    if(pagina != 0) $("#pagina_modal").val(pagina);  
    var params = $('#form_busqueda_modal').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado_modal").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params+"&id2="+id,
        success: function(data){  
        ocModal();          
            $("#listado_modal").html(data);
        }
    });
}
// FIN BITACORA

//USUARIOS
function lista_usuario(pagina=0){
    url    = 'pg/usuario_lista.php';
    if(pagina != 0) $("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();
    
    $('#breadcrumb-titulo').html("Usuarios");
    $('#breadcrumb-subtitulo').html("Listado de usuarios");
    $('#breadcrumb-boton-registro').show();
    $('#breadcrumb-boton-regresar').hide();
    $('#mostrar-busqueda').show();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#contenido").html(data);
            /* activarTooltipAjax(); */
        }
    });
}

function registro_usuario(id = '-1'){
    url    = 'pg/usuario_registro.php';  
    params = {'id': id}; 

    if(id > 0) $('#breadcrumb-titulo').html("Editar usuario");
    if(id > 0)$('#breadcrumb-subtitulo').html("Editar");

    if(id <= 0) $('#breadcrumb-titulo').html("Registrar usuario");
    if(id <= 0)$('#breadcrumb-subtitulo').html("Registro");

    $('#breadcrumb-boton-registro').hide();
    $('#breadcrumb-boton-regresar').show();
    $('#mostrar-busqueda').hide();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
            //$('.selectpicker').selectpicker();
            enviar_formulario();
        }
    });
}

function usuario_permiso(id){
    url    = 'pg/usuario_permiso.php';  
    params = {'id': id}; 

    if(id > 0) $('#breadcrumb-titulo').html("PERMISOS DE USUARIO");
    if(id > 0)$('#breadcrumb-subtitulo').html("Configurar permisos del usuario");

    $('#breadcrumb-boton-registro').hide();
    $('#breadcrumb-boton-regresar').show();
    $('#mostrar-busqueda').hide();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){    
            $("#contenido").html(data);
            $("#contenido").trigger('create');
            enviar_formulario();
        }
    });
}

function modal_usuario_horario(id=0, pagina=0){
    url    = 'pg/usuario_modal_horario.php';      
    if(pagina != 0) $("#pagina_modal").val(pagina);
    $.ajax({
        beforeSend: function(){
            $("#contenidomodal").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params+"&id2="+id,
        success: function(data){  
            ocModal();          
            $("#contenidomodal").html(data);
            modal_usuario_horario_lista(id);
            modal_usuario_horario_registro(id);
        }
    });
}

function modal_usuario_horario_lista(id=0, pagina=0){
    url    = 'pg/usuario_modal_horario_lista.php'; 

    if(pagina != 0) $("#pagina-modal").val(pagina);  

    var params = $('#form-busqueda-modal').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado-modal").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params+"&id2="+id,
        success: function(data){          
            $("#listado-modal").html(data);
        }
    });
}

function modal_usuario_horario_registro(id=0, id2=0){
    url    = 'pg/usuario_modal_horario_registro.php';

    params = {'id2': id, 'id3': id2}; 
    $.ajax({
        beforeSend: function(){
            $("#formulario-registro-modal").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){         
            $("#formulario-registro-modal").html(data);
           enviar_formulario("_modal");
        }
    });
}
// FIN DE USUARIOS

////////// INICIO CONFIGURACION
function registro_configuracion(id = 1){
    url    = 'pg/configuracion_registro.php';  
    params = {'id': id}; 
    $.ajax({
        beforeSend: function(){
            $("#contenido").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#contenido").html(data);
            $("#contenido").trigger('create');
            activarTooltipAjax()
            enviar_formulario();
        }
    });
}
////////// FIN CONFIGURACION




////////// INICIO CATÁLOGOS

// INICIO PERMISOS
function permiso_registro(id = '-1'){
    url    = 'pg/permiso_registro.php';  
    params = {'id': id}; 
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            $(".select2").select2();
            enviar_formulario();
        }
    });
}

function permiso_lista(pagina=1){
    var url    = 'pg/permiso_lista.php';    
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params+"&pagina="+pagina,
        success: function(data){            
            $("#listado").html(data);
            activarTooltipAjax()
        }
    });
}

function marcar_permiso(idpa, check){
    $(".checkpadre"+idpa).prop("checked", check);
}
// FIN PERMISOS

// INICIO BLOG

function lista_blog(pagina=0){
    url    = 'pg/blog_lista.php';
    if(pagina != 0) $("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $('#titulo').html("Blog");
    $('#boton-registro').show();
    $('#boton-regresar').hide();
    $('#mostrar-busqueda').show();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
        }
    });
}

function registro_blog(id = '-1'){
    url    = 'pg/blog_registro.php';
    params = {'id': id};

    if(id > 0) $('#breadcrumb-titulo').html("Editar Blog");

    if(id <= 0) $('#breadcrumb-titulo').html("Registrar Blog");

    $('#boton-registro').hide();
    $('#boton-regresar').show();
    $('#mostrar-busqueda').hide();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
            CKEDITOR.replace('text1', {
                customConfig: 'configuracion.js'
            });
            enviar_formulario();
        }
    });

}

//CATEGORIA BLOG
function lista_categoriablog(pagina=0){
    var url    = 'pg/categoria_blog_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function registro_categoriablog(id = '-1'){
    url    = 'pg/categoria_blog_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}

//etiqueta BLOG
function lista_etiquetablog(pagina=0){
    var url    = 'pg/etiqueta_blog_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function registro_etiquetablog(id = '-1'){
    url    = 'pg/etiqueta_blog_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}

// proyectos

function lista_proyecto(pagina=0){
    url    = 'pg/proyecto_lista.php';
    if(pagina != 0) $("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $('#titulo').html("Proyecto");
    $('#boton-registro').show();
    $('#boton-regresar').hide();
    $('#mostrar-busqueda').show();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
        }
    });
}

function registro_proyecto(id = '-1'){
    url    = 'pg/proyecto_registro.php';
    params = {'id': id};

    if(id > 0) $('#breadcrumb-titulo').html("Editar Proyecto");

    if(id <= 0) $('#breadcrumb-titulo').html("Registrar Proyecto");

    $('#boton-registro').hide();
    $('#boton-regresar').show();
    $('#mostrar-busqueda').hide();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
            CKEDITOR.replace('text1', {
                customConfig: 'configuracion.js'
            });
            enviar_formulario();
        }
    });
}

////////// FIN CATÁLOGOS


//MENSAJES DE PAGINA WEB
function lista_mensajes_web(pagina=0){
    url    = 'pg/mensajes_web_lista.php';
    if(pagina != 0) $("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
        }
    });
}



//--------------- Script solo para escribir numeros --------------------

function numeros(){
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key))
    {
        event.preventDefault();
        return false;
    }
}

//--------------- Script solo para escribir numeros --------------------

//--------------- Script solo para delimitar caracteres --------------------

function max_caracteres(object)
{
    if (object.value.length > object.maxLength)
    {
        object.value = object.value.slice(0, object.maxLength)
    }
}

//--------------- Script solo para delimitar caracteres --------------------

function enviar_formulario(id = '') {
    var botton_cargando = $('<button class="btn btn-primary mb-1" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando...</button>');
    var btn_guardar = $("#btn_guardar" + id);
    var btn_original = $("#btn_guardar" + id);
    $('#enviar_formulario'+id).submit(function (e) {
        e.preventDefault();
        var cant_ckeditor = $(".env_editor").toArray().length;
        formData = new FormData($('#enviar_formulario'+id)[0]);
        if(cant_ckeditor != 0)
        {
            for(var i = 1; i <= cant_ckeditor;i++)
            {
                var contenido = CKEDITOR.instances['text'+i].getData();
                formData.append('text'+i, contenido);
            }
        }
        $.ajax({
            type: 'POST',
            url: $("#enviar_formulario" + id).attr('action'),
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function () {
                btn_guardar.replaceWith(botton_cargando);
            },
            success: function (datos) {
                datos = JSON.parse(datos);

                notificacion(datos.mensaje, datos.titulo, datos.tipo);
                if (datos.funcion) {
                    for (i = 0; i < datos.funcion.length; i++) {
                        let param = [];
                        if (datos.params && datos.params[i]) {
                            param = datos.params[i];
                        }
                        window[datos.funcion[i]](...param);
                    }
                }

                // Reemplazar el botón de cargando por el botón de guardar
                botton_cargando.replaceWith(btn_original);
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }

                botton_cargando.replaceWith(btn_original);

                notificacion(msg, 'Error', 'error');
            }
        });
    });

}


//CATEGORIA PROYECTO
function lista_categoriaproyecto(pagina=0){
    var url    = 'pg/categoria_proyecto_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function registro_categoriaproyecto(id = '-1'){
    url    = 'pg/categoria_proyecto_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}

function lista_servicio(pagina=0){
    url    = 'pg/servicio_lista.php';
    if(pagina != 0) $("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $('#titulo').html("Servicio");
    $('#boton-registro').show();
    $('#boton-regresar').hide();
    $('#mostrar-busqueda').show();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
        }
    });
}

function registro_servicio(id = '-1'){
    url    = 'pg/servicio_registro.php';
    params = {'id': id};

    if(id > 0) $('#breadcrumb-titulo').html("Editar Servicio");

    if(id <= 0) $('#breadcrumb-titulo').html("Registrar Servicio");

    $('#boton-registro').hide();
    $('#boton-regresar').show();
    $('#mostrar-busqueda').hide();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
            CKEDITOR.replace('text1', {
                customConfig: 'configuracion.js'
            });
            enviar_formulario();
        }
    });
}

//CATEGORIA SERVICIO
function lista_categoriaservicio(pagina=0){
    var url    = 'pg/categoria_servicio_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function registro_categoriaservicio(id = '-1'){
    url    = 'pg/categoria_servicio_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}

//PREGUNTAS FRECUENTES
function lista_preguntafrecuente(pagina=0){
    var url    = 'pg/pregunta_frecuente_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function registro_preguntafrecuente(id = '-1'){
    url    = 'pg/pregunta_frecuente_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}

// TABLA TESTIMONIO

function lista_testimonio(pagina=0){
    url    = 'pg/testimonio_lista.php';
    if(pagina != 0) $("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $('#titulo').html("Testimonio");
    $('#boton-registro').show();
    $('#boton-regresar').hide();
    $('#mostrar-busqueda').show();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
        }
    });
}

function registro_testimonio(id = '-1'){
    url    = 'pg/testimonio_registro.php';
    params = {'id': id};

    if(id > 0) $('#breadcrumb-titulo').html("Editar Testimonio");

    if(id <= 0) $('#breadcrumb-titulo').html("Registrar Testimonio");

    $('#boton-registro').hide();
    $('#boton-regresar').show();
    $('#mostrar-busqueda').hide();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#contenido").html(data);
            CKEDITOR.replace('text1', {
                customConfig: 'configuracion.js'
            });
            enviar_formulario();
        }
    });
}

//COMENTARIOS

function lista_comentario(pagina=0){
    var url    = 'pg/comentario_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function registro_comentario(id = '-1'){
    url    = 'pg/comentario_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}

//SLIDERS

function slider_lista(pagina=0){
    var url    = 'pg/slider_lista.php';
    if(pagina != 0 )$("#pagina").val(pagina);
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#listado").html(data);
        }
    });
}

function slider_registro(id = '-1'){
    url    = 'pg/slider_registro.php';
    params = {'id': id};
    $.ajax({
        beforeSend: function(){
            $("#formulario_registro").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){
            $("#formulario_registro").html(data);
            $("#formulario_registro").trigger('create');
            enviar_formulario();
        }
    });
}


//CLIENTES
function cliente_lista(pagina=1){
    var url    = 'pg/cliente_lista.php';    
    var params = $('#form_busqueda').serialize();

    $('#boton-registro').show();
    $('#boton-regresar').hide();
    $('#mostrar-busqueda').show();

    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params+"&pagina="+pagina,
        success: function(data){            
            $("#contenido").html(data);
        }
    });
}

function cliente_registro(id = '-1'){
    url    = 'pg/cliente_registro.php';  
    params = {'id': id}; 

    $('#boton-registro').hide();
    $('#boton-regresar').show();
    $('#mostrar-busqueda').hide();
    
    $.ajax({
        beforeSend: function(){
            $("#contenido").html("<center><img src='img/spinner.svg' /><br>Cargando ...</center>");
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#contenido").html(data);
            $("#contenido").trigger('create');
            enviar_formulario();
            //setTimeout(mapa_form, 1000);
        }
    });
}



