 <?php

require "../php/inicializandoDatosExterno.php";
$comisionver = ' none';
if ($_POST['id'] > 0) {
    $id = $funciones->limpia($_POST['id']);
    $blog = $conexion->fetch_array($querys->getBlog($id));
}

?>

<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="white-box">
            <!--<h3 class="box-title">Registro</h3>-->

            <form method="post" action="php/subir.php" id="enviar_formulario" enctype="multipart/form-data">
                <div class="row">
                    <h4>DATOS DE BLOG</h4>
                    <hr>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Titulo</label>
                            <input type="text" class="form-control" name="titulo" value="<?php if (isset($id)) echo $blog['titulo'] ?>" placeholder="titulo" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha:</label>
                            <input type="text" class="form-control" name="fecha" value="<?= isset($blog['fecha']) ? $funciones->cambiarFormatoFechaform($blog['fecha']) : date("d-m-Y") ?>" placeholder="fecha" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Categorias</label>
                            <select class="form-control" name="categoria" id="categoria" required>
                                <?php
                                    $blogs = $conexion->obtenerlista($querys->getcombocategoriablog());
                                    
                                    if(isset($id))
                                      echo $funciones->llenarcombomodifica($blogs, $blog['id_categoria_blog']);
                                    else
                                    echo $funciones->llenarcombo($blogs);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Etiquetas(Tags)</label>
                            <select class="form-control" name="etiqueta" id="etiqueta" required>
                                <?php
                                $blogs = $conexion->obtenerlista($querys->getcomboetiquetablog());

                                if(isset($id))
                                    echo $funciones->llenarcombomodifica($blogs, $blog['id_etiqueta_blog']);
                                else
                                    echo $funciones->llenarcombo($blogs);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Autor</label>
                            <input type="text" class="form-control" name="autor" value="<?php if (isset($id)) echo $blog['nombre_autor'] ?>" placeholder="autor" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Frase Relevante 1</label>
                            <input type="text" class="form-control" name="frase_importante01" value="<?php if (isset($id)) echo $blog['frase_importante01'] ?>" placeholder="loremp impsun...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Frase Relevante 2</label>
                            <input type="text" class="form-control" name="frase_importante02" value="<?php if (isset($id)) echo $blog['frase_importante02'] ?>" placeholder="loremp impsun...">
                        </div>
                    </div>
                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Activo</label>
                                        <select class="form-control" name="estatus" id="estatus" required>
                                            <?php 
                                            if(isset($id))
                                                echo $funciones->getComboEstatus($blog['estatus']);
                                            else
                                                echo $funciones->getComboEstatus(1);
                                            ?>
                                        </select>
                                    </div>
                                </div>
                    <div class="col-md-12 env_editor">
                        <div class="form-group">
                            <label class="form-label" for="text1">Contenido</label>
                            <textarea name="text1" id="text1"><?php if(isset($id)) echo htmlspecialchars($blog['contenido']);?></textarea>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Portada</label>
                            <input type="file" class="form-control" name="portada_imagen">
                        </div>
                    </div>
                </div>
                <div class="row"><br>
                    <input type="hidden" name="opcion" value="<?php if (isset($id)) echo '111'; else echo '110'; ?>" />
                    <input type="hidden" name="portada_imagen2" value="<?php if(isset($blog['portada_imagen']) && $blog['portada_imagen'] != "") echo $blog['portada_imagen'] ?>" />
                    <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id ?>">
                    <button class="btn btn-primary" type="submit"id="btn_guardar" >Guardar</button>
                    <button class="btn btn-danger" type="button" onclick="lista_blog()">Cancelar</button>
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