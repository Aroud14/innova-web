<?php
require "../php/inicializandoDatosExterno.php";
if($_POST['id']>0){
    $id = $funciones->limpia($_POST['id']);
    $sql = $querys->getcomentario($id);
    $datos = $conexion->fetch_array($sql);
}
?>
<div class="white-box">
    <h3 class="box-title">Formulario de Registro</h3>
    <form method="post" action="php/subir.php" id="enviar_formulario"  enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Autor</label>
                    <input type="text" class="form-control" name="nombre" value="<?php if(isset($id)) echo $datos['nombre'] ?>" placeholder="Nombre del autor">
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="text" class="form-control" name="correo" value="<?php if(isset($id)) echo $datos['correo'] ?>" placeholder="Correo del autor">
                </div>
                <div class="form-group">
                    <label>Blog</label>
                    <select class="form-control" name="blog" id="blog" required>
                        <?php
                        $blogs = $conexion->obtenerlista($querys->getComboBlog());

                        if(isset($id))
                            echo $funciones->llenarcombomodifica($blogs, $datos['id_blog']);
                        else
                            echo $funciones->llenarcombo($blogs);
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="text1">Mensaje</label>
                    <textarea name="text1" id="text1"><?php if(isset($id)) echo htmlspecialchars($datos['mensaje']);?></textarea>
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
            </div>
            <div class="col-md-12">
                <input type="hidden" name="opcion" value="<?php if(isset($id)) echo '129'; else echo '128'; ?>" />
                <input type="hidden" name="id" id="id" value="<?php if(isset($id)) echo $id ?>">
                <button class="btn btn-primary" type="submit" id="btn_guardar"  >Guardar</button>
                <button class="btn btn-danger" type="button" onclick="registro_comentario()">Cancelar</button>
            </div>
        </div>
    </form>
</div>