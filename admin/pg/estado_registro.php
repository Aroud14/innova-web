<?php
    require "../php/inicializandoDatosExterno.php"; 
    if($_POST['id']>0){
        $id = $funciones->limpia($_POST['id']);
        $datos = $conexion->fetch_array($querys->getEstado($id));
    }
?>
      
<div class="card">

    <div class="card-body">
        <h5 class="card-title">Formulario de registro</h5>

        <form action="php/subir.php" enctype="multipart/form-data" method="post" id="enviar_formulario">
            <div class="row">    

                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="nombre" required>Nombre</label>
                    <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php if(isset($id)) echo $datos['nombre'];?>">
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="latitud">Latitud</label>
                    <input required type="text" class="form-control" name="latitud" id="latitud" placeholder="Latitud" value="<?php if(isset($id)) echo $datos['latitud'];?>">
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="longitud">Longitud</label>
                    <input required type="text" class="form-control" name="longitud" id="longitud" placeholder="Longitud" value="<?php if(isset($id)) echo $datos['longitud'];?>">
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label" for="estatus">Activo</label>
                    <select class="form-control " name="estatus" id="estatus">
                        <?php 
                            if(isset($id)) echo $funciones->getComboEstatus($datos['estatus']);
                            else echo $funciones->getComboEstatus(1);
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="clave_inegi">Clave INEGI</label>
                    <input required type="text" class="form-control" name="clave_inegi" id="clave_inegi" placeholder="Clave INEGI" value="<?php if(isset($id)) echo $datos['clave_inegi'];?>">
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">                            
                        <?php 
                            if(!isset($id)) 
                                echo '<input type="submit" id="btn_guardar" class="btn btn-success btn-sm" value="Guardar" />  <input type="hidden" name="opcion" value="7" />';
                            else 
                                echo '<input type="submit" id="btn_guardar" class="btn btn-primary btn-sm" value="Actualizar" /> <input type="hidden" name="opcion" value="8" />';
                        ?>
                        <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="registro_estado()"/>
                        <input type="hidden" name="id" value="<?php if(isset($id)) echo $datos['id_estado'];?>" /> 
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>