<?php 
    require "../php/inicializandoDatosExterno.php";
    $nombre = (isset($_POST['nombre']) && $_POST['nombre'] != '') ? $funciones->limpia($_POST['nombre']) : '' ;
    $usuario = (isset($_POST['usuario']) && $_POST['usuario'] != '') ? $funciones->limpia($_POST['usuario']) : '';

    $pagina = isset($_POST['pagina']) ? $funciones->limpia($_POST['pagina']) : 1;
    $limite = 10;
    $inicio = ($pagina - 1) * $limite;
    $cantenlaces = 7;

    $strQuery = $querys->getlistusuarios($nombre,$usuario,$inicio,$limite);
    $strQuery2 = $querys->getconteousuarios($nombre,$usuario);
    $resultados = $conexion->obtenerlista($strQuery);
    $totalRegistros = $conexion->consultaregistro($strQuery2);
    $totalPaginas = ceil($totalRegistros / $limite);

?>

 <div class="card-body">

    <h5 class="card-title">Listado</h5>

    <div>
            
        <table class="table mb-0">
        <?php if($totalRegistros!=0){ ?>
            <thead>
                <tr>
                    <th> <div>Nombre</div> </th>
                    <th align="center"> <div>Usuario</div> </th>
                    <th align="center"> <div>Activo</div> </th>
                    <th align="center"> <div>Edita</div> </th>
                    <th align="center"> <div>Elimina</div> </th>
                    <th align="center"> <div>Editar validados</div> </th>
                    <th align="center"> <div>Horarios</div> </th>
                    <th align="center"> <!--  <div>Acciones</div>  --></th>
                </tr>
                <?php 
                    }
                ?>
                <?php if($totalRegistros==0){ ?>
                <tr>
                    <td align="center">
                        <b>
                            <font color="#d15517">¡NO SE ENCONTRARON RESULTADOS!</font>
                        </b>
                    </td>
                </tr>

                <?php } ?>
            </thead>
            <tbody>
                <?php                                 
                foreach($resultados as $resultado){
                ?>
                <tr>
                    <td><?php echo $resultado->nombre ?></td>
                    <td><?php echo $resultado->usuario ?></td>
                    <td><?php echo $funciones->estatus($resultado->estatus) ?></td>
                    <td ><?php $funciones->permiso_edita($resultado->editar); ?><br></td>
                    <td ><?php $funciones->permiso_edita($resultado->eliminar); ?><br></td>
                    <td ><?php $funciones->permiso_edita($resultado->editar_validado); ?><br></td>
                    <td ><?php $funciones->permiso_edita($resultado->tiene_horario); ?><br></td>
                    <td nowrap align="right">

                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes</button>
                            <div class="dropdown-menu">
                                <?php if($datos_sis['editar'] == 1 && $resultado->tiene_horario == 1) { ?>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="modal_usuario_horario(<?php echo $resultado->id_usuario; ?>)">Horarios</a>
                                <?php } ?>
                                <?php if($datos_sis['editar'] == 1) { ?>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="modal_bitacora(<?php echo $resultado->id_usuario; ?>)">Bitácora</a>
                                <?php } ?>
                                <?php if($datos_sis['editar'] == 1) { ?>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="usuario_permiso(<?php echo $resultado->id_usuario; ?>)">Pérmisos de usuario</a>
                                <?php } ?>
                            </div>
                        </div>


                        <?php if($datos_sis['editar'] == 1) { ?>
                        <a type="button" href="javascript:void(0)" onclick="registro_usuario(<?php echo $resultado->id_usuario; ?>)" class="btn btn-inline btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                        <?php } ?>
                        <?php if($datos_sis['eliminar'] == 1) { ?>
                        <a type="button" class="btn btn-inline btn-sm btn-danger" onclick="eliminar(2,<?php echo $resultado->id_usuario ?>);" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa fa-trash"></i></a>
                        <?php } ?>

                    </td>
                </tr>
                <?php } ?>
            </tbody>

            <!-- PAGINACION PARA LA TABLA -->
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
                            <ul class="pagination pagination-sm"
                                style="float:right!important; margin-right:-1em!important; margin-top:-0em!important;">
                                <?php
                                    if($datos){
                                        foreach ($datos as $enlace){
                                            if($enlace['active'] == false){ ?>
                                <li class="page-item"><a class="page-link"
                                        href="javascript:lista_usuario(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a>
                                </li><?php
                                            }else{ ?>
                                <li class="page-item active"><a class="page-link"><?php echo $enlace['vista']; ?></a></li>
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
            <!-- FIN DE LA PAGINACION DE LA TABLA-->


        </table>
        <!-- FIN DE LA PAGINACION DE LA TABLA-->

    </div>

</div>