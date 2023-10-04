<?php
    require "../php/inicializandoDatosExterno.php"; 
    $pagina = isset($_POST['pagina_modal']) ? $funciones->limpia($_POST['pagina_modal']) : 1;
    $limite = 7;
    $cantenlaces = 7;
    $inicio = ($pagina - 1) * $limite;

    $id = $funciones->limpia($_POST['id2']);
    //$datos = $conexion->fetch_array($querys->getLog($id));
    
    $fechainv = (isset($_POST['fechainv']) && ($_POST['fechainv'] != NULL || $_POST['fechainv']!= "")) ? $funciones->limpia($_POST['fechainv']) : "";
    $ip = (isset($_POST['ip']) && ($_POST['ip'] != NULL || $_POST['ip']!= "")) ? $funciones->limpia($_POST['ip']) : "";
    $navegador = (isset($_POST['navegador']) && ($_POST['navegador']!= NULL || $_POST['navegador']!= "")) ? $navegador=$funciones->limpia($_POST['navegador']) : "";
    $so = (isset($_POST['so']) && ($_POST['so'] != NULL || $_POST['so'] != "")) ? $funciones->limpia($_POST['so']) : "";

    $resultados = $conexion->obtenerlista($querys->getListaLog($id, $fechainv, $ip, $navegador, $so, $inicio, $limite));
    $totalRegistros = $conexion->consultaregistro($querys->getConteoListaLog($id, $fechainv, $ip, $navegador, $so));

?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Listado</h5>
        <div class="table-responsive">

            <table class="table color-table danger-table">
                <?php if($totalRegistros!=0){ ?>
                <thead>
                    <tr>
                        <th>
                            <div>Fecha</div>
                        </th>
                    
                        <th align="center">
                            <div>descripcion</div>
                        </th>
                        <th align="center">
                            <div>Ip</div>
                        </th>
                        <th align="center">
                            <div>Navegador</div>
                        </th>
                        <th align="center">
                            <div>Sistema Operativo</div>
                        </th>
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
                                <td>
                                    <?php echo $funciones->fecha4(substr($resultado->fecha_accion, 0, 10))." ".substr($resultado->fecha_accion, 11, 5)." hrs."; ?>
                                </td>
                            
                                <td align="center">
                                    <textarea rows="2" class="form-control"><?php echo $resultado->descripcion; ?></textarea>
                                </td>
                                <td align="center">
                                    <?php echo $resultado->ip; ?>
                                </td>
                                <td align="center">
                                    <?php echo $resultado->navegador; ?>
                                </td>
                                <td align="center">
                                    <?php echo $resultado->so; ?>
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
                                                <li class="page-item"><a  class="page-link" href="javascript:lista_bitacora_modal(<?= $id ?>,<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
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
      