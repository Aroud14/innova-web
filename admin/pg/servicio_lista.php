<?php
require "../php/inicializandoDatosExterno.php";


if(isset($_POST['nombre']) && $_POST['nombre'] != '')
    $nombre = $funciones->limpia($_POST['nombre']);
else $nombre = "";

$pagina = $funciones->limpia($_POST['pagina']);
$limite = 10;
$inicio = ($pagina - 1) * $limite;


$blogs = $conexion->obtenerlista($querys->getlistservicio($nombre, '', $inicio, $limite));
$total = $conexion->consultaregistro($querys->getconteoservicio($nombre, ''));
$totalPaginas = ceil($total / $limite);

?>
<div class="white-box">

    <table class="table color-table info-table">
        <thead>
        <?php if($total!=0){ ?>
            <tr>
                <th style="width:200px">Portada</th>
                <th>Titulo</th>
                <th>Estatus</th>
                <th></th>
            </tr>
        <?php } ?>
        <?php if($total==0){ ?>
            <tr>
                <td align="center">
                    <b><font color="#d15517">¡NO SE ENCONTRARON RESULTADOS!</font></b>
                </td>
            </tr>
        <?php } ?>

        </thead>
        <tbody>
        <?php

        foreach ($blogs as $blog){
            ?>
            <tr style="<?= $color ?>">
                <td style="width:140px; ">
                    <img src="archivos/<?= $blog->portada_imagen ?>" width="60px">
                </td>
                <td><?= $blog->titulo ?></td>
                <td><?php echo $funciones->estatusactivo($blog->estatus) ?></td>
                <td>
                    <?php if($datos_sis['editar'] == 1) { ?>
                        <a type="button" href="javascript:void(0)" onclick="registro_servicio(<?php echo $blog->id_servicio; ?>)" class="btn btn-inline btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                    <?php } ?>
                    <?php if($datos_sis['eliminar'] == 1) { ?>
                        <a type="button" class="btn btn-inline btn-sm btn-danger" onclick="eliminar(28,<?php echo $blog->id_servicio ?>);" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa fa-trash"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="8">
                <nav style="width: 100%!important;">
                    <?php
                    $pag = new Paginador();
                    $pag->setCantidadRegistros($limite);
                    $pag->setCantidadEnlaces(7);
                    $datos = $pag->paginar($pagina, $total);
                    ?>
                    <span style="float: left;">
                            <?php
                            if($datos){
                                echo '
                                    <span style="color:#464949!important; font-weight:bold;">Resultados encontrados: <b>'.$total.'</b></span>
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
                                    <li class="page-item"><a  class="page-link" href="javascript:lista_servicio(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
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