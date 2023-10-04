<?php
    require "../php/inicializandoDatosExterno.php"; 
    $pagina = $funciones->limpia($_POST['pagina_modal']);
    $limite = 7;
    $cantenlaces = 7;
    $inicio = ($pagina - 1) * $limite;

    $id = $funciones->limpia($_POST['id2']);
    //$datos = $conexion->fetch_array($querys->getHorarioUsuario($id));
    
    $dia = (isset($_POST['dia3']) && ($_POST['dia3'] != NULL || $_POST['dia3']!= "")) ? $funciones->limpia($_POST['dia3']) : "";
    $horaInicio = (isset($_POST['hora_inicio3']) && ($_POST['hora_inicio3'] != NULL || $_POST['hora_inicio3'] != "" )) ? $funciones->limpia($_POST['hora_inicio3']) : "";
    $horaTermino = (isset($_POST['hora_termino3']) && ($_POST['hora_termino3'] != NULL || $_POST['hora_termino3'] != "" )) ? $funciones->limpia($_POST['hora_termino3']) : "";

    $resultados = $conexion->obtenerlista($querys->getListaHorarioUsuario($id, $dia, $horaInicio, $horaTermino, $inicio, $limite));
    $totalRegistros = $conexion->consultaregistro($querys->getConteoListaHorarioUsuario($id, $dia, $horaInicio, $horaTermino));
?>

<div class="card">
    <div class="card-body">
    <h5 class="card-title">Listado</h5>
        <div class="table-responsive">

            <table class="table color-table danger-table">
                <?php 
                    if($totalRegistros != 0){ 
                ?>
                        <thead>
                            <tr>
                                <th>
                                    <div>Dia</div>
                                </th>
                            
                                <th>
                                    <div>Hora inicio</div>
                                </th>

                                <th>
                                    <div>Hora termino</div>
                                </th>

                                <th>
                                    <div>Fecha de registro</div>
                                </th>

                                <th></th>
                            </tr>                    
                    <?php 
                        }
                    ?>
                    
                    <?php 
                        if($totalRegistros == 0){ 
                    ?>
                            <tr>
                                <td align="center">
                                    <b><font color="#d15517">¡NO SE ENCONTRARON RESULTADOS!</font></b>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                    </thead>

                    <tbody>
                        <?php                                 
                            foreach($resultados as $resultado){
                        
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $funciones->diasSemanas($resultado->dia); ?>
                                    </td>
                                
                                    <td>
                                        <?php echo $resultado->hora_inicio; ?>
                                    </td>

                                    <td>
                                    <?php echo $resultado->hora_termino; ?>
                                    </td>

                                    <td>
                                        <?php echo $funciones->fecha($resultado->fecha_registro); ?>
                                    </td>
                                    
                                    <td>
                                        <?php 
                                            if($datos_sis['editar'] == 1){
                                        ?>
                                                <a type="button" href="javascript:void(0)" onclick="modal_horario_registro(<?php echo $id; ?>, <?php echo $resultado->id_usuario_horario; ?>)" class="btn btn-inline btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Horarios"><i class="fa fa-edit"></i></a>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if($datos_sis['eliminar'] != 0){
                                        ?>
                                                <a type="button" onclick="eliminar(11,<?php echo $resultado->id_usuario_horario ?>);" class="btn btn-inline btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Eliminar"><i class="fa fa-trash"></i></a> 
                                        <?php
                                            }
                                        ?>
                                        
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <th colspan="8">
                            <nav style="width: 100%!important;">             
                                <?php
                                    $pag = new Paginador();
                                    $pag->setCantidadRegistros($limite);                                
                                    $pag->setCantidadEnlaces($cantenlaces);
                                    $datos = $pag->paginar($pagina, $totalRegistros);
                                ?>
                                <span style="float: left; margin-left:1%;">
                                    <?php 
                                    if($datos){
                                        echo '<span style="color:#464949!important; font-weight:bold;">Resultados encontrados: <b>'.$totalRegistros.'</b></span>
                                            <br>
                                            <span style="color:#128499!important; font-weight:bold!important;">Página ' .$pagina. ' de ' . $pag->getCantidadPaginas().'</span>';
                                    }
                                    ?>
                                </span>

                                <ul class="pagination pagination-sm" style="float:right!important; margin-top:-0em!important;">
                                    <?php
                                    if($datos){
                                        foreach ($datos as $enlace){
                                            if($enlace['active'] == false){ ?>
                                                <li class="page-item"><a  class="page-link" href="javascript:modal_horario_lista(<?= $id ?>, <?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
                                            }else{ ?>
                                                <li class="page-item active" ><a  class="page-link"><?php echo $enlace['vista']; ?></a></li>
                                    <?php 
                                            }
                                        }
                                    }       
                                    ?>
                                </ul>
                            </nav> 
                        </th>
                    </tr>
                </tfoot>

            </table>                             

        </div>
    </div>
</div>