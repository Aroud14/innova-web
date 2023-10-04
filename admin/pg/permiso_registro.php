<?php
    require "../php/inicializandoDatosExterno.php"; 
    if($_POST['id']>0){
        $id = $funciones->limpia($_POST['id']);
        $datos = $conexion->fetch_array($querys->getpermiso($id));
    }
?>
      
<div class="card">

    <div class="card-body">
        <h5 class="card-title">Formulario de registro</h5>

        <form action="php/subir.php" enctype="multipart/form-data" method="post" id="enviar_formulario">
            <div class="row">   

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-label semibold" for="tipo">Tipo</label>
                        <select  class="form-control select2" name="tipo" id="tipo">
                            <?php 
                            if(isset($id)) echo $funciones->getcombotipomenu($datos['tipo']);
                            else echo $funciones->getcombotipomenu(1);
                            ?>                              
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-label semibold" for="idpadre">Menú superior</label>
                        <select  class="form-control select2" data-live-search="true" name="idpadre" id="idpadre">
                            <option value="0"> Ninguno </option>
                                <?php
                                $permisos = $conexion->obtenerlista($querys->getcombopermiso());
                                if(isset($id))
                                    echo $funciones->llenarcombomodifica($permisos,$datos['id_padre']);
                                else
                                    echo $funciones->llenarcombo($permisos);
                                ?>                         
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label semibold" for="nombre">Nombre</label>
                        <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php if(isset($id)) echo $datos['nombre'];?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label semibold" for="archivo">Archivo</label>
                        <input type="text" class="form-control" name="archivo" id="archivo" placeholder="Nombre del Archivo" value="<?php if(isset($id)) echo $datos['archivo'];?>">
                    </div> 
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label semibold" for="ordenamiento">Ordenamiento</label>
                        <input required type="number" class="form-control" name="ordenamiento" id="ordenamiento" placeholder="Ordenamiento" value="<?php if(isset($id)) echo $datos['ordenamiento'];?>"">
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-label semibold" for="nombreicono">Nombre de Icono</label>

                        <select class="form-control select2"  data-live-search="true" name="nombreicono" id="nombreicono">
                            <option value=""> Ninguno </option>

                                <?php
                                if(isset($id)) 
                                    echo $funciones->iconosfa($datos['icono']);                                            
                                else
                                    echo $funciones->iconosfa('');
                                
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-label semibold" for="color">Color</label>
                        <input type="color" class="form-control" name="color" id="color" placeholder="Color en ingles" value="<?php if(isset($id)) echo $datos['color']; else echo '#0093D6';?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="estatus">Activo</label>
                        <select class="form-control " name="estatus" id="estatus">
                            <?php 
                                if(isset($id)) echo $funciones->getComboEstatus($datos['estatus']);
                                else echo $funciones->getComboEstatus(1);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="tipo_colocacion">Tipo</label>
                        <select id="tipo_colocacion" name="tipo_colocacion" class="form-control" required>
                        <?php 
                            if(isset($id))
                                echo $funciones->getComboTipoPermiso($datos['tipo_colocacion']);
                            else
                                echo $funciones->getComboTipoPermiso(1);
                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">                            
                        <?php 
                        if(!isset($id)) echo '<input type="submit" id="btn_guardar" class="btn btn-success btn-sm" value="Guardar" />  <input type="hidden" name="opcion" value="1" />';
                        else echo '<input type="submit" id="btn_guardar" class="btn btn-primary btn-sm" value="Actualizar" /> <input type="hidden" name="opcion" value="2" />';
                        ?>
                        <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="permiso_registro()"/>
                        <input type="hidden" name="id" value="<?php if(isset($id)) echo $datos['id_permiso'];?>" /> 
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- <script>
    jQuery(document).ready(function(){   
        $('.bootstrap-select').selectpicker({
            style: '',
            width: '100%',
            size: 8
        });
    });
</script> -->