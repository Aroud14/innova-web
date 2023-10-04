<?php
    require "../php/inicializandoDatosExterno.php";
    $id = $funciones->limpia($_POST['id2']);
?>

<script>
function cancelarModal(){
    $("#dia3").val("");
    $("#hora_inicio3").val('');
    $("#hora_termino3").val('');
    modal_usuario_horario_lista(<?php echo $id ?>);
}
</script>


<div class="row">

    <div id="formulario-registro-modal" class="col-sm-4 col-md-4 col-xs-4"></div>

    <div class="col-sm-8 col-md-8 col-xs-8">

        <!-- BUSCADOR -->
        <div class="card">
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
                        <form id="form-busqueda-modal">
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label class="form-label semibold" for="tipo">Dia</label>
                                    <select  class="form-control select2" name="dia3" id="dia3">
                                        <option value="">Todos los días</option>
                                        <?php 
                                            echo $funciones->comboDias();
                                        ?>                              
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label semibold" for="idpadre">Horario inicio</label>
                                    <input type="time" class="form-control" name="hora_inicio3" id="hora_inicio3" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label semibold" for="idpadre">Horario termino</label>
                                    <input type="time" class="form-control" name="hora_termino3" id="hora_termino3" value="">
                                </div>


                                <div class="col-lg-4">

                                    <input type="hidden" name="pagina_modal" id="pagina-modal" value="1">
                                    <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="modal_usuario_horario_lista(<?= $id ?>)" />
                                    <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="cancelarModal()"/>
                                  
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

    
        <div id="listado-modal"></div> 
    </div>
    
    <div class="text-center" style="margin-bottom:10px;">
        <input type="button" class="btn btn-danger btn-sm" onclick="ocModalCerrar()" value="X Cerrar"/>
    </div>

</div>
