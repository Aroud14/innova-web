<?php
	//******************************************************************
	@session_start();
	$autentificado_sis = $_SESSION['autentificado_sis'];
	$datos_sis = $_SESSION['datos_sis'];

	require ("php/clase_variables.php");
	require ("php/clase_mysql.php");
	require ("php/clase_funciones.php");
	require ('php/clase_paginador.php');
	require ('php/clase_querys.php');

	$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	$querys    = new Querys();

	if($autentificado_sis == md5("sistemacasaempenio")){
		// Current / default page
		$modulo = isset($_GET['modulo']) ? $funciones->limpia($_GET['modulo']) : 'inicio';
	}else{
		echo'<script languaje="javascript">
				var msg = alert("Acceso Denegado");
				location.href="index.php";
			</script>';
			exit(0);
	}

	$permiso = $conexion->consultaregistro($querys->obtenerPermisoModulo($datos_sis['id_usuario'], $modulo));

?>