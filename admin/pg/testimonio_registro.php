<?php

require "../php/inicializandoDatosExterno.php";
$comisionver = ' none';
if ($_POST['id'] > 0) {
    $id = $funciones->limpia($_POST['id']);
    $testimonio = $conexion->fetch_array($querys->gettestimonio($id));
}

?>

<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="white-box">
            <!--<h3 class="box-title">Registro</h3>-->

            <form method="post" action="php/subir.php" id="enviar_formulario" enctype="multipart/form-data">
                <div class="row">
                    <h4>TESTIMONIO</h4>
                    <hr>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre Cliente</label>
                            <input type="text" class="form-control" name="titulo" value="<?php if (isset($id)) echo $testimonio['titulo'] ?>" placeholder="Cliente" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sector</label>
                            <input type="text" class="form-control" name="sector" value="<?php if (isset($id)) echo $testimonio['sector'] ?>" placeholder="Sector o Area del desarrollo" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Activo</label>
                            <select class="form-control" name="estatus" id="estatus" required>
                                <?php
                                if(isset($id))
                                    echo $funciones->getComboEstatus($testimonio['estatus']);
                                else
                                    echo $funciones->getComboEstatus(1);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 env_editor">
                        <div class="form-group">
                            <label class="form-label" for="text1">Opinion</label>
                            <textarea name="text1" id="text1"><?php if(isset($id)) echo htmlspecialchars($testimonio['contenido']);?></textarea>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Logo Cliente</label>
                            <input type="file" class="form-control" name="portada_imagen">
                        </div>
                    </div>
                </div>
                <div class="row"><br>
                    <input type="hidden" name="opcion" value="<?php if (isset($id)) echo '127'; else echo '126'; ?>" />
                    <input type="hidden" name="portada_imagen2" value="<?php if(isset($testimonio['portada_imagen']) && $testimonio['portada_imagen'] != "") echo $testimonio['portada_imagen'] ?>" />
                    <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id ?>">
                    <button class="btn btn-primary" type="submit"id="btn_guardar" >Guardar</button>
                    <button class="btn btn-danger" type="button" onclick="lista_testimonio()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        $(".select2").select2();
        jQuery('.mydatepicker, input[name=fecha]').datepicker({
            format: 'dd-mm-yyyy',
            //startDate: '-3d'
        });
        // $('.multiselect').multiselect({
        //   buttonWidth: '300px'
        // });
        $('.selectpicker').selectpicker();


        $('.moneda').mask('000,000,000.00', {
            reverse: true,
            placeholder: "000,000,000.00"
        });

    });
</script>