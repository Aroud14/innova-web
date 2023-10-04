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

function eliminar(opcion, id, id2=''){
	var url = 'php/eliminar.php';
    var params = {'opcion': opcion, 'id': id, 'id2': id2};
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
					t.dismiss === Swal.DismissReason.cancel &&
					notificacion(msg,'Error', 'error');
				}
			})
		}
	})
}

