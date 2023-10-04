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

$ip        = $funciones->getRealIP();
$navegador = $funciones->getBrowser();
$so        = $funciones->getOs();
$info = $conexion->fetch_array($querys->getConfiguracion());

switch($_POST['opcion']){
	
	////////// INICIO REGISTRAR PERMISO
	case 1: 
		$datos['idpadre'] = $funciones->limpia($_POST['idpadre']);
		$datos['archivo'] = $funciones->limpia($_POST['archivo']);
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['ordenamiento'] = $funciones->limpia($_POST['ordenamiento']);
		$datos['nombreicono'] = $funciones->limpia($_POST['nombreicono']);
		$datos['color'] = $funciones->limpia($_POST['color']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		$datos['tipo'] = $funciones->limpia($_POST['tipo']);
		
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
									
		$consulta = "INSERT INTO tblc_permiso(id_padre, archivo, nombre, ordenamiento, icono, color, estatus, tipo, fecha_registro) VALUES('".$datos['idpadre']."', '".$datos['archivo']."', '".$datos['nombre']."', '".$datos['ordenamiento']."', '".$datos['nombreicono']."', '".$datos['color']."', '".$datos['estatus']."', '".$datos['tipo']."', NOW())";

		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('permiso_registro', 'permiso_lista')
			);
			echo json_encode($data);
			exit(0);
		}
		
		$id = $conexion->ultimoid();
		
		$msj='Se registro el permiso '.$datos['nombre'].', con id: '.$id;
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs(), date('Y-m-d H:i:s'));
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('permiso_registro', 'permiso_lista')

		);
		echo json_encode($data);
		exit(0);
	
	break;
	////////// FIN REGISTRAR PERMISO

	////////// INICIO MODIFICAR PERMISO
	case 2:
		$datos['id'] = $funciones->limpia($_POST['id']);
		$datos['idpadre'] = $funciones->limpia($_POST['idpadre']);
		$datos['archivo'] = $funciones->limpia($_POST['archivo']);
		$datos['nombre'] = $funciones->limpia($_POST['nombre']);
		$datos['ordenamiento'] = $funciones->limpia($_POST['ordenamiento']);
		$datos['nombreicono'] = $funciones->limpia($_POST['nombreicono']);
		$datos['color'] = $funciones->limpia($_POST['color']);
		$datos['estatus'] = $funciones->limpia($_POST['estatus']);
		$datos['tipo'] = $funciones->limpia($_POST['tipo']);

		
		
		$consulta = "UPDATE tblc_permiso SET estatus = '".$datos['estatus']."', id_padre = '".$datos['idpadre']."', archivo = '".$datos['archivo']."', nombre = '".$datos['nombre']."', ordenamiento = '".$datos['ordenamiento']."', icono = '".$datos['nombreicono']."', color = '".$datos['color']."', tipo = '".$datos['tipo']."' WHERE id_permiso = ".$datos['id'];
		
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
		
		$msj='Se modifico el permiso '.$datos['nombre'].', con id: '.$datos['id'];
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs(), date('Y-m-d H:i:s'));
		$conexion->consulta($log);

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $editar,
			'tipo' => 'success',
			'funcion' => array('permiso_registro', 'permiso_lista')

		);
		echo json_encode($data);
		exit(0);

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
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs(), date('Y-m-d H:i:s'));
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
		$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs(), date('Y-m-d H:i:s'));
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
        $datos['lema']=$funciones->limpia($_POST['lema']);
		$datos['whatsapp'] = $funciones->limpia($_POST['whatsapp']);
		$datos['aviso_privacidad'] = $_POST['aviso_privacidad'];
		$datos['termino_condicion'] = $_POST['termino_condicion'];
        $datos['sobre_nosotros'] = $funciones->limpia($_POST['sobre_nosotros']);
        $datos['horario_dias_info'] = $funciones->limpia($_POST['horario_dia']);
        $datos['horario_horas_info'] = $funciones->limpia($_POST['horario_hora']);
        $datos['host'] = $funciones->limpia($_POST['host']);
        $datos['mision'] = $funciones->limpia($_POST['mision']);
        $datos['vision'] = $funciones->limpia($_POST['vision']);
        $datos['valores'] = $funciones->limpia($_POST['valores']);
        $datos['facebook'] = $funciones->limpia($_POST['facebook']);
        $datos['instagram'] = $funciones->limpia($_POST['instagram']);

		// ARCHIVO LOGO
		if(isset($_FILES["logo"]["tmp_name"]) AND $_FILES["logo"]["tmp_name"] != ""){

			if($upload->load("logo") === false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el archivo Logo',
					'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
					'tipo' => 'warning',
					'funcion' => array('registro_configuracion')
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
					'funcion' => array('registro_configuracion')
				);
		
				echo json_encode($data);
				exit(0);
			}

			$datos['logo'] = $datos['logo'];
		}else{
			$datos['logo'] = (isset($_POST['logo2']) && $_POST['logo2'] != NULL) ? $_POST['logo2'] : '';
		}
        ///
        // ARCHIVO LOGO
        if(isset($_FILES["logoF"]["tmp_name"]) AND $_FILES["logoF"]["tmp_name"] != ""){

            if($upload->load("logoF") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Logo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_configuracion')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/configuracion/imagenes/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['logoF'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/configuracion/imagenes/".$datos['logoF']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el Logo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo de nuevo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_configuracion')
                );

                echo json_encode($data);
                exit(0);
            }

            $datos['logoF'] = $datos['logoF'];
        }else{
            $datos['logoF'] = (isset($_POST['logoF2']) && $_POST['logoF2'] != NULL) ? $_POST['logoF2'] : '';
        }



				
		$consulta = "REPLACE INTO tblc_configuracion(id_configuracion, nombre_empresa, logo, correo, telefono, direccion, lema, whatsapp, aviso_privacidad, termino_condicion, sobre_nosotros, horario_dias_info, horario_horas_info, host, mision, vision, valores, facebook, instagram, logo2) 
					VALUES('1', '".$datos['nombre_empresa']."', '".$datos['logo']."', '".$datos['correo']."', '".$datos['telefono']."', '".$datos['direccion']."','".$datos['lema']."', '".$datos['whatsapp']."', '".$datos['aviso_privacidad']."', '".$datos['termino_condicion']."', '".$datos['sobre_nosotros']."', '".$datos['horario_dias_info']."', '".$datos['horario_horas_info']."', '".$datos['host']."', '".$datos['mision']."', '".$datos['vision']."', '".$datos['valores']."', '".$datos['facebook']."', '".$datos['instagram']."', '".$datos['logoF']."')";
		
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al guardar el registro, intentelo mas tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => array('registro_configuracion')

			);
			echo json_encode($data);
			exit(0);
		}

		$data = array(
			'error' => false,
			'titulo' => 'Correcto',
			'mensaje' => $guardar,
			'tipo' => 'success',
			'funcion' => array('registro_configuracion')
		);	

		echo json_encode($data);
		exit(0);
			
	break;
	////////// FIN CONFIGURACION





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

	//CLIENTE			
	case 28:

		$datos['nombre']				= $_POST['nombre'];
		$datos['enlace']  				= $_POST['enlace'];
		$datos['estatus']				= $_POST['estatus'];
		

		if( $conexion->consultaregistro("SELECT COUNT(id_cliente) FROM tbl_cliente WHERE nombre like '".$datos['nombre']."' AND fecha_eliminado IS NULL") >=1){

			$data = array(
				'error' => true,
				'titulo' => 'Aviso',
				'mensaje' => 'Aviso! El registro ingresado ya existe',
				'tipo' => 'warning'
			);
			echo json_encode($data);
			exit(0);
		}
		if(isset($_FILES["logo"]["tmp_name"]) AND $_FILES["logo"]["tmp_name"] != ""){

			if($upload->load("logo") === false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el archivo Archivo',
					'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
					'tipo' => 'warning',
					'funcion' => array('registro_cliente')
				);
		
				echo json_encode($data);
				exit(0);
			}

			$carpeta = "../archivos/cliente/";
			if (!file_exists($carpeta)) {
				mkdir($carpeta, 0777, true);
			}

			$datos['logo'] = $upload->nombre_final;
			$upload->setisimage(false);

			if($upload->save("../archivos/cliente/".$datos['logo']) == false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el archivo',
					'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
					'tipo' => 'warning',
					'funcion' => array('registro_cliente')
				);
				echo json_encode($data);
				exit(0);
			}
			$ruta = 'cliente/';
			$datos['logo'] = $ruta.$datos['logo'];
		}else{
			$datos['logo'] = (isset($_POST['logo2']) && $_POST['logo2'] != NULL) ? $_POST['logo2'] : '';
		}
			$consulta = "INSERT INTO tbl_cliente( nombre, enlace, estatus, logo, fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['enlace']."','".$datos['estatus']."', '".$datos['logo']."', NOW()) ";

			if($conexion->consulta($consulta) == 0){
				$data = array(
				'error' => true,
				'titulo' => 'ERROR',
				'mensaje' => 'Error al guardar el regitro',
				'tipo' => 'warning'
				);
				echo json_encode($data);
				exit(0);
			}

			$id = $conexion->ultimoid();

			$msj='Se registro el cliente '.$datos['nombre'].', con id: '.$id;
			$log = $querys->addSesionDetalle($id_usuario, $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
			$conexion->consulta($log);

			$data = array(
				'error' => false,
				'titulo' => 'Correcto',
				'mensaje' => $guardar,
				'tipo' => 'success',
				'funcion' => array('cliente_lista')
			);
			echo json_encode($data);
			exit(0);
			
	break;

	case 29:
		$datos['id'] 					= $_POST['id'];
		$datos['nombre']				= $_POST['nombre'];
		$datos['estatus']				= $_POST['estatus'];
		$datos['enlace']  		= $_POST['enlace'];

		if( $conexion->consultaregistro("SELECT COUNT(id_cliente) FROM tbl_cliente WHERE nombre like '".$datos['nombre']."' AND fecha_eliminado IS NULL AND id_cliente !=".$datos['id']) >=1){
			$data = array(
				'error' => true,
				'titulo' => 'Aviso',
				'mensaje' => 'El registro ya existe',
				'tipo' => 'warning'
				);
				echo json_encode($data);
				exit(0);
		}
		// IMAGEN WEB
		if(isset($_FILES["logo"]["tmp_name"]) AND $_FILES["logo"]["tmp_name"] != ""){

			if($upload->load("logo") === false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el archivo Archivo',
					'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
					'tipo' => 'warning',
					'funcion' => array('registro_cliente')
				);
		
				echo json_encode($data);
				exit(0);
			}

			$carpeta = "../archivos/cliente/";
			if (!file_exists($carpeta)) {
				mkdir($carpeta, 0777, true);
			}

			$datos['logo'] = $upload->nombre_final;
			$upload->setisimage(false);

			if($upload->save("../archivos/cliente/".$datos['logo']) == false){
				$data = array(
					'error' => true,
					'titulo' => 'Error en el archivo',
					'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
					'tipo' => 'warning',
					'funcion' => array('registro_cliente')
				);
				echo json_encode($data);
				exit(0);
			}
			$ruta = 'cliente/';
			$datos['logo'] = $ruta.$datos['logo'];
		}else{
			$datos['logo'] = (isset($_POST['logo2']) && $_POST['logo2'] != NULL) ? $_POST['logo2'] : '';
		}

		$consulta = "UPDATE tbl_cliente SET  nombre = '".$datos['nombre']."',  enlace = '".$datos['enlace']."', estatus = '".$datos['estatus']."', logo = '".$datos['logo']."' WHERE id_cliente = ".$datos['id'];

		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'ERROR',
				'mensaje' => 'Error al guardar el regitro',
				'tipo' => 'warning'
				);
				echo json_encode($data);
				exit(0);
		}

			$msj='Se modifico el cliente '.$datos['nombre'].', con id: '.$datos['id'];
			$log = $querys->addSesionDetalle($id_usuario, $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
			$conexion->consulta($log);

			$data = array(
				'error' => false,
				'titulo' => 'Correcto',
				'mensaje' => $editar,
				'tipo' => 'success',
				'funcion' => array('cliente_lista')
			);
			echo json_encode($data);
			exit(0);
	
	break;

    //-----------------------------BLOG---------------------------------
    case 110:
        $datos['titulo'] 		     = $funciones->limpia($_POST['titulo']);
        $datos['contenido'] 	     = addslashes($_POST['text1']);
        $datos['estatus']		     = $_POST['estatus'];
        $datos['fecha'] 		     = $funciones->cambiarformatofechabase($_POST['fecha']);
        $datos['categoria']	         = $_POST['categoria'];
        $datos['etiqueta']           = $_POST['etiqueta'];
        $datos['autor']              = $funciones->limpia($_POST['autor']);
        $datos['frase_importante01'] = $funciones->limpia($_POST['frase_importante01']);
        $datos['frase_importante02'] = $funciones->limpia($_POST['frase_importante02']);


        if($conexion->consultaregistro("SELECT COUNT(id_blog) FROM tbl_blog WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_blog) FROM tbl_blog WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        //Archivos
        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/blog/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/blog/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/blog/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }

        $consulta = "INSERT INTO tbl_blog(titulo, contenido, fecha, id_categoria_blog, portada_imagen, enlace, nombre_autor, frase_importante01, frase_importante02, id_etiqueta_blog, fecha_registro) 
				VALUES ('".$datos['titulo']."', '".$datos['contenido']."', '".$datos['fecha']."', ".$datos['categoria'].",'".$datos['portada_imagen']."', '".$datos['enlace']."','".$datos['autor']."','".$datos['frase_importante01']."','".$datos['frase_importante02']."','".$datos['etiqueta']."', now())";
        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();
        $msj='Se registro el blog '.$datos['titulo'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);
        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('lista_blog')
        );
        echo json_encode($data);
        header("Location: " . $info[13] . "/admin/blog");
        exit(0);
        break;
    //---------------editar blog-------------------
    case 111:
        $datos['id']			 = $_POST['id'];
        $datos['titulo'] 		 = $funciones->limpia($_POST['titulo']);
        $datos['estatus']		 = $_POST['estatus'];
        $datos['contenido'] 	 = addslashes($_POST['text1']);
        $datos['fecha'] 		 = $funciones->cambiarformatofechabase($_POST['fecha']);
        $datos['categoria']	     = $_POST['categoria'];
        $datos['etiqueta']           = $_POST['etiqueta'];
        $datos['autor']              = $funciones->limpia($_POST['autor']);
        $datos['frase_importante01'] = $funciones->limpia($_POST['frase_importante01']);
        $datos['frase_importante02'] = $funciones->limpia($_POST['frase_importante02']);

        if($conexion->consultaregistro("SELECT COUNT(id_blog) FROM tbl_blog WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."' AND id_blog != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }
        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_blog) FROM tbl_blog WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."' AND id_blog != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/blog/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/blog/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/blog/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
            unlink('../archivos/web/blog/'.$_POST['portada_imagen2']);
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }


        $consulta = "UPDATE tbl_blog SET fecha = '".$datos['fecha']."', contenido = '".$datos['contenido']."', titulo = '".$datos['titulo']."', portada_imagen = '".$datos['portada_imagen']."', enlace = '".$datos['enlace']."', estatus = '".$datos['estatus']."', nombre_autor = '".$datos['autor']."', frase_importante01 = '".$datos['frase_importante01']."', frase_importante02 = '".$datos['frase_importante02']."', id_etiqueta_blog = '".$datos['etiqueta']."' WHERE id_blog = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico el blog '.$datos['titulo'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('lista_blog')
        );
        echo json_encode($data);
        header("Location: " . $info[13] . "/admin/blog");
        exit(0);
        break;
    /// CATEGORIA BLOG
    case 112:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['estatus']  			= $_POST['estatus'];

        if( $conexion->consultaregistro("SELECT COUNT(id_categoria_blog) FROM tblc_categoria_blog WHERE nombre = '".$datos['nombre']."' ") >=1){
            echo '<script>parent.alert("Aviso! El estado ingresada ya existe, intente con otro registro.");</script>';
            exit(0);
        }

        $consulta = "INSERT INTO tblc_categoria_blog(nombre, estatus, fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['estatus']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro la categoria blog '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('registro_categoriablog', 'lista_categoriablog')
        );
        echo json_encode($data);
        exit(0);
        break;

    case 113:
        $datos['id'] 				= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['estatus']  			= $_POST['estatus'];

        $consulta = "UPDATE tblc_categoria_blog SET nombre = '".$datos['nombre']."',estatus = '".$datos['estatus']."' WHERE id_categoria_blog = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico la categoria '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_categoriablog', 'lista_categoriablog')
        );
        echo json_encode($data);
        exit(0);
        break;

    /// ETIQUETA BLOG
    case 114:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['estatus']  			= $_POST['estatus'];

        if( $conexion->consultaregistro("SELECT COUNT(id_etiqueta_blog) FROM tblc_etiqueta_blog WHERE nombre = '".$datos['nombre']."' ") >=1){
            echo '<script>parent.alert("Aviso! El estado ingresada ya existe, intente con otro registro.");</script>';
            exit(0);
        }

        $consulta = "INSERT INTO tblc_etiqueta_blog(nombre, estatus, fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['estatus']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro la etiqueta blog '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('registro_etiquetablog', 'lista_etiquetablog')
        );
        echo json_encode($data);
        exit(0);
        break;

    case 115:
        $datos['id'] 				= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['estatus']  			= $_POST['estatus'];

        $consulta = "UPDATE tblc_etiqueta_blog SET nombre = '".$datos['nombre']."',estatus = '".$datos['estatus']."' WHERE id_etiqueta_blog = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico la etiqueta '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_etiquetablog', 'lista_etiquetablog')
        );
        echo json_encode($data);
        exit(0);
    break;
    //proyecto
    case 116:
        $datos['titulo'] 		     = $funciones->limpia($_POST['titulo']);
        $datos['contenido'] 	     = addslashes($_POST['text1']);
        $datos['estatus']		     = $_POST['estatus'];
        $datos['fecha'] 		     = $funciones->cambiarformatofechabase($_POST['fecha']);
        $datos['categoria']	         = $_POST['categoria'];
        $datos['nombre_cliente']     =$funciones->limpia($_POST['nombre_cliente']);
        $datos['sitio_web_cliente']  =$funciones->limpia($_POST['sitio_web_cliente']);
        $datos['ubicacion_proyecto'] =$funciones->limpia($_POST['ubicacion_proyecto']);
        $datos['valor_proyecto']     =$funciones->limpia($_POST['valor_proyecto']);


        if($conexion->consultaregistro("SELECT COUNT(id_proyecto) FROM tbl_proyecto WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_proyecto) FROM tbl_proyecto WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_proyecto')
            );
            echo json_encode($data);
            exit(0);
        }

        //Archivos
        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_proyecto')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/proyecto/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/proyecto/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_proyecto')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/proyecto/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }

        $consulta = "INSERT INTO tbl_proyecto(titulo, contenido, fecha, id_categoria_proyecto, portada_imagen, enlace, nombre_cliente, sitio_web_cliente, ubicacion_proyecto, valor_proyecto ,fecha_registro)
                    VALUES ('".$datos['titulo']."','".$datos['contenido']."','".$datos['fecha']."','".$datos['categoria']."','".$datos['portada_imagen']."','".$datos['enlace']."','".$datos['nombre_cliente']."','".$datos['sitio_web_cliente']."','".$datos['ubicacion_proyecto']."','".$datos['valor_proyecto']."', now())";
        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();
        $msj='Se registro el proyecto '.$datos['titulo'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);
        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('lista_proyecto')
        );
        echo json_encode($data);
        header("Location: " . $info[13] . "/admin/proyecto");
        exit(0);
    break;
    case 117:
        $datos['id']			 = $_POST['id'];
        $datos['titulo'] 		     = $funciones->limpia($_POST['titulo']);
        $datos['contenido'] 	     = addslashes($_POST['text1']);
        $datos['estatus']		     = $_POST['estatus'];
        $datos['fecha'] 		     = $funciones->cambiarformatofechabase($_POST['fecha']);
        $datos['categoria']	         = $_POST['categoria'];
        $datos['nombre_cliente']     =$funciones->limpia($_POST['nombre_cliente']);
        $datos['sitio_web_cliente']  =$funciones->limpia($_POST['sitio_web_cliente']);
        $datos['ubicacion_proyecto'] =$funciones->limpia($_POST['ubicacion_proyecto']);
        $datos['valor_proyecto']     =$funciones->limpia($_POST['valor_proyecto']);

        if($conexion->consultaregistro("SELECT COUNT(id_proyecto) FROM tbl_proyecto WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."' AND id_proyecto != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_proyecto')
            );
            echo json_encode($data);
            exit(0);
        }
        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_proyecto) FROM tbl_proyecto WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."' AND id_proyecto != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_proyecto')
            );
            echo json_encode($data);
            exit(0);
        }

        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_proyecto')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/proyecto/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/proyecto/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_proyecto')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/proyecto/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
            unlink('../archivos/web/proyecto/'.$_POST['portada_imagen2']);
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }

        $consulta = "UPDATE tbl_proyecto SET fecha = '".$datos['fecha']."', contenido = '".$datos['contenido']."', titulo = '".$datos['titulo']."', portada_imagen = '".$datos['portada_imagen']."', enlace = '".$datos['enlace']."', estatus = '".$datos['estatus']."', nombre_cliente = '".$datos['nombre_cliente']."', sitio_web_cliente = '".$datos['sitio_web_cliente']."', ubicacion_proyecto = '".$datos['ubicacion_proyecto']."', valor_proyecto = '".$datos['valor_proyecto']."' WHERE id_proyecto = ".$datos['id'];
        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico el proyecto '.$datos['titulo'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('lista_proyecto')
        );
        echo json_encode($data);
        header("Location: " . $info[13] . "/admin/proyecto");
        exit(0);
    break;
    //Categoria Proyecto
    case 118:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['estatus']  			= $_POST['estatus'];

        if( $conexion->consultaregistro("SELECT COUNT(id_categoria_proyecto) FROM tblc_categoria_proyecto WHERE nombre = '".$datos['nombre']."' ") >=1){
            echo '<script>parent.alert("Aviso! El estado ingresada ya existe, intente con otro registro.");</script>';
            exit(0);
        }

        $consulta = "INSERT INTO tblc_categoria_proyecto(nombre, estatus, fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['estatus']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro la categoria proyecto '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('registro_categoriaproyecto', 'lista_categoriaproyecto')
        );
        echo json_encode($data);
        exit(0);
        break;

    case 119:
        $datos['id'] 				= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['estatus']  			= $_POST['estatus'];

        $consulta = "UPDATE tblc_categoria_proyecto SET nombre = '".$datos['nombre']."',estatus = '".$datos['estatus']."' WHERE id_categoria_proyecto = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico la categoria '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_categoriaproyecto', 'lista_categoriaproyecto')
        );
        echo json_encode($data);
        exit(0);
        break;

        // SERVICIO
    case 120:
        $datos['titulo'] 		     = $funciones->limpia($_POST['titulo']);
        $datos['contenido'] 	     = $_POST['text1'];
        $datos['estatus']		     = $_POST['estatus'];
        $datos['categoria']	         = $_POST['categoria'];

        if($conexion->consultaregistro("SELECT COUNT(id_servicio) FROM tbl_servicio WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_servicio')
            );
            echo json_encode($data);
            exit(0);
        }

        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_servicio) FROM tbl_servicio WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_servicio'),

            );
            echo json_encode($data);
            header("Location: " . $info[13] . "/admin/servicio");
            exit(0);
        }

        //Archivos
        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_servicio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/servicio/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/servicio/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_servicio')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/servicio/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }

        $consulta = "INSERT INTO tbl_servicio(titulo, contenido, id_categoria_servicio, portada_imagen, enlace, fecha_registro)
                     VALUES ('".$datos['titulo']."', '".$datos['contenido']."', '".$datos['categoria']."', '".$datos['portada_imagen']."', '".$datos['enlace']."', now())";
        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();
        $msj='Se registro el servicio '.$datos['titulo'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);
        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('lista_servicio')
        );
        echo json_encode($data);
        header("Location: " . $info[13] . "/admin/servicio");
        exit(0);
        break;
    case 121:
        $datos['id']			 = $_POST['id'];
        $datos['titulo'] 		 = $funciones->limpia($_POST['titulo']);
        $datos['estatus']		 = $_POST['estatus'];
        $datos['contenido'] 	 = addslashes($_POST['text1']);
        $datos['categoria']	     = $_POST['categoria'];

        if($conexion->consultaregistro("SELECT COUNT(id_servicio) FROM tbl_servicio WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."' AND id_servicio != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_servicio')
            );
            echo json_encode($data);
            exit(0);
        }
        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_servicio) FROM tbl_servicio WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."' AND id_servicio != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_servicio')
            );
            echo json_encode($data);
            exit(0);
        }

        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_servicio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/servicio/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/servicio/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_servicio')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/servicio/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
            unlink('../archivos/web/servicio/'.$_POST['portada_imagen2']);
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }


        $consulta = "UPDATE tbl_servicio SET contenido = '".$datos['contenido']."', titulo = '".$datos['titulo']."', portada_imagen = '".$datos['portada_imagen']."', enlace = '".$datos['enlace']."', estatus = '".$datos['estatus']."' WHERE id_servicio =".$datos['id'];
        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico el blog '.$datos['titulo'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('lista_servicio')
        );
        echo json_encode($data);
        header("Location: " . $info[13] . "/admin/servicio");
        exit(0);
        break;
        // CATEGORIA SERVICIO
    case 122:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['descripcion']  		= $_POST['descripcion'];
        $datos['estatus']  			= $_POST['estatus'];

        if(isset($_FILES["imagen"]["tmp_name"]) AND $_FILES["imagen"]["tmp_name"] != ""){

            if($upload->load("imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/categoriaservicio/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/categoriaservicio/".$datos['imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/categoriaservicio/';
            $datos['imagen'] = $ruta.$datos['imagen'];
        }else{
            $datos['imagen'] = (isset($_POST['imagen2']) && $_POST['imagen2'] != NULL) ? $_POST['imagen2'] : '';
        }

        if( $conexion->consultaregistro("SELECT COUNT(id_categoria_servicio) FROM tblc_categoria_servicio WHERE nombre = '".$datos['nombre']."' ") >=1){
            echo '<script>parent.alert("Aviso! El estado ingresada ya existe, intente con otro registro.");</script>';
            exit(0);
        }

        $consulta = "INSERT INTO tblc_categoria_servicio(nombre, estatus, descripcion, archivo, fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['estatus']."', '".$datos['descripcion']."', '".$datos['imagen']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro la categoria servicio '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('registro_categoriaservicio', 'lista_categoriaservicio')
        );
        echo json_encode($data);
        exit(0);
        break;

    case 123:
        $datos['id'] 				= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['descripcion']  		= $_POST['descripcion'];
        $datos['estatus']  			= $_POST['estatus'];

        if(isset($_FILES["imagen"]["tmp_name"]) AND $_FILES["imagen"]["tmp_name"] != ""){

            if($upload->load("imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/categoriaservicio/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/categoriaservicio/".$datos['imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/categoriaservicio/';
            $datos['imagen'] = $ruta.$datos['imagen'];
        }else{
            $datos['imagen'] = (isset($_POST['imagen2']) && $_POST['imagen2'] != NULL) ? $_POST['imagen2'] : '';
        }

        /*if( $conexion->consultaregistro("SELECT COUNT(id_categoria_servicio) FROM tblc_categoria_servicio WHERE nombre = '".$datos['nombre']."' AND id_categoria_servicio != ".$datos['id']) >= 1){

            $data = array(
                    'error' => true,
                    'titulo' => 'AVISO',
                    'mensaje' => 'El registro ya existe',
                    'tipo' => 'warning'
                );
                echo json_encode($data);
                exit(0);
        }*/

        $consulta = "UPDATE tblc_categoria_servicio SET nombre = '".$datos['nombre']."', estatus = '".$datos['estatus']."', descripcion = '".$datos['descripcion']."', archivo = '".$datos['imagen']."' WHERE id_categoria_servicio = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico la categoria '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_categoriaservicio', 'lista_categoriaservicio')
        );
        echo json_encode($data);
        exit(0);
        break;
        /// PREGUNTA FRECUENTES
    case 124:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['respuesta']         = $_POST['respuesta'];
        $datos['categoria']         = $_POST['categoria'];
        $datos['categoria2']         = $_POST['categoria2'];
        $datos['estatus']  			= $_POST['estatus'];

        if( $conexion->consultaregistro("SELECT COUNT(id_pregunta_frecuente) FROM tblc_pregunta_frecuente WHERE nombre = '".$datos['nombre']."' ") >=1){
            echo '<script>parent.alert("Aviso! El estado ingresada ya existe, intente con otro registro.");</script>';
            exit(0);
        }

        $consulta = "INSERT INTO tblc_pregunta_frecuente(nombre, respuesta, id_servicio, estatus, id_categoria_servicio, fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['respuesta']."', '".$datos['categoria']."', '".$datos['estatus']."', '".$datos['categoria2']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro la pregunta '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('registro_preguntafrecuente', 'lista_preguntafrecuente')
        );
        echo json_encode($data);
        exit(0);
        break;

    case 125:
        $datos['id'] 				= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['respuesta']         = $_POST['respuesta'];
        $datos['categoria']         = $_POST['categoria'];
        $datos['categoria2']         = $_POST['categoria2'];
        $datos['estatus']  			= $_POST['estatus'];

        $consulta = "UPDATE tblc_pregunta_frecuente SET nombre = '".$datos['nombre']."', respuesta =  '".$datos['respuesta']."',id_servicio =  '".$datos['categoria']."',id_categoria_servicio =  '".$datos['categoria2']."',estatus = '".$datos['estatus']."' WHERE id_pregunta_frecuente = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico la pregunta '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_preguntafrecuente', 'lista_preguntafrecuente')
        );
        echo json_encode($data);
        exit(0);
        break;

        ////////
    /// TESTIMONIO
    case 126:
        $datos['titulo'] 		     = $funciones->limpia($_POST['titulo']);
        $datos['contenido'] 	     = addslashes($_POST['text1']);
        $datos['estatus']		     = $_POST['estatus'];
        $datos['sector']             = $_POST['sector'];



        if($conexion->consultaregistro("SELECT COUNT(id_testimonio) FROM tbl_testimonio WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_testimonio) FROM tbl_testimonio WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."'") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        //Archivos
        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/testimonio/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/testimonio/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/testimonio/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }

        $consulta = "INSERT INTO tbl_testimonio(titulo, contenido, portada_imagen, enlace, sector, fecha_registro)
                VALUES('".$datos['titulo']."','".$datos['contenido']."','".$datos['portada_imagen']."','".$datos['enlace']."','".$datos['sector']."', now())";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();
        $msj='Se registro el testimonio '.$datos['titulo'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);
        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('lista_testimonio')
        );
        echo json_encode($data);
        exit(0);
        break;
    //---------------editar blog-------------------
    case 127:
        $datos['id']			 = $_POST['id'];
        $datos['titulo'] 		 = $funciones->limpia($_POST['titulo']);
        $datos['estatus']		 = $_POST['estatus'];
        $datos['contenido'] 	 = addslashes($_POST['text1']);
        $datos['sector']         = $_POST['sector'];

        if($conexion->consultaregistro("SELECT COUNT(id_testimonio) FROM tbl_testimonio WHERE fecha_eliminado IS NULL AND titulo LIKE '".$datos['titulo']."' AND id_testimonio != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_testimonio')
            );
            echo json_encode($data);
            exit(0);
        }
        $datos['enlace'] = $funciones->url_amiga($funciones->limpia($_POST['titulo']));
        if($conexion->consultaregistro("SELECT COUNT(id_testimonio) FROM tbl_testimonio WHERE fecha_eliminado IS NULL AND enlace = '".$datos['enlace']."' AND id_testimonio != '".$datos['id']."' ") >= 1){
            $data = array(
                'error' => true,
                'titulo' => 'Existente',
                'mensaje' => 'El dato que desea ingresar ya existe, intente con otro registro. ¡Gracias!',
                'tipo' => 'info',
                'funcion' => array('registro_blog')
            );
            echo json_encode($data);
            exit(0);
        }

        if(isset($_FILES["portada_imagen"]["tmp_name"]) AND $_FILES["portada_imagen"]["tmp_name"] != ""){

            if($upload->load("portada_imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/testimonio/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['portada_imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/testimonio/".$datos['portada_imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/testimonio/';
            $datos['portada_imagen'] = $ruta.$datos['portada_imagen'];
            unlink('../archivos/web/testimonio/'.$_POST['portada_imagen2']);
        }else{
            $datos['portada_imagen'] = (isset($_POST['portada_imagen2']) && $_POST['portada_imagen2'] != NULL) ? $_POST['portada_imagen2'] : '';
        }


        $consulta = "UPDATE tbl_testimonio SET contenido = '".$datos['contenido']."', titulo = '".$datos['titulo']."', portada_imagen = '".$datos['portada_imagen']."', enlace = '".$datos['enlace']."', estatus = '".$datos['estatus']."', sector = '".$datos['sector']."' WHERE id_testimonio = ".$datos['id'];
        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico el testimonio '.$datos['titulo'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('lista_blog')
        );
        echo json_encode($data);
        exit(0);
        break;

    /// COMENTARIO BLOG
    case 128:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['correo']            = $_POST['correo'];
        $datos['mensaje']           = $_POST['text1'];
        $datos['estatus']  			= $_POST['estatus'];
        $datos['blog']              = $_POST['blog'];

        if( $conexion->consultaregistro("SELECT COUNT(id_comentario) FROM tblc_comentario WHERE nombre = '".$datos['nombre']."' ") >=1){
            echo '<script>parent.alert("Aviso! El estado ingresada ya existe, intente con otro registro.");</script>';
            exit(0);
        }

        $consulta = "INSERT INTO tblc_comentario(nombre, estatus,correo,mensaje,id_blog,fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['estatus']."','".$datos['correo']."','".$datos['mensaje']."','".$datos['blog']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro el comentario de '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('registro_comentario', 'lista_comentario')
        );
        echo json_encode($data);
        exit(0);
        break;
        //EDITAR COMENTARIO
    case 129:
        $datos['id'] 				= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['correo']            = $_POST['correo'];
        $datos['mensaje']           = $_POST['text1'];
        $datos['estatus']  			= $_POST['estatus'];
        $datos['blog']              = $_POST['blog'];

        $consulta = "UPDATE tblc_comentario SET nombre = '".$datos['nombre']."',correo = '".$datos['correo']."',mensaje = '".$datos['mensaje']."',estatus = '".$datos['estatus']."',id_blog = '".$datos['blog']."' WHERE id_comentario = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico el comentario de '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_comentario', 'lista_comentario')
        );
        echo json_encode($data);
        exit(0);
        break;
    case 130:

        $datos['nombre']  			= $_POST['nombre'];
        $datos['correo']            = $_POST['correo'];
        $datos['mensaje']           = $_POST['text1'];
        $datos['estatus']  			= $_POST['estatus'];
        $datos['blog']              = $_POST['blog'];
        $datos['url']               =$_POST['url'];

        $consulta = "INSERT INTO tblc_comentario(nombre, estatus,correo,mensaje,id_blog,fecha_registro) 
			VALUES ('".$datos['nombre']."', '".$datos['estatus']."','".$datos['correo']."','".$datos['mensaje']."','".$datos['blog']."', NOW()) ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }


        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('registro_comentario', 'lista_comentario')
        );

        header("Location: " . $datos['url']);
        exit(0);
        break;

     /// COMENTARIO BLOG
    case 131:
        $datos['nombre']  			= $_POST['nombre'];
        $datos['subtitulo']  		= $_POST['subtitulo'];
        $datos['orden']            = $_POST['orden'];
        $datos['enlace']           = $_POST['enlace'];
        $datos['estatus']  			= $_POST['estatus'];

        //Archivos
        if(isset($_FILES["imagen"]["tmp_name"]) AND $_FILES["imagen"]["tmp_name"] != ""){

            if($upload->load("imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/slider/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/slider/".$datos['imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/slider/';
            $datos['imagen'] = $ruta.$datos['imagen'];
        }else{
            $datos['imagen'] = (isset($_POST['imagen2']) && $_POST['imagen2'] != NULL) ? $_POST['imagen2'] : '';
        }

        $consulta = "INSERT INTO tbl_slider(nombre, subtitulo, archivo, enlace, orden, estatus) 
			VALUES ('".$datos['nombre']."', '".$datos['subtitulo']."', '".$datos['imagen']."','".$datos['enlace']."','".$datos['orden']."','".$datos['estatus']."') ";

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }
        $id = $conexion->ultimoid();

        $msj='Se registro el slider '.$datos['nombre'].', con id: '.$id;
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $guardar,
            'tipo' => 'success',
            'funcion' => array('slider_registro', 'slider_lista')
        );
        echo json_encode($data);
        exit(0);
        break;
        //EDITAR COMENTARIO
    case 132:
        $datos['id']  			= $_POST['id'];
        $datos['nombre']  			= $_POST['nombre'];
        $datos['subtitulo']  		= $_POST['subtitulo'];
        $datos['orden']            = $_POST['orden'];
        $datos['enlace']           = $_POST['enlace'];
        $datos['estatus']  			= $_POST['estatus'];

        if(isset($_FILES["imagen"]["tmp_name"]) AND $_FILES["imagen"]["tmp_name"] != ""){

            if($upload->load("imagen") === false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo Archivo',
                    'mensaje' => '¡¡ERROR!! Formato de archivo no permitido...',
                    'tipo' => 'warning',
                    'funcion' => array('registro_testimonio')
                );

                echo json_encode($data);
                exit(0);
            }

            $carpeta = "../archivos/web/slider/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $datos['imagen'] = $upload->nombre_final;
            $upload->setisimage(false);

            if($upload->save("../archivos/web/slider/".$datos['imagen']) == false){
                $data = array(
                    'error' => true,
                    'titulo' => 'Error en el archivo',
                    'mensaje' => '¡¡ERROR!! Fallo al guardar el archivo, inténtelo mas tarde. ¡Gracias!',
                    'tipo' => 'warning',
                    'funcion' => array('registro_blog')
                );
                echo json_encode($data);
                exit(0);
            }
            $ruta = 'web/slider/';
            $datos['imagen'] = $ruta.$datos['imagen'];
        }else{
            $datos['imagen'] = (isset($_POST['imagen2']) && $_POST['imagen2'] != NULL) ? $_POST['imagen2'] : '';
        }

        $consulta = "UPDATE tbl_slider SET subtitulo = '".$datos['subtitulo']."', nombre = '".$datos['nombre']."', enlace = '".$datos['enlace']."',orden = '".$datos['orden']."',estatus = '".$datos['estatus']."', archivo = '".$datos['imagen']."' WHERE id_slider = ".$datos['id'];

        if($conexion->consulta($consulta) == 0){
            echo '<script>parent.alert("ERROR al guardar el registro, intente de nuevo más tarde");</script>';
            exit(0);
        }

        $msj='Se modifico el slider '.$datos['nombre'].', con id: '.$datos['id'];
        $log = $querys->addSesionDetalle($datos_sis['id_usuario'], $ip, $navegador, $so, $msj, $consulta, date('Y-m-d H:i:s'));
        $conexion->consulta($log);

        $data = array(
            'error' => false,
            'titulo' => 'Correcto',
            'mensaje' => $editar,
            'tipo' => 'success',
            'funcion' => array('slider_registro', 'slider_lista')
        );
        echo json_encode($data);
        exit(0);
        break;
}
?>