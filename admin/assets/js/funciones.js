// JavaScript Document 
function enlace_url(index) {
document.location.target='_blank';
document.location.href=index;
}

function aMays(e, elemento) {
tecla=(document.all) ? e.keyCode : e.which; 
 elemento.value = elemento.value.toUpperCase();
}

function cargarTodo(){
	// Owl Carousel
	if($('.product-slide').length > 0 ){
		$('.product-slide').owlCarousel({
			items: 1,
			margin: 30,
			dots : false,
			nav: true,
			loop: false,
			responsiveClass:true,
			responsive: {
				0: {
					items: 1
				},
				800 : {
					items: 1
				},
				1170: {
					items: 1
				}
			}
		});
	}

	//Home popular 
	if($('.owl-product').length > 0 ){
		var owl = $('.owl-product');
			owl.owlCarousel({
			margin: 10,
			dots : false,
			nav: true,
			loop: false,
			touchDrag:false,
			mouseDrag  : false,
			responsive: {
				0: {
					items: 2
				},
				768 : {
					items: 4
				},
				1170: {
					items: 8
				}
			}
		});
	}
	
	$('ul.tabs li').click(function(){
		var $this = $(this);
		var $theTab = $(this).attr('id');
		console.log($theTab);
		if($this.hasClass('active')){
		  // do nothing
		} else{
		  $this.closest('.tabs_wrapper').find('ul.tabs li, .tabs_container .tab_content').removeClass('active');
		  $('.tabs_container .tab_content[data-tab="'+$theTab+'"], ul.tabs li[id="'+$theTab+'"]').addClass('active');
		}
		
	});
}

function activarTooltipAjax(){
    if($('[data-bs-toggle="tooltip"]').length > 0) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    }
}

function activarSelect2(){
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }
}

function combodependientevalor(padre,hijo,pagina){
	//$("#"+hijo).html('<center><img src="img/load.gif"></center>');
	$("#"+padre+" option:selected").each(function () {
    	id=$(this).val();
		$.post("php/combo_dependiente/"+pagina, { id: id }, function(data){
				$("#"+hijo).val(data);
			});
		})
}
	
function combodependiente(padre, hijo, pagina, tipo = 0, parametros = [], funcion = () => true) {
	if (tipo == 0) {
	
		var ids = {};
		
		for (let i = 0; i < parametros.length; i++) {
			ids["id" + (i + 2)] = parametros[i];
		}

		$("#" + padre + " option:selected").each(function() {
			id = $(this).val();
	
			var postData = Object.assign({ id: id }, ids);

			$.post("php/combo_dependiente/" + pagina, postData, function(data) {
				$("#" + hijo).html(data);
				funcion();
			});
	  	})
	} else if(tipo == 1) {
		var id = $("#" + padre).val();
  
		// Construir objeto con IDs adicionales
		var ids = {};

		for (let i = 0; i < parametros.length; i++) {
			ids["id" + (i + 2)] = parametros[i];
		}
	
		// Combinar objeto con IDs adicionales con objeto de ID principal
		var postData = Object.assign({ id: id }, ids);
	
		$.post("php/combo_dependiente/" + pagina, postData, function(data) {
			$("#" + hijo).html(data);
			funcion();
		});
	} else if(tipo == 2){
		var id = $("#" + padre).val();
  
		// Construir objeto con IDs adicionales
		var ids = {};

		for (let i = 0; i < parametros.length; i++) {
			ids["id" + (i + 2)] = parametros[i];
		}
	
		// Combinar objeto con IDs adicionales con objeto de ID principal
		var postData = Object.assign({ id: id }, ids);
	
		$.post("php/api/" + pagina, postData, function(data) {
			$("#" + hijo).val(data);
			funcion();
		});
	}
}

function combodependiente2(padre,padre2,hijo,pagina){
//$("#"+hijo).html('<center><img src="img/load.gif"></center>');
$("#"+padre+" option:selected").each(function () {
	id=$(this).val();
	id2=$("#"+padre2).val();
	$.post("php/combo_dependiente/"+pagina, { id: id, id2: id2 }, function(data){
		$("#"+hijo).html(data);
		//$("#"+hijo).trigger( "create" );
		//$("#"+hijo).selectpicker('refresh');

		});
	})
}

function activa_desactiva(padre,hijo){
	$("#"+padre+" option:selected").each(function () {
    	id=$(this).val();
        if(id == 1){
			document.getElementById(hijo).style.display = "";
		}
		else{
			document.getElementById(hijo).style.display = "none";
		}
	})
}

