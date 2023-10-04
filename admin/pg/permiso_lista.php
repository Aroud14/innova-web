<?php
    require "../php/inicializandoDatosExterno.php"; 
    $pagina = isset($_POST['pagina']) ? $funciones->limpia($_POST['pagina']) : 1;
    $limite = 10;
    $cantenlaces = 7;
    $inicio = ($pagina - 1) * $limite;

    $archivo = (isset($_GET['archivo']) && ($_GET['archivo'] != NULL || $_GET['archivo'] != "")) ? $archivo=$funciones->limpia($_GET['archivo']) : "";
    $nombre = (isset($_POST['nombre']) && $_POST['nombre'] != '') ? $funciones->limpia($_POST['nombre']) : "";
         
    $strQuery = $querys->getlistpermiso($nombre ,$archivo, 0, $inicio, $limite);
    $strQuery2 = $querys->getconteopermiso($nombre, $archivo, 0);

    $resultados = $conexion->obtenerlista($strQuery);
    $totalRegistros = $conexion->consultaregistro($strQuery2);

    $totalPaginas = ceil($totalRegistros / $limite);
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
                                <th><div>Archivo</div></th>
                                <th ><div>Orden</div></th>
                                <th ><div>Activo</div></th>
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
                            $color = '';
                            if($resultado->tipo == 2) $color = 'style="color: '.$resultado->color.' !important"';
                    ?>
                                <tr <?= $color ?>>
                                    <td><i class="fa <?php echo $resultado->icono ?>"></i>&nbsp;<?php echo $resultado->nombre ?></td>
                                    <td><?php echo $resultado->archivo ?></td>
                                    <td nowrap><?php echo $resultado->ordenamiento ?></td>
                                    <td>
                                        <?php echo $funciones->estatus($resultado->estatus) ?>
                                    </td>
                                    <td nowrap>
                                    <?php if($datos_sis['editar'] != 0) { ?> 
                                        <a type="button" href="javascript:void(0)" onclick="permiso_registro(<?php echo $resultado->id_permiso; ?>)" class="btn btn-inline btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Editar"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if($datos_sis['eliminar'] != 0) { ?>
                                        <a type="button" onclick="eliminar(1,<?php echo $resultado->id_permiso ?>);" class="btn btn-inline btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Eliminar"><i class="fa fa-trash"></i></a> 
                                    <?php } ?>

                                    </td>                                               
                                </tr>
                        <?php
                            $strQuery = $querys->getlistpermiso($nombre,$archivo, $resultado->id_permiso,$inicio,$limite);
                            $strQuery2 = $querys->getconteopermiso($nombre,$archivo, $resultado->id_permiso);

                            $resultados2 = $conexion->obtenerlista($strQuery);
                            foreach($resultados2 as $resultado2){
                        ?>
                                <tr>
                                    <td> - <i class="fa <?php echo $resultado2->icono ?>"></i>&nbsp;<?php echo $resultado2->nombre ?></td>
                                    <td><?php echo $resultado2->archivo ?></td>
                                    <td nowrap><?php echo $resultado2->ordenamiento ?></td>
                                    <td>
                                        <?php echo $funciones->estatus($resultado->estatus) ?>
                                    </td>
                                    <td nowrap>
                                        <?php if($datos_sis['editar'] != 2) { ?> 
                                        <a type="button" href="javascript:permiso_registro(<?php echo $resultado2->id_permiso; ?>)" class="btn btn-inline btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Editar"><i class="fa fa-edit"></i></a>
                                        <?php } ?>
                                        <?php if($datos_sis['eliminar'] != 2) { ?>
                                        <a type="button" onclick="eliminar(1,<?php echo $resultado2->id_permiso ?>);" class="btn btn-inline btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Eliminar"><i class="fa fa-trash"></i></a> 
                                        <?php } ?>
                                    </td>                                               
                                </tr>
                    <?php
                            }
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
                                                <li class="page-item"><a  class="page-link" href="javascript:permiso_lista(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
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