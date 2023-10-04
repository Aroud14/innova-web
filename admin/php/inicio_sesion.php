<?php
//*****************SE INICIA SESIÓN********************
	session_start();
	$_SESSION['datos_sis'] = '';
//*****************************************************
	require "clase_variables.php";
	require "clase_mysql.php";
	require "clase_funciones.php";
	require 'clase_querys.php';
//*****************************************************
	require "recaptchagoogle/recaptchalib.php";
//*****************************************************
	$secret = "6Lce7pUUAAAAABTn79p0AFJ12aFS6vMY0sv7sJMD";
	$resp = null;
	$error = null;
	$reCaptcha = new ReCaptcha($secret);
	$conexion  = new DB_mysql();
	$funciones = new Funciones();
	$querys    = new Querys();

	$ip = $funciones->getRealIP();
	$navegador = $funciones->getBrowser();
	$so = $funciones->getOs();
	$fecha_actual = date("Y")."-".date("m")."-".date("d");
	$hora_actual = date("H").":".date("i").":".date("s");

	date_default_timezone_set('America/Mexico_City');
//*****************************************************
	//RECEPCIÓN DE VARIABLES***************************
	/* if ($_POST["g-recaptcha-response"]) {
		$resp = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	} */

	$usuario  = $funciones->limpia($_POST["login_name"]);
	$pwd      = $_POST["login_pw"];	
		
	//ENVIANDO USUARIO A CONSULTA PARA OBTENER INFORMACIÓN EN CASO DE EXISTIR EN LA BD.
	$dato = $conexion->fetch_array($querys->existeUsuario($usuario));
	$pwd = $funciones->verify_password($pwd, $dato['password']);
	
	
	//VERIFICANDO SI EXISTEN EL USUARIO EN LA BASE DE DATOS
	$resultados = $conexion->numregistros();
	if($resultados == 0){
		//OPCIÓN PARA USUARIO NO REGISTRADO
		echo '<script languaje="javascript">
					alert("Datos de acceso incorrectos");
			  </script>';
		exit();
	}

	$darPaso = 0;
	$existenHorarios = $conexion->consultaregistro($querys->getConteoListaHorarioUsuario($dato['id_usuario'], '', '', ''));
	
	if($conexion->consultaregistro($querys->verificarHorarioTrabajo($dato["id_usuario"])) > 0){
		$darPaso = 1;
	}

	if($pwd == 0){
			//OPCIÓN PARA CONTRASEÑA INCORRECTA
		echo '<script languaje="javascript">
					alert("Datos de acceso incorrectos.");
			  </script>';
		exit();
	}
	else if ($dato['tiene_horario'] == 1 && $existenHorarios == 0){
		echo '<script>
					alert("Aún no tienes un horario asignado para ingresar al sistema")
			</script>';
	}
	else if ($dato['tiene_horario'] == 1 && $existenHorarios > 0 && $darPaso == 0){
		echo '<script languaje="javascript">
					alert("No estás en horario de trabajo");
				</script>';
	}
	else{

		$config_data = $conexion->fetch_array($querys->getConfiguracion());
	
		//INICIALIZANDO VARIABLES DE SESIÓN*************************
		$_SESSION['autentificado_sis'] = md5("sistemacasaempenio");
		$_SESSION['datos_sis'] = array(
			'id_usuario' => $dato["id_usuario"],
			'nombre' => $dato["nombre"],
			'editar' => $dato["editar"],
			'eliminar' => $dato["eliminar"],
			'cancelar' => $dato["cancelar"],
			'editar_validado' => $dato["editar_validado"],
			'tiene_horario' => $dato["tiene_horario"],
			'tipo' => $dato["tipo"],
		);
		$_SESSION['IsAuthorized'] = true;
		$_SESSION['foto'] = $dato['foto'];
		$_SESSION['dominio'] = $config_data['dominio'];

		//OPCIÓN PARA DIRECCIONAR A LA PÁGINA DE INICIO TRAS LOGUEO EXITOSO
		echo '<script languaje="javascript">
				top.location.href="../inicio";
		</script>';
				
		exit();
	}
  ?>

