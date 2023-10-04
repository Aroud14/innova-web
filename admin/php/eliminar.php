<?php
@session_start();
$autentificado_sis = $_SESSION['autentificado_sis'];
$datos_sis = $_SESSION['datos_sis'];

require ("clase_variables.php");
require ("clase_mysql.php");
require ("clase_funciones.php");
require ("clase_querys.php");

$funciones = new Funciones();
//LLAMAMOS A LA CLASE CONEXION
$conexion = new DB_mysql(1);
$querys    = new Querys();

$datos = array();
$datos['id'] = $_POST['id'];
if(isset($_POST['id2'])){$datos['id2'] = $_POST['id2'];}

switch($_POST['opcion']){
	//////////////////////////////// INICIO ELIMINAR PERMISOS	
	case 1:	
		$info = $conexion->fetch_array($querys->getpermiso($datos['id']));
		
		$consulta = $querys->eliminarPermisosForaneos($datos['id']);
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al eliminar el registro, inténtelo de nuevo más tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null,
			);
			echo json_encode($data);
			exit(0);
		}

		$consulta = $querys->eliminarpermiso($datos['id']);
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al eliminar el registro, inténtelo de nuevo más tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null,
			);
			echo json_encode($data);
			exit(0);
		}
		
		$msj='Se elimino el permiso '.$info['nombre'];
		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $msj,
			'tipo' => 'success',
			'funcion' => array('permiso_lista')
		);
		echo json_encode($data);
		exit(0);
	break;
	//////////////////////////////// FIN ELIMINAR PERMISOS	


	//////////////////////////////// INICIO ELIMINAR USUARIOS
	case 2:
		$info = $conexion->fetch_array($querys->getUsuario($datos['id']));

		$consulta = $querys->eliminarusuarios($datos['id']);
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al eliminar el registro, inténtelo de nuevo más tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null,
			);
			echo json_encode($data);
			exit(0);
		}

		$msj='Se elimino el usuario '.$info['nombre'].' '.$info['paterno'].' '.$info['materno'];
		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $msj,
			'tipo' => 'success',
			'funcion' => array('lista_usuario')
		);
		echo json_encode($data);
		exit(0);
	break;
	//////////////////////////////// FIN ELIMINAR USUARIOS

	//////////////////////////////// INICIO ELIMINAR ESTADO
	case 3:
		$info = $conexion->fetch_array($querys->getEstado($datos['id']));
		$consulta = $querys->eliminarEstado($datos['id']);
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al eliminar el registro, inténtelo de nuevo más tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null,
			);
			echo json_encode($data);
			exit(0);
		}
		$msj='El Estado '.$info['nombre'] .' se eliminó correctamente';
		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $msj,
			'tipo' => 'success',
			'funcion' => array('lista_estado')
		);
		echo json_encode($data);
		exit(0);
	break;
	//////////////////////////////// FIN ELIMINAR ESTADO

	//////////////////////////////// INICIO ELIMINAR MUNICIPIO
	case 4:
		$info = $conexion->fetch_array($querys->getMunicipio($datos['id']));
		$consulta = $querys->eliminarMunicipio($datos['id']);
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al eliminar el registro, inténtelo de nuevo más tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null,
			);
			echo json_encode($data);
			exit(0);
		}
		$msj='El Municipio '.$info['nombre'] .' se eliminó correctamente';
		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $msj,
			'tipo' => 'success',
			'funcion' => array('lista_municipio')
		);
		echo json_encode($data);
		exit(0);
	break;
	//////////////////////////////// FIN ELIMINAR MUNICIPIO


	//////////////////////////////// INICIO ELIMINAR HORARIO USUARIO
	case 5:
		$info = $conexion->fetch_array($querys->getHorarioUsuario($datos['id']));
		$consulta = $querys->eliminarHorarioUsuario($datos['id']);
		if($conexion->consulta($consulta) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => 'Fallo al eliminar el registro, inténtelo de nuevo más tarde. ¡Gracias!',
				'tipo' => 'warning',
				'funcion' => null,
			);
			echo json_encode($data);
			exit(0);
		}
		$msj='El horario de '.$info['hora_inicio'].' a '.$info['hora_termino'].' se eliminó correctamente';
		$data = array(
			'error' => false,
			'titulo' => 'Completado',
			'mensaje' => $msj,
			'tipo' => 'success',
			'funcion' => array('modal_usuario_horario_lista'),
			'params' => array([$info['id_usuario']])
		);
		echo json_encode($data);
		exit(0);
	break;
	//////////////////////////////// FIN ELIMINAR HORARIO USUARIO

}

$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs(), date('Y-m-d H:i:s'));
$conexion->consulta($log);

echo $msj;
?>