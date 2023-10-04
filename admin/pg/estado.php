<script>
window.onload = function() {
    registro_estado();
    lista_estado();
    activarTooltipAjax();
}

function cancelar(){
    $("#nombre2").val('');
    $("#clave_inegi2").val('');
    lista_estado();
}
</script>

<!-- ENCABEZADO -->
<div class="page-header">
    <div class="page-title">
        <h4>Estados</h4>
        <h6>Listado y registro de los esados de México</h6>
    </div>
</div>

<!-- BUSCADOR -->


<div class="row">
    
    <!-- FORMULARIO DE REGISTRO -->
    <div id="formulario-registro" class="col-sm-4 col-md-4 col-xs-4"></div>

    <div class="col-sm-8 col-md-8 col-xs-8">
        <!-- BUSCADOR -->
        <div class="card">
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

                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <form id="form_busqueda" >
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="nombre">Estado</label>
                                        <input type="text" class="form-control" name="nombre2" id="nombre2" placeholder="Ingrese el Nombre del Estado">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="clave_inegi">Clave INEGI</label>
                                        <input type="text" class="form-control" name="clave_inegi2" id="clave_inegi2" placeholder="Ingrese la Clave del INEGI">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group" style="margin-top:30px;">
                                        <input type="hidden" name="pagina" id="pagina" value="1">
                                        <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_estado()" />
                                        <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="cancelar()"/>
                                        <!-- onclick="location.href='estado'" -->
                                    </div>
                                </div>

                            </div>

                            <!-- <div class="text-left">
                                <input type="hidden" name="pagina" id="pagina" value="1">
                                <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="permiso_lista()" />
                                <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="location.href='permiso'"/>
                            </div> -->

                        </form>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- LISTADO -->
        <div id="listado"></div>
    </div>
         
</div>





