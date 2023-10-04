<?php
require "../php/inicializandoDatosExterno.php";

$pagina = isset($_POST['pagina']) ? $funciones->limpia($_POST['pagina']) : 1;
$limite = 5;
$cantenlaces = 7;
$inicio = ($pagina - 1) * $limite;
$sentencia = "";

if($_POST['nombre'] != ""){
    $nombre = $funciones->limpia($_POST['nombre']);
}
else $nombre="";

if($_POST['apellido'] != ""){
    $apellido = $funciones->limpia($_POST['apellido']);
}
else $apellido="";

if($_POST['correo'] != ""){
    $correo = $funciones->limpia($_POST['correo']);
}
else $correo="";

if($_POST['telefono'] != ""){
    $telefono = $funciones->limpia($_POST['telefono']);
}
else $telefono="";

$resul_lista = $conexion->obtenerlista($querys->getMensajes($nombre, $apellido, $correo, $telefono, $inicio, $limite));
$total = $conexion->consultaregistro($querys->getConteoMensajes($nombre, $apellido, $correo, $telefono));
?>

<div class="white-box">
    <table class="table color-table info-table">
        <thead>
        <?php if($total!=0){ ?>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Mensaje</th>
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
                <td><?php echo $value->nombre ?></td>
                <td><?php echo $value->apellidos ?></td>
                <td><?php echo $value->correo ?></td>
                <td><?php echo $value->telefono ?></td>
                <td><?php echo $value->mensaje ?></td>
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
                                    <li class="page-item"><a  class="page-link" href="javascript:lista_mensajes_web(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
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
