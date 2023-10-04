<script>
window.onload = function() {
    cliente_lista();
}

function cancelar(){
    $('#nombre').val("");
    cliente_lista();
}
</script>
<!--NAVEGACION MIGAJAS DE PAN-->
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Cliente</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <a style="float: right;" class="popup-with-form btn btn-success" href="javascript:void(0);" onclick="cliente_registro();" id="boton-registro" > <i class="fa fa-plus"></i> Registrar Cliente</a>
                    <a style="float: right;" class="popup-with-form btn btn-success" href="javascript:void(0);" onclick="cliente_lista();" id="boton-regresar" ></i><-- Regregar</a>
                </div>
            </div>
            <!--FIN NAVEGACION MIGAJAS DE PAN-->

            <div class="row" id="mostrar-busqueda">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">Búsqueda</h3>
                        <form role="form" class="row" id="form_busqueda">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <a  class="btn btn-inverse btn-circle btn-block" onclick="cliente_lista();"><i class="fa fa-search"></i></a>

                            </div>
                            <div class="col-md-1">
                                <a  class="btn btn-danger btn-circle btn-block" onclick="cancelar()"><i class="fa fa-close"></i></a>
                            </div>
                            <input type="hidden" id="pagina" name="pagina" value="1" >
                        </form>
                    </div>
                </div>
            </div>
        <div class="row">
            <div id="contenido" class="col-sm-12 col-md-12 col-xs-12"></div>
        </div>

