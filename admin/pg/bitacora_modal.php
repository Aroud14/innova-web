<?php
    require "../php/inicializandoDatosExterno.php";
    $id = $funciones->limpia($_POST['id2']);
?>

<div class="card" id="mostrar-busqueda_modal">

    <div class="card-body">
        
        <div class="table-top">
            <div class="search-set">
                <div class="search-path">
                    <a class="btn btn-filter" id="filter_search1">
                        <img src="assets/img/icons/filter.svg" alt="img">
                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                            <b>Formulario de búsqueda &nbsp;</b>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card" id="filter_inputs1">
            <div class="card-body pb-0">
                <form id="form_busqueda_modal">
                    <div class="row">
                        <div class="col-lg-3">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="fechainv">Fecha</label>
                                <input id="fechajquery" class="form-control" name="fechainv" type="text" placeholder="Fecha">
                            </fieldset>
                        </div>

                        <div class="col-lg-3">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="ip">Ip</label>
                                <input type="text" class="form-control" id="ip" name="ip" placeholder="Ingrese la IP">
                            </fieldset>
                        </div>

                        <div class="col-lg-3">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="navegador">Navegador</label>
                                <input type="text" class="form-control" id="navegador" name="navegador" placeholder="Ingrese el Navegador">
                            </fieldset>
                        </div>

                        <div class="col-lg-3">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="so">Sistema Operativo</label>
                                <input type="text" class="form-control" id="so" name="so" placeholder="Ingrese el Sistema Operativo">
                            </fieldset>
                        </div>
                    </div>

            
                    <div class="text-left">
                        <div class="col-lg-12">
                            <input type="hidden" name="pagina_modal" id="pagina_modal" value="1">
                            <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_bitacora_modal(<?= $id ?>)" />
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="listado_modal"></div>

<div class="text-center" style="margin-bottom:10px;">
    <input type="button" class="btn btn-danger btn-sm" onclick="ocModalCerrar()" value="X Cerrar"/>
</div>
      