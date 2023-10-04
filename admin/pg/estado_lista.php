<?php
    require "../php/inicializandoDatosExterno.php"; 
    $pagina = isset($_POST['pagina']) ? $funciones->limpia($_POST['pagina']) : 1;
    $limite = 10;
    $cantenlaces = 7;
    $inicio = ($pagina - 1) * $limite;

    $nombre = (isset($_POST['nombre2']) && $_POST['nombre2'] != '') ? $funciones->limpia($_POST['nombre2']) : "";
    $claveInegi = (isset($_POST['clave_inegi2']) && $_POST['clave_inegi2'] != '') ? $funciones->limpia($_POST['clave_inegi2']) : "";

    $resultados = $conexion->obtenerlista($querys->getListaEstado($nombre ,$claveInegi, $inicio, $limite));
    $totalRegistros = $conexion->consultaregistro($querys->getConteoListaEstado($nombre ,$claveInegi));
?>

<div class="card">
    <div class="card-body">
    <h5 class="card-title">Listado</h5>
        <div class="table-responsive">
            <table class="table color-table danger-table">
                <?php 
                    if($totalRegistros!=0){
                ?>
                        <thead>
                            <tr>
                                <th><div>Nombre</div></th>
                                <th><div>Latitud</div></th>
                                <th ><div>Longitud</div></th>
                                <th ><div>Activo</div></th>
                                <th><div>Clave INEGI</div></th>
                                <th ><div>Acciones</div></th>
                                <th></th>
                            </tr>                            
                    <?php 
                        }
                    ?>
                    
                    <?php 
                        if($totalRegistros==0){ 
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
                            <td nowrap><?php echo $resultado->nombre ?></td>
                            <td nowrap><?php echo $resultado->latitud ?></td>
                            <td nowrap><?php echo $resultado->longitud ?></td>
                            <td>
                                <?php echo $funciones->estatus($resultado->estatus) ?>
                            </td>
                            <td nowrap><?php echo $resultado->clave_inegi ?></td>
                            <td nowrap>
                            <?php
                                if($datos_sis['editar'] != 0){
                            ?> 
                                    <a type="button" href="javascript:void(0)" onclick="registro_estado(<?php echo $resultado->id_estado; ?>)" class="btn btn-inline btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Editar"><i class="fa fa-edit"></i></a>
                            <?php
                                }
                            ?>

                            <?php
                                if($datos_sis['eliminar'] != 0){
                            ?>
                                    <a type="button" onclick="eliminar(3, <?php echo $resultado->id_estado ?>);" class="btn btn-inline btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Eliminar"><i class="fa fa-trash"></i></a> 
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
                                <span style="float: left;">
                                    <?php 
                                    if($datos){
                                        echo '<span style="color:#464949!important; font-weight:bold;">Resultados encontrados: <b>'.$totalRegistros.'</b></span>
                                            <br>
                                            <span style="color:#128499!important; font-weight:bold!important;">Página ' .$pagina. ' de ' . $pag->getCantidadPaginas().'</span>';
                                    }
                                    ?>
                                </span>
                                <ul class="pagination pagination-sm" style="float:right!important; margin-right:-1em!important; margin-top:-0em!important;">
                                    <?php
                                    if($datos){
                                        foreach ($datos as $enlace){
                                            if($enlace['active'] == false){ ?>
                                                <li class="page-item"><a  class="page-link" href="javascript:lista_estado(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
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