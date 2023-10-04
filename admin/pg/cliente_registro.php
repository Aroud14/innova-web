 <?php

require "../php/inicializandoDatosExterno.php";
$comisionver = ' none';
if ($_POST['id'] > 0) {
    $id = $funciones->limpia($_POST['id']);
    $datos = $conexion->fetch_array($querys->getcliente($id));
}

?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="white-box">
            <!--<h3 class="box-title">Registro</h3>-->

            <form method="post" action="php/subir.php" id="enviar_formulario" enctype="multipart/form-data">
                <div class="row">
                    <h4>Formulario de Registro</h4>
                    <hr>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php if (isset($id)) echo $datos['nombre'] ?>" placeholder="Nombre" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Activo</label>
                            <select class="form-control" name="estatus" id="estatus" required>
                                <?php 
                                if(isset($id))
                                    echo $funciones->getComboEstatus($datos['estatus']);
                                else
                                    echo $funciones->getComboEstatus(1);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enlace</label>
                            <input type="text" class="form-control" name="enlace" value="<?php if (isset($id)) echo $datos['enlace'] ?>" placeholder="Enlace" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>
                    </div>
                </div>
                <div class="row"><br>
                    <input type="hidden" name="opcion" value="<?php if (isset($id)) echo '29'; else echo '28'; ?>" />
                    <input type="hidden" name="logo2" value="<?php if(isset($datos['logo']) && $datos['logo'] != "") echo $datos['logo'] ?>" />
                    <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id ?>">

                    <button class="btn btn-primary" type="submit"id="btn_guardar" >Guardar</button>
                    <button class="btn btn-danger" type="button" onclick="cliente_lista()">Cancelar</button>
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