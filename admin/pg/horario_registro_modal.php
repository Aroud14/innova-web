<?php
    require "../php/inicializandoDatosExterno.php";
    $id = $funciones->limpia($_POST['id2']);
    $datosHoraActual = date("H").":".date("i");

    if($_POST['id3']>0){
        $id2 = $funciones->limpia($_POST['id3']);
        $datos = $conexion->fetch_array($querys->getHorarioUsuario($id2));
    }
?>
      
<div class="card">

    <div class="card-body">
        <h5 class="card-title">Formulario de registro</h5>

        <form action="php/subir.php" enctype="multipart/form-data" method="post" id="enviar_formulario_modal">
            <div class="row">    
                
                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="tipo">Dia</label>
                    <select  class="form-control select2" name="dia" id="dia">
                        <?php 
                            if(isset($id2)) 
                                echo $funciones->comboDias($datos['dia']);
                            else 
                                echo $funciones->comboDias();
                        ?>                              
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="idpadre">Horario inicio</label>
                    <input type="time" class="form-control" name="hora_inicio" id="hora_termino" value="<?php 
                        if (isset($datos['hora_inicio'])){
                                echo $datos['hora_inicio']; 
                            }else{ 
                                echo $datosHoraActual;
                            }
                        ?>">
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label semibold" for="idpadre">Horario termino</label>
                    <input type="time" class="form-control" name="hora_termino" id="hora_termino" value="<?php 
                        if (isset($datos['hora_termino'])){
                                echo $datos['hora_termino']; 
                            }else{ 
                                echo $datosHoraActual;
                            }
                        ?>">
                </div>

                <div class="col-md-12">
                    <div class="form-group">               
        
                        <input type="hidden" name="id2" value="<?php if(isset($id2)) echo $datos['id_usuario_horario'];?>" /> 
                        <input type="hidden" name="id_usuario_modal" value="<?php echo $id; ?>" />              
                        <?php 
                            if(!isset($id2))
                                echo '<input type="submit" id="btn_guardar_modal" class="btn btn-success btn-sm" value="Guardar" />  <input type="hidden" id="opcion" name="opcion" value="23" />';
                            else 
                                echo '<input type="submit" id="btn_guardar_modal" class="btn btn-primary btn-sm" value="Actualizar" /> <input type="hidden" id="opcion" name="opcion" value="24" />';
                        ?>
                        <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="modal_horario_registro(<?php echo $id; ?>)"/>
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