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
function configuracion_registro(id = 1){
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
            useCkeditor5();
            enviar_formulario();
            activarTooltipAjax()
            ejecutarTransisionEntrada(190);
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



// INICIO ESTADOS
function registro_estado(id = '-1'){
    url    = 'pg/estado_registro.php';  
    params = {'id': id}; 

    $.ajax({
        beforeSend: function(){
            $("#formulario-registro").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#formulario-registro").html(data);
            $("#formulario-registro").trigger('create');
            enviar_formulario();
        }
    });
}

function lista_estado(pagina = 0){
    if(pagina != 0) $("#pagina").val(pagina);
    var url    = 'pg/estado_lista.php';    
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#listado").html(data);
            activarTooltipAjax()
        }
    });
}
// FIN ESTADOS



// INICIO MUNICIPIO
function registro_municipio(id = '-1'){
    url    = 'pg/municipio_registro.php';  
    params = {'id': id}; 

    $.ajax({
        beforeSend: function(){
            $("#formulario-registro").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#formulario-registro").html(data);
            $("#formulario-registro").trigger('create');
            enviar_formulario();
        }
    });
}

function lista_municipio(pagina=0){
    if(pagina != 0) $("#pagina").val(pagina);
    var url    = 'pg/municipio_lista.php';    
    var params = $('#form_busqueda').serialize();

    $.ajax({
        beforeSend: function(){
            $("#listado").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){            
            $("#listado").html(data);
            activarTooltipAjax()
        }
    });
}
// FIN MUNICIPIO

////////// FIN CATÁLOGOS




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