function checked_activar(padre,hijo)
{
  if (document.getElementById(padre).checked){
     document.getElementById(hijo).style.display = "";
  } else {
     document.getElementById(hijo).style.display = "none";
  }
}

function notificacion(mensaje, titulo, tipo = 'warning'){
	Swal.fire({
		position: 'center',
		icon: tipo,
		title: titulo,
		text: mensaje,
		showConfirmButton: true,
		timer: 5500
	})
}

function notificacion_alerta(titulo, mensaje, tipo = 'warning'){
    Swal.fire({
        title: titulo,
        text: mensaje,
        type: tipo,
        confirmButtonClass: "btn btn-primary",
        buttonsStyling: !1,
      });
}

function mostrarOverlay() {
    $('#overlay-subir').show();
}

// Ocultar el overlay
function ocultarOverlay() {
    $('#overlay-subir').hide();
}

function crear_mascara_tarjeta_bancaria(formularioId, ids2) {
    let formElement = document.getElementById(formularioId);

    if (!formElement) {
        console.log("Formulario no encontrado con id:", formularioId);
        return;
    }

    // Obtener todos los elementos de entrada con IDs que comienzan con "input_tarjeta_bancaria"
    let inputsTarjetaBancaria = formElement.querySelectorAll('[id^="input_tarjeta_bancaria"]');

    inputsTarjetaBancaria.forEach(inputElement => {
        var cleave = new Cleave(inputElement, {
            creditCard: true,
            delimiter: '-',
            onCreditCardTypeChanged: function(type) {
                // Aquí puedes realizar acciones específicas cuando cambia el tipo de tarjeta
                // Por ejemplo, actualizar un icono
                // Si no necesitas esta funcionalidad, puedes omitir esta parte.
				validar_tarjeta_bancaria(inputElement.id);
                if (type) {
                    console.log(type);
                    // Puedes agregar tu lógica para mostrar el icono correspondiente aquí
                }
            }
        });

        inputElement.addEventListener('keyup', function(event) {
            var value = event.target.value.replace(/\D/g, ''); // Eliminar todos los caracteres no numéricos

            if (value.length < 16) {
                event.target.setCustomValidity('El número de tarjeta debe tener al menos 16 dígitos');
                this.classList.add('input-invalido'); // Marcar el campo en rojo
            } else {
                event.target.setCustomValidity('');
                this.classList.remove('input-invalido'); // Quitar la marca roja
            }

            // Habilitar o deshabilitar los botones
            ids2.forEach(buttonId => {
                let button = document.getElementById(buttonId);
                if (button) {
                    button.disabled = (value.length < 16);
                }
            });
        });
    });
}

function validar_tarjeta_bancaria(id) {
    var tarjetaInput = document.getElementById(id);
    var iconoTarjeta = document.getElementById('icono-tarjeta');
  
    var cleave = new Cleave('#' + id, {
      creditCard: true,
      onCreditCardTypeChanged: function(type) {
        // Actualizar el icono del tipo de tarjeta
        if (type) {
            console.log(type);
          iconoTarjeta.innerHTML = '<i class="fab fa-cc-' + type.toLowerCase() + '"></i>';
        } else {
          iconoTarjeta.innerHTML = 'fab';
        }
      }
    });
  
    tarjetaInput.addEventListener('input', function(event) {
      var value = event.target.value.replace(/\D/g, ''); // Eliminar todos los caracteres no numéricos
  
      if (value.length < 16) {
        event.target.setCustomValidity('El número de tarjeta debe tener al menos 16 dígitos');
      } else {
        event.target.setCustomValidity('');
      }
    });
}

function crear_mascara_clabe_interbancaria(formularioId, ids2) {
    let formElement = document.getElementById(formularioId);

    if (!formElement) {
        console.log("Formulario no encontrado con id:", formularioId);
        return;
    }

    // Obtener todos los elementos de entrada con IDs que comienzan con "input_clabe_interbancaria"
    let inputsCLABEInterbancaria = formElement.querySelectorAll('[id^="input_clabe_interbancaria"]');

    inputsCLABEInterbancaria.forEach(inputElement => {
        inputElement.addEventListener('input', function(event) {
            var value = event.target.value.replace(/[^0-9]/g, ''); // Eliminar todos los caracteres que no sean números
            event.target.value = value;

            // Habilitar o deshabilitar los botones
            ids2.forEach(buttonId => {
                let button = document.getElementById(buttonId);
                if (button) {
                    button.disabled = (value.length !== 18);
                }
            });

            // Marcar el campo en rojo si no tiene la longitud adecuada
            if (value.length !== 18) {
                this.classList.add('input-invalido');
            } else {
                this.classList.remove('input-invalido');
            }
        });

        var cleave = new Cleave(inputElement, {
            blocks: [3, 3, 11, 1], // Define los tamaños de los bloques
            delimiter: '-', // Separador de espacio
        });
    });
}
  
