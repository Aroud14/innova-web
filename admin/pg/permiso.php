<script>
window.onload = function() {
    permiso_registro();
    permiso_lista();
    activarTooltipAjax();
}
</script>

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h4>PERMISOS DEL SISTEMA</h4>
        <h6>Listado y registro de permisos</h6>
    </div>
</div>

<!-- /Page Header -->
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
            <!-- <div class="wordset">
                <ul>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                    </li>
                </ul>
            </div> -->
        </div>

        <!-- /Filter -->
        <div class="card" id="filter_inputs">
            <div class="card-body pb-0">
                <form id="form_busqueda" >
                    <div class="row">
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label semibold" for="archivo">Archivo</label>
                                <input type="text" class="form-control" name="archivo" placeholder="Ingrese el Nombre de Archivo">
                            </div>
                        </div>     

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label semibold" for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el Nombre">
                            </div>
                        </div>

                    </div>

                    <!--.row-->
                    <div class="text-left">
                        <input type="hidden" name="pagina" id="pagina" value="1">
                        <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="permiso_lista()" />
                        <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="location.href='permiso'"/>
                    </div>

                </form>
            </div>
        </div>
        <!-- /Filter -->
        
    </div>

</div>


<div class="row">
    
    <div id="formulario_registro" class="col-sm-4 col-md-4 col-xs-4"></div>

    <div id="listado" class="col-sm-8 col-md-8 col-xs-8"></div>               
    
</div>





