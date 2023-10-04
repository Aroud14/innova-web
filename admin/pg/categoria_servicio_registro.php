<?php
require "../php/inicializandoDatosExterno.php";
if($_POST['id']>0){
    $id = $funciones->limpia($_POST['id']);
    $sql = $querys->getcategoriaservicio($id);
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
                    <input type="text" class="form-control" name="nombre" value="<?php if(isset($id)) echo $datos['nombre'] ?>" placeholder="Nombre de la categoria">
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
                <div class="form-group">
                    <div class="form-group">
                        <label class="form-label" for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion"><?php if(isset($id)) echo htmlspecialchars($datos['descripcion']);?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="hidden" name="imagen2" value="<?php if(isset($datos['archivo']) && $datos['archivo'] != "") echo $datos['archivo'] ?>" />
                <input type="hidden" name="opcion" value="<?php if(isset($id)) echo '123'; else echo '122'; ?>" />
                <input type="hidden" name="id" id="id" value="<?php if(isset($id)) echo $id ?>">
                <button class="btn btn-primary" type="submit" id="btn_guardar"  >Guardar</button>
                <button class="btn btn-danger" type="button" onclick="registro_categoriablog()">Cancelar</button>
            </div>
        </div>
    </form>
</div>