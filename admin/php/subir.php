<?php
@session_start();
$autentificado_sis = $_SESSION['autentificado_sis'];
$datos_sis = $_SESSION['datos_sis'];	

require_once("clase_variables.php");
require_once("clase_mysql.php"); 
require_once("clase_funciones.php");
include_once("clase_upload.php");
include_once("clase_querys.php");

//$push = new PushNotifications();
$funciones = new Funciones();
//LLAMAMOS A LA CLASE CONEXION
$conexion = new DB_mysql(1);
//llamamos a la clase upload para cargar archivos
$upload = new upload();
$querys = new Querys();

$datos = array();

$guardar = "Registro Guardado Satisfactoriamente";
$editar = "Registro Modificado Satisfactoriamente";

switch($_POST['opcion']){
	
	////////// INICIO REGISTRAR PERMISO
	case 1: 
		$datos['idpadre'] 			= $funciones->limpia($_POST['idpadre']);
		$datos['archivo'] 			= $funciones->limpia($_POST['archivo']);
		$datos['nombre'] 			= $funciones->limpia($_POST['nombre']);
		$datos['ordenamiento'] 		= $funciones->limpia($_POST['ordenamiento']);
		$datos['nombreicono'] 		= $funciones->limpia($_POST['nombreicono']);
		$datos['color'] 			= $funciones->limpia($_POST['color']);
		$datos['estatus'] 			= $funciones->limpia($_POST['estatus']);
		$datos['tipo'] 				= $funciones->limpia($_POST['tipo']);
		$datos['tipo_colocacion'] 	= $funciones->limpia($_POST['tipo_colocacion']);
		
		if($conexion->consultadato("SELECT COUNT(id_permiso) FROM tblc_permiso WHERE fecha_eliminado IS NULL AND nombre like '".$datos['nombre']."' AND archivo like '".$datos['archivo']."'") >= 1){
			$data = array(
				'error' => true,
				'titulo' => 'Existente',
				'mensaje' => 'El dato que desea ingresar ya existe, intente con otro dato. ¡Gracias!',
				'tipo' => 'info',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);
		}
									
		$consulta = "INSERT INTO tblc_permiso(id_padre, archivo, nombre, ordenamiento, icono, color, estatus, tipo, tipo_colocacion, fecha_registro) VALUES('".$datos['idpadre']."', '".$datos['archivo']."', '".$datos['nombre']."', '".$datos['ordenamiento']."', '".$datos['nombreicono']."', '".$datos['color']."', '".$datos['estatus']."', '".$datos['tipo']."', '".$datos['tipo_colocacion']."', NOW())";

		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null
			);
			echo json_encode($data);
			exit(0);
		}
		
		$id = $conexion->ultimoid();
		
		$msj='Se registro el permiso '.$datos['nombre'].', con id: '.$id;
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('permiso_registro', 'permiso_lista')

		);
		echo json_encode($data);
	break;
	////////// FIN REGISTRAR PERMISO

	////////// INICIO MODIFICAR PERMISO
	case 2:
		$datos['id'] 				= $funciones->limpia($_POST['id']);
		$datos['idpadre'] 			= $funciones->limpia($_POST['idpadre']);
		$datos['archivo'] 			= $funciones->limpia($_POST['archivo']);
		$datos['nombre'] 			= $funciones->limpia($_POST['nombre']);
		$datos['ordenamiento'] 		= $funciones->limpia($_POST['ordenamiento']);
		$datos['nombreicono'] 		= $funciones->limpia($_POST['nombreicono']);
		$datos['color'] 			= $funciones->limpia($_POST['color']);
		$datos['estatus'] 			= $funciones->limpia($_POST['estatus']);
		$datos['tipo'] 				= $funciones->limpia($_POST['tipo']);
		$datos['tipo_colocacion'] 	= $funciones->limpia($_POST['tipo_colocacion']);
		
		
		$consulta = "UPDATE tblc_permiso SET estatus = '".$datos['estatus']."', id_padre = '".$datos['idpadre']."', archivo = '".$datos['archivo']."', nombre = '".$datos['nombre']."', ordenamiento = '".$datos['ordenamiento']."', icono = '".$datos['nombreicono']."', color = '".$datos['color']."', tipo = '".$datos['tipo']."', tipo_colocacion = '".$datos['tipo_colocacion']."' WHERE id_permiso = ".$datos['id'];
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al actualizar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);

		}
		
		$msj='Se modifico el permiso '.$datos['nombre'].', con id: '.$datos['id'];
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $editar,
			'tipo' => 'success',
			'funcion' => array('permiso_registro', 'permiso_lista')

		);
		echo json_encode($data);
	break;
	////////// FIN MODIFICAR PERMISO





	////////// INICIO REGISTRAR USUARIO	
	case 3:

		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['telefono'] = $funciones->limpia($_POST['telefono']);
		$datos['correo'] = $funciones->limpia($_POST['correo']);

		$datos['tipo'] = $funciones->limpia($_POST['tipo']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		$datos['usuario'] = $funciones->limpia($_POST['usuario']);
		$datos['tiene_horario'] = $funciones->limpia($_POST['tiene_horario']);

		$datos['editar'] = (isset($_POST['editar'])) ? $funciones->limpia($_POST['editar']) : 0;
		$datos['eliminar'] = (isset($_POST['eliminar'])) ? $funciones->limpia($_POST['eliminar']) : 0;
		$datos['cancelar'] = (isset($_POST['cancelar'])) ? $funciones->limpia($_POST['cancelar']) : 0;
		$datos['editar_validado'] = (isset($_POST['editar_validado'])) ? $funciones->limpia($_POST['editar_validado']) : 0;

		if($_POST['contrasena'] != ""){			
			$datos['contrasena'] = $_POST['contrasena'];
			$datos['contrasena2'] = $_POST['contrasena2'];

			if($datos['contrasena'] != $datos['contrasena2']){
				$data = array(
					'error' => true,
					'titulo' => 'Aviso',
					'mensaje' => 'Las contraseñas no coinciden, verifiquelo',
					'tipo' => 'info',
					'funcion' => null

				);
				echo json_encode($data);
				exit(0);
			}

		}else{
			$data = array(
				'error' => true,
				'titulo' => 'Aviso',
				'mensaje' => 'Es necesario que ingrese una contraseña, verifiquelo',
				'tipo' => 'info',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);
		}
			
		if($conexion->consultadato("SELECT COUNT(id_usuario) FROM tbl_usuario WHERE fecha_eliminado IS NULL AND usuario like '".$datos['usuario']."'") >= 1){
			$data = array(
						'error' => true,
						'titulo' => 'Existente',
						'mensaje' => 'El usuario ingresado ya existe, intente con otro',
						'tipo' => 'info',
						'funcion' => null

					);
			echo json_encode($data);
			exit(0);
				
		}

		$datos['contrasena'] = $funciones->create_password($datos['contrasena']);
						
		$consulta = "INSERT INTO tbl_usuario(nombre, usuario, password, editar, eliminar, cancelar, editar_validado, tiene_horario, tipo, estatus, correo, telefono, fecha_registro) 
					VALUES('".$datos['nombre']."', '".$datos['usuario']."', '".$datos['contrasena']."', '".$datos['editar']."', '".$datos['eliminar']."', '".$datos['cancelar']."', '".$datos['editar_validado']."', '".$datos['tiene_horario']."', '".$datos['tipo']."', '".$datos['estatus']."', '".$datos['correo']."', '".$datos['telefono']."', NOW())";
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('registro_usuario')

			);
			echo json_encode($data);
			exit(0);
		}
		$id = $conexion->ultimoid();

		$msj='Se registro el usuario '.$datos['nombre'].', con id: '.$id;
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('lista_usuario')

		);	

		echo json_encode($data);
		exit(0);
			
	break;
	////////// FIN REGISTRAR USUARIO	

	////////// INICIO MODIFICAR USUARIO
	case 4:
		$datos['id'] = $funciones->limpia($_POST['id']);
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['telefono'] = $funciones->limpia($_POST['telefono']);
		$datos['correo'] = $funciones->limpia($_POST['correo']);

		$datos['tipo'] = $funciones->limpia($_POST['tipo']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		$datos['usuario'] = $funciones->limpia($_POST['usuario']);
		$datos['usuario2'] = $funciones->limpia($_POST['usuario2']);
		$datos['tiene_horario'] = $funciones->limpia($_POST['tiene_horario']);

		$datos['editar'] = (isset($_POST['editar'])) ? $funciones->limpia($_POST['editar']) : 0;
		$datos['eliminar'] = (isset($_POST['eliminar'])) ? $funciones->limpia($_POST['eliminar']) : 0;
		$datos['cancelar'] = (isset($_POST['cancelar'])) ? $funciones->limpia($_POST['cancelar']) : 0;
		$datos['editar_validado'] = (isset($_POST['editar_validado'])) ? $funciones->limpia($_POST['editar_validado']) : 0;
		
		if($_POST['contrasena'] != ""){			
			$datos['contrasena'] = $_POST['contrasena'];
			$datos['contrasena2'] = $_POST['contrasena2'];
			
			if($datos['contrasena2'] != $datos['contrasena']){
				$data = array(
					'error' => true,
					'titulo' => 'Aviso',
					'mensaje' => 'Las contraseñas no coinciden, verifiquelo',
					'tipo' => 'info',
					'funcion' => null

				);
				echo json_encode($data);
				exit(0);
				
			}
			$datos['contrasena'] = $funciones->create_password($datos['contrasena']);
		}
		
		if($datos['usuario'] != $datos['usuario2']){	
			if($conexion->consultadato("SELECT COUNT(id_usuario) FROM tbl_usuario WHERE fecha_eliminado IS NULL AND id_usuario != ".$datos['id']." AND usuario like '".$datos['usuario']."'") >= 1){
				$data = array(
					'error' => true,
					'titulo' => 'Existente',
					'mensaje' => 'El usuario ingresado ya existe, intente con otro',
					'tipo' => 'info',
					'funcion' => null

				);
				echo json_encode($data);
				exit(0);
				}
		}

		if ($_POST['contrasena'] == "") {
			$consulta = "UPDATE tbl_usuario SET nombre = '".$datos['nombre']."', usuario = '".$datos['usuario']."', editar = '".$datos['editar']."', eliminar = '".$datos['eliminar']."', cancelar = '".$datos['cancelar']."', editar_validado = '".$datos['editar_validado']."', tiene_horario = '".$datos['tiene_horario']."', tipo = '".$datos['tipo']."', estatus = '".$datos['estatus']."', telefono = '".$datos['telefono']."', correo = '".$datos['correo']."' WHERE id_usuario = ".$datos['id'];
		} else {
			$consulta = "UPDATE tbl_usuario SET nombre = '".$datos['nombre']."', usuario = '".$datos['usuario']."', editar = '".$datos['editar']."', eliminar = '".$datos['eliminar']."', cancelar = '".$datos['cancelar']."', editar_validado = '".$datos['editar_validado']."', tiene_horario = '".$datos['tiene_horario']."', tipo = '".$datos['tipo']."', estatus = '".$datos['estatus']."', password = '".$datos['contrasena']."', telefono = '".$datos['telefono']."', correo = '".$datos['correo']."' WHERE id_usuario = ".$datos['id'];
		}
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al actualizar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('registro_usuario')

			);
			echo json_encode($data);
			exit(0);
		}
		
		$msj='Se modifico el usuario '.$datos['nombre'].', con id: '.$datos['id'];
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $editar,
			'tipo' => 'success',
			'funcion' => array('lista_usuario')
		);

		echo json_encode($data);
			exit(0);

	break;
	////////// FIN MODIFICAR USUARIO




	////////// INICIO REGISTRAR PRIVILEGIOS DE USUARIO
	case 5:

		$datos['id'] = $funciones->limpia($_POST['id']);
		$nombre = $conexion->consultadato("SELECT nombre FROM tbl_usuario WHERE id_usuario = ".$datos['id']."");
				
		$numero_arreglo = count($_POST['permisosprivilegios']);						
		if($numero_arreglo != 0){		
					$conexion->consulta("DELETE FROM tbl_usuario_permiso WHERE id_usuario = ".$datos['id']."");
					foreach($_POST['permisosprivilegios'] as $valor){

						$padre = $conexion->consultadato("SELECT id_padre FROM tblc_permiso WHERE id_permiso = ".$valor);

						if($conexion->consultadato("SELECT COUNT(id_permiso) FROM tbl_usuario_permiso WHERE id_permiso = ".$padre." AND id_usuario = ".$datos['id']) == 0 && $padre != 0){
							$conexion->consulta("INSERT INTO tbl_usuario_permiso(id_usuario, id_permiso) VALUES (".$datos['id'].", ".$padre.")");
						}

						$consulta = "INSERT INTO tbl_usuario_permiso(id_usuario, id_permiso) VALUES (".$datos['id'].", ".$valor.")";
						if($conexion->consulta($consulta) == 0){
							$data = array(
								'error' => true,
								'titulo' => 'Error',
								'mensaje' => 'Fallo al actualizar el registro, intentelo mas tarde. ¡Gracias!',
								'tipo' => 'warning',
								'funcion' => array('usuario_permiso')
				
							);
							echo json_encode($data);
							exit(0);
						}
					}

					$data = array(
						'error' => false,
						'titulo' => 'Correcto',
						'mensaje' => $editar,
						'tipo' => 'success',
						'funcion' => array('lista_usuario')
			
					);
					echo json_encode($data);
					exit(0);

		}else{
			$data = array(
				'error' => true,
				'titulo' => 'Aviso',
				'mensaje' => 'Es necesario que seleccione al menos un permiso para este usuario',
				'tipo' => 'info',
				'funcion' => null
	
			);
			echo json_encode($data);
			exit(0);
		}
	
	break;
	////////// FIN REGISTRAR PRIVILEGIOS DE USUARIO




	////////// INICIO CONFIGURACION
	case 6:
		$datos['nombre_empresa'] = $funciones->limpia($_POST['nombre']);
		$datos['correo'] = $funciones->limpia($_POST['email']);
		$datos['telefono'] = $funciones->limpia($_POST['telefono']);
		$datos['direccion'] = $funciones->limpia($_POST['direccion']);
		$datos['dominio'] = addslashes($_POST['dominio']);
		$datos['whatsapp'] = $funciones->limpia($_POST['whatsapp']);
		$datos['aviso_privacidad'] = addslashes($_POST['text1']);
		$datos['termino_condicion'] = addslashes($_POST['text2']);

		// ARCHIVO LOGO
		if(isset($_FILES["logo"]["tmp_name"]) AND $_FILES["logo"]["tmp_name"] != ""){

			if($upload->load("logo") === false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el archivo Logo',
					'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
					'tipo' => 'warning',
					'funcion' => null
				);
		
				echo json_encode($data);
				exit(0);
			}

			$carpeta = "../archivos/configuracion/imagenes/";
			if (!file_exists($carpeta)) {
				mkdir($carpeta, 0777, true);
			}

			$datos['logo'] = $upload->nombre_final;
			$upload->setisimage(false);

			if($upload->save("../archivos/configuracion/imagenes/".$datos['logo']) == false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el Logo',
					'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo de nuevo mas tarde. ¡Gracias!',
					'tipo' => 'warning',
					'funcion' => null
				);
		
				echo json_encode($data);
				exit(0);
			}
		}else{
			$datos['logo'] = (isset($_POST['logo2']) && $_POST['logo2'] != NULL) ? $_POST['logo2'] : '';
		}
				
		$consulta = "REPLACE INTO tblc_configuracion(id_configuracion, nombre_empresa, logo, correo, telefono, direccion, whatsapp, aviso_privacidad, termino_condicion, dominio) 
					VALUES('1', '".$datos['nombre_empresa']."', '".$datos['logo']."', '".$datos['correo']."', '".$datos['telefono']."', '".$datos['direccion']."', '".$datos['whatsapp']."', '".$datos['aviso_privacidad']."', '".$datos['termino_condicion']."', '".$datos['dominio']."')";
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);
		}

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('configuracion_registro')
		);	

		echo json_encode($data);
	break;
	////////// FIN CONFIGURACION




	////////// INICIO REGISTRAR ESTADO
	case 7: 
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['latitud'] = $funciones->limpia($_POST['latitud']);
		$datos['longitud'] = $funciones->limpia($_POST['longitud']);
		$datos['clave_inegi'] = $funciones->limpia($_POST['clave_inegi']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		
		if($conexion->consultadato("SELECT COUNT(id_estado) FROM tblc_estado WHERE fecha_eliminado IS NULL AND nombre LIKE '".$datos['nombre']."'") >= 1){
			$data = array(
				'error' => true,
				'titulo' => 'Existente',
				'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
				'tipo' => 'info',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);
		}
									
		$consulta = "INSERT INTO tblc_estado(nombre, latitud, longitud, estatus, clave_inegi, fecha_registro) 
		VALUES('".$datos['nombre']."', '".$datos['latitud']."', '".$datos['longitud']."', '".$datos['estatus']."', '".$datos['clave_inegi']."', NOW())";

		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('registro_estado', 'lista_estado')
			);
			echo json_encode($data);
			exit(0);
		}
		
		$id = $conexion->ultimoid();
		
		$msj='Se registro el estado '.$datos['nombre'].', con id: '.$id;
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('registro_estado', 'lista_estado')

		);
		echo json_encode($data);
		exit(0);
	
	break;
	////////// FIN REGISTRAR ESTADO

	////////// INICIO MODIFICAR ESTADO
	case 8:
		$datos['id'] = $funciones->limpia($_POST['id']);
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['latitud'] = $funciones->limpia($_POST['latitud']);
		$datos['longitud'] = $funciones->limpia($_POST['longitud']);
		$datos['clave_inegi'] = $funciones->limpia($_POST['clave_inegi']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		
		$consulta = "UPDATE tblc_estado SET estatus = '".$datos['estatus']."', nombre = '".$datos['nombre']."', latitud = '".$datos['latitud']."', longitud = '".$datos['longitud']."', clave_inegi = '".$datos['clave_inegi']."' WHERE id_estado = ".$datos['id'];
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al actualizar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('permiso_registro', 'permiso_lista')

			);
			echo json_encode($data);
			exit(0);

		}
		
		$msj='Se modifico el estado '.$datos['nombre'].', con id: '.$datos['id'];
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $editar,
			'tipo' => 'success',
			'funcion' => array('registro_estado', 'lista_estado')

		);
		echo json_encode($data);
		exit(0);

	break;
	////////// FIN MODIFICAR ESTADO




	////////// INICIO REGISTRAR MUNICIPIO
	case 9: 
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['estado'] = $funciones->limpia($_POST['estado']);
		$datos['latitud'] = $funciones->limpia($_POST['latitud']);
		$datos['longitud'] = $funciones->limpia($_POST['longitud']);
		$datos['clave_inegi'] = $funciones->limpia($_POST['clave_inegi']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		
		if($conexion->consultadato("SELECT COUNT(id_municipio) FROM tblc_municipio WHERE fecha_eliminado IS NULL AND nombre LIKE '".$datos['nombre']."'") >= 1){
			$data = array(
				'error' => true,
				'titulo' => 'Existente',
				'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
				'tipo' => 'info',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);
		}
									
		$consulta = "INSERT INTO tblc_municipio(nombre, id_estado, latitud, longitud, estatus, clave_inegi, fecha_registro) 
		VALUES('".$datos['nombre']."', '".$datos['estado']."', '".$datos['latitud']."', '".$datos['longitud']."', '".$datos['estatus']."', '".$datos['clave_inegi']."', NOW())";

		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('registro_municipio', 'lista_municipio')
			);
			echo json_encode($data);
			exit(0);
		}
		
		$id = $conexion->ultimoid();
		
		$msj='Se registro el municipio '.$datos['nombre'].', con id: '.$id;
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('registro_municipio', 'lista_municipio')

		);
		echo json_encode($data);
		exit(0);
	
	break;
	////////// FIN REGISTRAR MUNICIPIO

	////////// INICIO MODIFICAR MUNICIPIO
	case 10:
		$datos['id'] = $funciones->limpia($_POST['id']);
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['estado'] = $funciones->limpia($_POST['estado']);
		$datos['latitud'] = $funciones->limpia($_POST['latitud']);
		$datos['longitud'] = $funciones->limpia($_POST['longitud']);
		$datos['clave_inegi'] = $funciones->limpia($_POST['clave_inegi']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		
		$consulta = "UPDATE tblc_municipio SET estatus = '".$datos['estatus']."', nombre = '".$datos['nombre']."', id_estado = '".$datos['estado']."', latitud = '".$datos['latitud']."', longitud = '".$datos['longitud']."', clave_inegi = '".$datos['clave_inegi']."' WHERE id_municipio = ".$datos['id'];
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al actualizar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('registro_municipio', 'lista_municipio')

			);
			echo json_encode($data);
			exit(0);

		}
		
		$msj='Se modifico el municipio '.$datos['nombre'].', con id: '.$datos['id'];
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $editar,
			'tipo' => 'success',
			'funcion' => array('registro_municipio', 'lista_municipio')

		);
		echo json_encode($data);
		exit(0);

	break;
	////////// FIN MODIFICAR MUNICIPIO

	////////// INICIO REGISTRAR HORARIO USUARIO
	case 23: 
		$datos['dia'] = $funciones->limpia($_POST['dia']);
		$datos['hora_inicio'] = $funciones->limpia($_POST['hora_inicio']);
		$datos['hora_termino'] = $funciones->limpia($_POST['hora_termino']);
		$datos['usuario'] = $funciones->limpia($_POST['id_usuario_modal']);
		
		if($conexion->consultadato("SELECT COUNT(id_usuario_horario) FROM tbl_usuario_horario WHERE fecha_eliminado IS NULL AND id_usuario = '".$datos['usuario']."' AND dia = '".$datos['dia']."' AND hora_inicio = '".$datos['hora_inicio']."' AND hora_termino = '".$datos['hora_termino']."' ") >= 1){
			$data = array(
				'error' => true,
				'titulo' => 'Existente',
				'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
				'tipo' => 'info',
				'funcion' => null

			);
			echo json_encode($data);
			exit(0);
		}
									
		$consulta = "INSERT INTO tbl_usuario_horario(id_usuario, dia, hora_inicio, hora_termino, fecha_registro) 
		VALUES('".$datos['usuario']."', '".$datos['dia']."', '".$datos['hora_inicio']."', '".$datos['hora_termino']."', NOW())";

		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('modal_usuario_horario_lista', 'modal_usuario_horario_registro')
			);
			echo json_encode($data);
			exit(0);
		}
		
		$id = $conexion->ultimoid();
		
		$msj='Se registro el horario de '.$datos['hora_inicio'].' a '.$datos['hora_termino'].' del día '.$datos['dia'].', con id: '.$id;
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('modal_usuario_horario_lista', 'modal_usuario_horario_registro'),
			'params' => array($datos['usuario'], $datos['usuario'])
		);
		echo json_encode($data);
		exit(0);
	
	break;
	////////// FIN REGISTRAR HORARIO USUARIO

	////////// INICIO MODIFICAR HORARIO USUARIO
	case 24:
		$datos['id'] = $funciones->limpia($_POST['id2']);
		$datos['dia'] = $funciones->limpia($_POST['dia']);
		$datos['hora_inicio'] = $funciones->limpia($_POST['hora_inicio']);
		$datos['hora_termino'] = $funciones->limpia($_POST['hora_termino']);
		$datos['usuario'] = $funciones->limpia($_POST['id_usuario_modal']);

		$consulta = "UPDATE tbl_usuario_horario SET dia = '".$datos['dia']."', hora_inicio = '".$datos['hora_inicio']."', hora_termino = '".$datos['hora_termino']."' WHERE id_usuario_horario = ".$datos['id'];
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al actualizar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('modal_usuario_horario_lista', 'modal_usuario_horario_registro')

			);
			echo json_encode($data);
			exit(0);

		}
		
		$msj='Se modifico el horario con id: '.$datos['id'];
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs());
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $editar,
			'tipo' => 'success',
			'funcion' => array('modal_usuario_horario_lista', 'modal_usuario_horario_registro'),
			'params' => array($datos['usuario'], $datos['usuario'])
		);
		echo json_encode($data);
		exit(0);

	break;
	////////// FIN MODIFICAR HORARIO USUARIO
	}
?>