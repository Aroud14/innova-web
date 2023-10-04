<?php
    require "../php/inicializandoDatosExterno.php"; 
    if($_POST['id']>0){
        $id = $funciones->limpia($_POST['id']);
        $datos = $conexion->fetch_array($querys->getusuario($id));
    }
?>

<div class="card-body">

    <h5 class="card-title">Registrar los permisos del usuario: </b><font color="#037BE4"><b><?php echo mb_strtoupper($datos['nombre']);?></b></font></h5>
    <form action="php/subir.php" enctype="multipart/form-data" method="post" id="enviar_formulario">
        <div class="row">

            <br>   
            <?php 
            if(isset($_GET['id']))
                $id = $funciones->limpia(base64_decode($_GET['id'])); 
            
                $obtener_permisos_usu = $conexion->obtenerlista($querys->getlispermisousuario($id));
                $obtener_menualto = $conexion->obtenerlista($querys->getpermisopadre());
                
                        foreach($obtener_menualto as $menu_alto){
                            
                            $obtener_subchicos = $conexion->obtenerlista($querys->getpermisohijo($menu_alto->id_permiso));

                            $num_arreglo_1 = count($obtener_subchicos);                                                                   
                            if($num_arreglo_1 != 0){
                                $br1 = '';
                                echo $br1.'<div style="clear:both; height:15px;"></div><div class="checkbox-toggle">
                                                <input type="checkbox" name="p[]" value="'.$menu_alto->id_permiso.'" id="p'.$menu_alto->id_permiso.'" onclick="marcar_permiso('.$menu_alto->id_permiso.', this.checked)" />
                                                <label style="font-size: 14px; color: crimson;" for="p'.$menu_alto->id_permiso.'"><b>'.mb_strtoupper($menu_alto->nombre).'</b></label>
                                                <hr>
                                            </div>';        
                                    
                                    $conta = 0;
                                    
                                    foreach($obtener_subchicos as $menu_chico){
                                        $conta++;
                                        
                                        $checar = "";
                                        
                                        foreach($obtener_permisos_usu as $permisos){
                                            
                                            if($menu_chico->id_permiso == $permisos->id_permiso)    
                                                $checar = 'checked';
                                        }
                                                
                                        echo '<div class="col-md-4 col-sm-12">                        
                                                        <div class="checkbox-toggle">
                                                            <input type="checkbox" class="checkpadre'.$menu_alto->id_permiso.'" name="permisosprivilegios[]" value="'.$menu_chico->id_permiso.'" id="hijo'.$menu_chico->id_permiso.'"  '.$checar.'/>
                                                            <label  for="hijo'.$menu_chico->id_permiso.'">'.$menu_chico->nombre.'</label>
                                                        </div>                
                                                    </div>';
                                    }

                                    echo '<div style="clear:both;"></div><br>';
                        
                                }

                            else{
                                
                                $checar = "";
                                    
                                    foreach($obtener_permisos_usu as $permisos){
                                        
                                        if($menu_alto->id_permiso == $permisos->id_permiso) 
                                            $checar = 'checked';
                                    }
                                
                                    echo '
                                    <div class="col-md-12 col-sm-12">
                                                <div class="checkbox-toggle">
                                                    <input type="checkbox" name="permisosprivilegios[]" value="'.$menu_alto->id_permiso.'" id="padre'.$menu_alto->id_permiso.'" '.$checar.' />
                                                    <label style="font-size: 14px; color: crimson;" for="padre'.$menu_alto->id_permiso.'"><b>'.mb_strtoupper($menu_alto->nombre).'</b></label>
                                                </div> <br>               
                                            </div>';
                            }
                            
                        }
                        
                    ?>

                    <br/>
                    <br><br><br>
                <div class="text-right">      
                    <input type="submit" class="btn btn-success btn-sm" id="btn_guardar" value="Guardar"/>
                    <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="lista_usuario()"/>
                </div> 
    
        </div><!--.row-->
        <input type="hidden" name="id" value="<?php echo $datos['id_usuario'];?>" />
        <input type="hidden" name="opcion" value="5" />
    </form>
</div> 
   


      