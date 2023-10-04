<?php
require "../php/inicializandoDatosExterno.php";
if($_POST['id']>0){
    $id = $funciones->limpia($_POST['id']);
    $sql = $querys->getpreguntafrecuente($id);
    $datos = $conexion->fetch_array($sql);
}
?>
<div class="white-box">
    <h3 class="box-title">Formulario de Registro</h3>
    <form method="post" action="php/subir.php" id="enviar_formulario"  enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Pregunta</label>
                    <input type="text" class="form-control" name="nombre" value="<?php if(isset($id)) echo $datos['nombre'] ?>" placeholder="pregunta">
                </div>
                <div class="form-group">
                    <label>Respuesta</label>
                    <input type="text" class="form-control" name="respuesta" value="<?php if(isset($id)) echo $datos['respuesta'] ?>" placeholder="respuesta">
                </div>
                <div class="form-group">
                    <label>Servicio</label>
                    <select class="form-control" name="categoria" id="categoria" required>
                        <?php
                        $blogs = $conexion->obtenerlista($querys->getcomboservicio());

                        if(isset($id))
                            echo $funciones->llenarcombomodifica($blogs, $datos['id_servicio']);
                        else
                            echo $funciones->llenarcombo($blogs);
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Categoria del Servicio</label>
                    <select class="form-control" name="categoria2" id="categoria2" required>
                        <?php
                        $blogs = $conexion->obtenerlista($querys->getcombocategoriaservicio());

                        if(isset($id))
                            echo $funciones->llenarcombomodifica($blogs, $datos['id_categoria_servicio']);
                        else
                            echo $funciones->llenarcombo($blogs);
                        ?>
                    </select>
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
                <input type="hidden" name="opcion" value="<?php if(isset($id)) echo '125'; else echo '124'; ?>" />
                <input type="hidden" name="id" id="id" value="<?php if(isset($id)) echo $id ?>">
                <button class="btn btn-primary" type="submit" id="btn_guardar"  >Guardar</button>
                <button class="btn btn-danger" type="button" onclick="registro_categoria_blog()">Cancelar</button>
            </div>
        </div>
    </form>
</div>