function validar_clabe_interbancaria(id){
    var clabeInput = document.getElementById(id);

    clabeInput.addEventListener('input', function(event) {
        var value = event.target.value.replace(/\D/g, ''); // Eliminar todos los caracteres no numéricos
        
        if (value.length < 18) {
        event.target.setCustomValidity('La CLABE  interbancaria debe tener al menos 18 dígitos');
        } else {
        event.target.setCustomValidity('');
        }
    });
}

function crear_mascara_monto(formularioId) {
    let formElement = document.getElementById(formularioId);

    if (!formElement) {
        console.log("Formulario no encontrado con id:", formularioId);
        return;
    }

    // Obtener todos los elementos de entrada cuyos IDs comienzan con "input_monto"
    let inputsMonto = formElement.querySelectorAll('[id^="input_monto"]');

    inputsMonto.forEach(inputElement => {
        new Cleave(inputElement, {
            numeral: true,
            numeralDecimalMark: '.',
            delimiter: ','
        });
    });
}

function crear_mascara_monto_individual(...ids){
    ids.forEach(id => {
        new Cleave('#' + id, {
            numeral: true,
            numeralDecimalMark: '.',
            delimiter: ','
        });
    });
}

function crear_mascara_telefono(formularioId, ids2) {
    let formElement = document.getElementById(formularioId);
    
    if (!formElement) {
        console.log("Formulario no encontrado con id:", formularioId);
        return;
    }

    // Obtener todos los elementos de entrada con IDs que comienzan con "input_telefono"
    let inputsTelefono = formElement.querySelectorAll('[id^="input_telefono"]');

    inputsTelefono.forEach(inputElement => {
        new Cleave(inputElement, {
            phone: true,
            phoneRegionCode: 'MX',
            prefix: '+52',
            noImmediatePrefix: true,
            delimiter: ' ',
        });

        inputElement.addEventListener('keyup', function() {
            // Si el usuario ha ingresado al menos un dígito, realizar la validación
            if (this.value.length > 0) {
                if (validarTelefono(this.value)) {
                    console.log('Teléfono válido');
                    this.classList.remove('input-invalido');
                } else {
                    console.log('Teléfono no válido');
                    this.classList.add('input-invalido');
                }

                // Habilitar o deshabilitar los botones
                ids2.forEach(buttonId => {
                    let button = document.getElementById(buttonId);
                    if (button) {
                        button.disabled = !validarTelefono(this.value);
                    }
                });
            }
        });
    });
}

function validarTelefono(telefono) {
    //console.log("Número antes de limpiar: ", telefono);
    // Remover prefijo y separadores
    let soloNumeros = telefono.replace(/[^\d]/g, '');
    //console.log("Número después de limpiar: ", soloNumeros);

    return soloNumeros.length >= 12;
}

function crear_mascara_CURP(formularioId, ids2) {
    let formElement = document.getElementById(formularioId);

    if (!formElement) {
        console.log("Formulario no encontrado con id:", formularioId);
        return;
    }

    // Obtener todos los elementos de entrada con IDs que comienzan con "input_curp"
    let inputsCURP = formElement.querySelectorAll('[id^="input_curp"]');

    inputsCURP.forEach(inputElement => {
        new Cleave(inputElement, {
            blocks: [4, 6, 6, 2],
            delimiter: '-',
            uppercase: true
        });

        inputElement.addEventListener('keyup', function() {
            // Si el usuario ha ingresado al menos un dígito, realizar la validación
            if (this.value.length > 0) {
                if (validarCURP(this.value)) {
                    console.log('CURP válido');
                    this.classList.remove('input-invalido');

                    // Habilitar todos los botones
                    ids2.forEach(buttonId => {
                        let button = document.getElementById(buttonId);
                        if (button) {
                            button.disabled = false;
                        }
                    });

                } else {
                    console.log('CURP no válido');
                    this.classList.add('input-invalido');

                    // Deshabilitar todos los botones
                    ids2.forEach(buttonId => {
                        let button = document.getElementById(buttonId);
                        if (button) {
                            button.disabled = true;
                        }
                    });
                }
            }
        });
    });
}

function validarCURP(curp) {
    var re = /^[A-Z]{4}\d{6}[A-Z]{6}[A-Z0-9]{2}$/;
    return re.test(curp.replace(/-/g, ''));
}

