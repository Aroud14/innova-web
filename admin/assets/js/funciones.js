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