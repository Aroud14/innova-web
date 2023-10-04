$('body').on('submit','.form_guardar', function(e){
    e.preventDefault();

    formData = new FormData(document.getElementById($(this).attr('id')));
    var url = $(`#${$(this).attr('id')}`).attr('action');

    $.ajax({
        type:'POST',
        url:url,
        contentType: false,
        processData: false,
        datatype: "JSON",
        data: formData,
        beforeSend: function(){
            $("#btn_guardar").val("Enviando..");
            $("#btn_guardar").attr("disabled","disabled");
        }
    }).done(function (response) {
        datos = JSON.parse(response);

        Swal.fire({
            icon: datos.icono,
            title: datos.titulo,
            text: datos.mensaje,
        });
    }).fail(function (response) {
        console.log("fallo");
        console.log(response);
    });

	$("#btn_guardar").val("Guardar");
	$("#btn_guardar").attr("disabled",false);
})