function crear_mascara_codigo_postal(formularioId, ids2) {
    let formElement = document.getElementById(formularioId);
    
    if (!formElement) {
        console.log("Formulario no encontrado con id:", formularioId);
        return;
    }

    // Obtener todos los elementos de entrada con IDs que comienzan con "input_codigo_postal"
    let inputsCodigoPostal = formElement.querySelectorAll('[id^="input_codigo_postal"]');

    inputsCodigoPostal.forEach(inputElement => {
        new Cleave(inputElement, {
            blocks: [5],
            numericOnly: true
        });

        inputElement.addEventListener('keyup', function() {
            // Si el usuario ha ingresado al menos un dígito, realizar la validación
            if (this.value.length > 0) {
                if (validarCodigoPostal(this.value)) {
                    console.log('Código Postal válido');
                    this.classList.remove('input-invalido');
                    
                    // Habilitar los botones
                    ids2.forEach(buttonId => {
                        let button = document.getElementById(buttonId);
                        if (button) {
                            button.disabled = false;
                        }
                    });

                } else {
                    console.log('Código Postal no válido');
                    this.classList.add('input-invalido');
                    
                    // Deshabilitar los botones
                    ids2.forEach(buttonId => {
                        let button = document.getElementById(buttonId);
                        if (button) {
                            button.disabled = true;
                        }
                    });
                }
            }
        });
    });
}

function validarCodigoPostal(codigoPostal) {
    return codigoPostal.length === 5;
}

function enviar_formulario(id = '') {
    var botton_cargando = $('<button class="btn btn-primary mb-1" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando...</button>');
    var btn_guardar = $("#btn_guardar" + id);
    var btn_original = $("#btn_guardar" + id);
    $('#enviar_formulario' + id).submit(function (e) {
        e.preventDefault();
        formData = new FormData($('#enviar_formulario' + id)[0]);

        Swal.fire({
            title: 'Espera respuesta...',
            text: '¿Estás seguro de que deseas realizar esta acción?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar',
            cancelButtonText: "No, cancelar",
          }).then((result) => {
            if (result.isConfirmed) {

                if (Object.keys(editors).length > 0) {
                    for (let editorID in editors) {
                        let editorContent = editors[editorID].getData();
                        formData.append(editorID, editorContent);
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
                        mostrarOverlay();
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
                        ocultarOverlay();
                        botton_cargando.replaceWith(btn_original);
                    },
                    error: function (jqXHR, exception) {
                        ocultarOverlay();
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
            }
        });
    });
}

function subir(
    opcion, 
    parametros = {},
    mensajes = {
        title:"Enviar datos", 
        text:"¿Estás seguro de que deseas realizar esta acción?", 
        icon:"info"
    },
	botones_desactivar = [],
    id_formulario = ''
){

    var url = 'php/subir.php';
    
    if(id_formulario != ''){
        var formData = new FormData($('#' + id_formulario)[0]);

        // Añadimos el resto de parámetros
        formData.append('opcion', opcion);
        for (var key in parametros) {
            formData.append(key, parametros[key]);
        }

        var postData = formData; 

    }else{
        /* var postData = Object.assign({ 'opcion': opcion }, parametros);
        postData = $.param(postData); */
        postData = new FormData();
        postData.append('opcion', opcion);
        for (var key in parametros) {
            postData.append(key, parametros[key]);
        }
    }
    Swal.fire({
        title: mensajes.title,
        text: mensajes.text,
        icon: mensajes.icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar',
        cancelButtonText: "No, cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type:'post',
                data: postData,
                processData: false,  // Para que jQuery no trate de convertir los datos
                contentType: false,  // Para que jQuery no añada el encabezado 'Content-Type'
				beforeSend: function () {
					for(i=0; i < botones_desactivar.length; i++){
						$('#' + botones_desactivar[i]).attr("disabled","disabled");
					}
					mostrarOverlay();
				},
                success:function(datos){
                    datos = JSON.parse(datos);
                    notificacion(datos.mensaje, datos.titulo, datos.tipo);
                    if(datos.funcion){

                        for(i=0; i < datos.funcion.length; i++){
                            let param = [];
                            if(datos.params && datos.params[i]){
                                param = datos.params[i];
                            }
                            window[datos.funcion[i]](...param);
                        }
                    }

					ocultarOverlay();

					for(i=0; i < botones_desactivar.length; i++){
						$('#' + botones_desactivar[i]).removeAttr("disabled");
					}
                },
                error: function (jqXHR, exception) {
					ocultarOverlay();
					for(i=0; i < botones_desactivar.length; i++){
						$('#' + botones_desactivar[i]).removeAttr("disabled");
					}
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
                    t.dismiss === Swal.DismissReason.cancel &&
                    notificacion(msg,'Error', 'error');
                }
            });
        }
    });
}

