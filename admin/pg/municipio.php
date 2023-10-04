<script>
window.onload = function() {
    registro_municipio();
    lista_municipio();
    activarTooltipAjax();
}

function cancelar(){
    $("#nombre2").val('');
    $("#clave_inegi2").val('');
    $("#estado2").val(0);
    lista_municipio();
}
</script>

<!-- ENCABEZADO -->
<div class="page-header">
    <div class="page-title">
        <h4>Municipios</h4>
        <h6>Listado y registro de municipios</h6>
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select3" name="estado2" id="estado2">
                                            <option value="0">- Todos los estados -</option>';
                                            <?php 
                                                $estados = $conexion->obtenerlista($querys->getComboEstados());
                                                if(isset($id))
                                                    echo $funciones->llenarcombomodifica($estados, $datos['id_estado']);
                                                else
                                                    echo $funciones->llenarcombo($estados);
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="hidden" name="pagina" id="pagina" value="1">
                                    <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_municipio()" />
                                    <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="cancelar()"/>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- LISTADO -->
        <div id="listado"></div>
    </div>
         
</div>





