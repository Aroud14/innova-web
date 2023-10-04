<script>
    window.onload = function() {
        lista_proyecto();
    }

    function cancelar(){
        $('#n').val('');
        lista_proyecto();
    }
</script>
<!--NAVEGACION MIGAJAS DE PAN-->
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title" id="titulo"></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <a style="float: right; background-color: #66FCF1" class="popup-with-form btn btn-success" href="javascript:void(0);" onclick="registro_proyecto();" id="boton-registro"> <i class="fa fa-plus"></i> Registrar Proyecto</a>
        <a style="float: right; background-color: #66FCF1" class="popup-with-form btn btn-success" href="javascript:void(0);" onclick="lista_proyecto();" id="boton-regresar"><-- Regresar</a>

    </div>
</div>
<!--FIN NAVEGACION MIGAJAS DE PAN-->

<div class="row" id="mostrar-busqueda">
    <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Búsqueda</h3>
            <form role="form" class="row" id="form_busqueda">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label semibold" for="n">Nombre</label>
                            <input type="text" class="form-control" id="n" name="nombre" placeholder="Ingrese el Nombre">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" style="margin-top:33px;">
                            <input type="hidden" name="pagina_modal" id="pagina-modal" value="1">
                            <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_proyecto()" />
                            <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="cancelar()"/>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="pagina" name="pagina" value="1" >
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div id="contenido" class="col-sm-12 col-md-12 col-xs-12"></div>
</div>

