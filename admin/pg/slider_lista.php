<?php
require "../php/inicializandoDatosExterno.php";

$pagina = isset($_POST['pagina']) ? $funciones->limpia($_POST['pagina']) : 1;
$limite = 10;
$cantenlaces = 7;
$inicio = ($pagina - 1) * $limite;
$sentencia = "";

if($_POST['nombre'] != ""){
    $nombre = $funciones->limpia($_POST['nombre']);
}
else $nombre="";

$total = $conexion->consultaregistro($querys->getSliderCount($nombre));
$resul_lista = $conexion->obtenerlista($querys->getSliderList($nombre, $inicio, $limite));
?>
<div class="white-box">

    <table class="table color-table info-table">
        <thead>
        <?php if($total!=0){ ?>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Enlace</th>
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

        foreach ($resul_lista as $value){
            ?>
            <tr>
                <td><img src="archivos/<?php echo $value->archivo ?>" height="20px"></td>
                <td><?php echo $value->nombre ?></td>
                <td><?php echo $value->enlace ?></td>
                <td><?php echo $funciones->estatus_tipoact($value->estatus) ?></td>
                <td>
                    <?php if($datos_sis['editar'] == 1) { ?>
                        <a type="button" href="javascript:void(0)" onclick="slider_registro(<?php echo $value->id_slider; ?>)" class="btn btn-inline btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                    <?php } ?>
                    <?php if($datos_sis['eliminar'] == 1) { ?>
                        <a type="button" class="btn btn-inline btn-sm btn-danger" onclick="eliminar(33,<?php echo $value->id_slider ?>);" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa fa-trash"></i></a>
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
                    $pag->setCantidadEnlaces($cantenlaces);
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
                                    <li class="page-item"><a  class="page-link" href="javascript:slider_lista(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
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
