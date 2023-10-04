<?php
require ("../clase_variables.php");
require ("../clase_mysql.php");
require ("../clase_querys.php");
require ("../clase_funciones.php");
$conexion = new DB_mysql(1);
$querys    = new Querys();
$funciones = new Funciones();
echo '<option value="0">-Seleccionar-</option>';
$resultados = $conexion->obtenerlista($querys->getComboMunicipios($_POST['id']));
$funciones->llenarcombo($resultados);
?>