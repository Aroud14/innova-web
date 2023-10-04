<script>
    window.onload = function () {
        lista_usuario();
    }

    function cancelar(){
        $("#n").val("");
        $("#u").val("");
        lista_usuario();
    }
</script>

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h4 id="breadcrumb-titulo"></h4>
        <h6 id="breadcrumb-subtitulo"></h6>
    </div>
    <div class="page-btn">
        <a href="javascript:void(0)" onclick="registro_usuario()"  id="breadcrumb-boton-registro" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Registrar usuario</a>
        <a href="javascript:void(0)" onclick="lista_usuario()" id="breadcrumb-boton-regresar" class="btn btn-added"><- Regresar</a>
    </div>
</div>
<!-- /Page Header -->

<div class="card" id="mostrar-busqueda">

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

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label semibold" for="n">Nombre</label>
                                <input type="text" class="form-control" id="n" name="nombre" placeholder="Ingrese el Nombre">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label semibold" for="u">Usuario</label>
                                <input type="text" class="form-control" id="u" name="usuario" placeholder="Ingrese el Usario">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group" style="margin-top:33px;">
                                <input type="hidden" name="pagina_modal" id="pagina-modal" value="1">
                                <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_usuario()" />
                                <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="cancelar()"/>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
     
    </div>

</div>

<div class="card" id="contenido">
</div>