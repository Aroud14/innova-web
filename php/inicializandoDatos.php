<?php
	require ("admin/php/clase_variables.php");
	require ("admin/php/clase_mysql.php");
	require ("admin/php/clase_funciones.php");
	require ('admin/php/clase_paginador.php');
	require ('clase_querys.php');

	$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	$querys    = new Querys();
?>