function eliminar(opcion, id, id2='', id3=''){
	var url = 'php/eliminar.php';
    var params = {'opcion': opcion, 'id': id, 'id2': id2, 'id3': id3};
	Swal.fire({
		title: 'Eliminar',
		text: "¿Realmente deseas eliminar este registro?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, eliminar',
		cancelButtonText: "No, cancelar",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: url,
				type:'post',
				data: params,
				beforeSend: function(){
					mostrarOverlay();
				},
				success:function(datos){
					datos = JSON.parse(datos);
					notificacion(datos.mensaje, datos.titulo, datos.tipo);
					if(datos.funcion){

						for(i=0; i < datos.funcion.length; i++){
							let param = [];
							if(datos.params && datos.params[i]){
								param = datos.params[i];
							}
							window[datos.funcion[i]](...param);
						}
					}
					ocultarOverlay();
				},
				error: function (jqXHR, exception) {
					ocultarOverlay();
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
					t.dismiss === Swal.DismissReason.cancel &&
					notificacion(msg,'Error', 'error');
				}
			})
		}
	})
}

function recargarPagina(pagina){
    top.location.href="./"+pagina;
}

function showImageGallery(){
    url    = 'pg/image_gallery.php';
    $.ajax({
        beforeSend: function(){
            $("#contenidomodal").html(cargando);
        },
        type:    "post",
        url:     url,
        data:    params,
        success: function(data){  
            ocModal();          
            $("#contenidomodal").html(data);
        }
    });
    
}

function useImageFromModal(imgUrl) {
    // Aquí la lógica para cerrar el modal
    // Y enviar la URL de la imagen a CKEditor.
    // Por ejemplo:
    CKEDITOR.instances['ID_DEL_EDITOR'].insertHtml('<img src="'+imgUrl+'" alt="" />');
}

var editors = {};

function useCkeditor5(){
    // Obtener todos los elementos con la clase "env_editor"
    const editorElements = document.getElementsByClassName("env_editor");

    // Crear una instancia de ClassicEditor para cada elemento
    for (let i = 0; i < editorElements.length; i++) {
        CKEDITOR.ClassicEditor.create(editorElements[i], {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            ckfinder: {
                // La URL que llevará al servidor de CKFinder
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        
                // Opciones adicionales como configurar los permisos, etc.
            },
            toolbar: {
                items: [
                    'ckfinder','|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            //placeholder: 'Welcome to CKEditor&nbsp;5!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                'ExportPdf',
                'ExportWord',
                'CKBox',
                //'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        })
        .then(editor => {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return {
                    upload: () => loader.file.then(file => subirImagenPublica(file))
                };
            };
            editors[editorElements[i].id] = editor;
        })
        .catch(error => {
            console.error('Error al crear el editor:', error);
        });
    }
}

function subirImagenPublica(file) {
    return new Promise((resolve, reject) => {
        const data = new FormData();
        data.append('upload', file);

        $.ajax({
            url: 'php/upload_img.php', // Asegúrate de tener una URL válida aquí
            type: 'POST',
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: (response) => {
                if (response && response.uploaded && response.url) {
                    resolve({
                        default: response.url
                    });
                }
            },
            error: (jqXHR, textStatus, errorThrown) => {
                reject('Error al subir la imagen: ' + errorThrown);
            }
        });
    });
}

function cancelar(formId, funcionesPostCancelacion) {
    // Limpiar todos los campos input
    $("#" + formId + " input").each(function() {
        $(this).val('');
    });

    // Limpiar todos los campos select
    $("#" + formId + " select").each(function() {
        const $select = $(this);
        if ($select.find('option[value=""]').length > 0) {
        $select.val('');
        } else {
        $select.prop('selectedIndex', 0); // Seleccionar el primer elemento si no hay una opción vacía
        }
        $select.trigger('change');  // Forzar la actualización del DOM
    });

    // Ejecutar las funciones post-cancelación
    if (Array.isArray(funcionesPostCancelacion)) {
        for (let i = 0; i < funcionesPostCancelacion.length; i++) {
        const funcionObj = funcionesPostCancelacion[i];
        if (funcionObj && typeof funcionObj.fn === 'function') {
            funcionObj.fn(...(funcionObj.args || []));
        }
        }
    }
}

function ejecutarTransisionEntrada(tiempo=1){
    setTimeout(function() {
        $('.white-box-transition').addClass('show');
    }, tiempo);  // Añade un pequeño retraso para que se pueda ver la transición
}

