<?php
require "../php/inicializandoDatosExterno.php";
if($_POST['id']>0){
    $id = $funciones->limpia($_POST['id']);
    $sql = $querys->getSlider($id);
    $datos = $conexion->fetch_array($sql);
}
?>
<div class="white-box">
    <h3 class="box-title">Formulario de Registro</h3>
    <form method="post" action="php/subir.php" id="enviar_formulario"  enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?php if(isset($id)) echo $datos['nombre'] ?>" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label>Subtitulo</label>
                    <input type="text" class="form-control" name="subtitulo" value="<?php if(isset($id)) echo $datos['subtitulo'] ?>" placeholder="Subtitulo">
                </div>
                <div class="form-group">
                    <label>Enlace</label>
                    <input type="text" class="form-control" name="enlace" value="<?php if(isset($id)) echo $datos['enlace'] ?>" placeholder="Enlace">
                </div>
                <div class="form-group">
                    <label>Ordenamiento</label>
                    <input type="number" class="form-control" name="orden" value="<?php if(isset($id)) echo $datos['orden'] ?>" placeholder="Ordenamiento">
                </div>
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="hidden" name="opcion" value="<?php if(isset($id)) echo '132'; else echo '131'; ?>" />
                <input type="hidden" name="id" id="id" value="<?php if(isset($id)) echo $id ?>">
                <input type="hidden" name="imagen2" value="<?php if(isset($datos['archivo']) && $datos['archivo'] != "") echo $datos['archivo'] ?>" />
                <button class="btn btn-primary" type="submit" id="btn_guardar"  >Guardar</button>
                <button class="btn btn-danger" type="button" onclick="slider_registro()">Cancelar</button>
            </div>
        </div>
    </form>
</div>