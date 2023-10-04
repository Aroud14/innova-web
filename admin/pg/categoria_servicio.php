<script>
    window.onload = function() {
        lista_categoriaservicio();
        registro_categoriaservicio();
    }
    function cancelar(){
        $('#n').val("");
        lista_categoriaservicio();
    }
</script>
<!--NAVEGACION MIGAJAS DE PAN-->
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Catalogo de Categorias Servicio</h4>
    </div>
</div>
<!--FIN NAVEGACION MIGAJAS DE PAN-->

<div class="row">
    <div id="formulario_registro" class="col-sm-4 col-md-4 col-xs-4"></div>
    <div class="col-sm-8 col-md-8 col-xs-8">
        <div class="card-body">

            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="assets/img/icons/filter.svg" alt="img">
                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                            <b>Formulario de búsqueda &nbsp;</b>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Filter -->
            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <form id="form_busqueda" >
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="n">Nombre</label>
                                    <input type="text" class="form-control" id="n" name="nombre" placeholder="Nombre de la Categoria">
                                </div>


                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" style="margin-top:33px;">
                                    <input type="hidden" name="pagina_modal" id="pagina-modal" value="1">
                                    <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_categoriaservicio()" />
                                    <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="cancelar()"/>
                                </div>
                            </div>
                            <input type="hidden" id="pagina" name="pagina" value="1" >
                    </form>
                </div>
            </div>

        </div>
        <div id="listado"></div>
    </div>
</div>