<?php
@session_start();
$autentificado_sis = $_SESSION['autentificado_sis'];
$datos_sis         = $_SESSION['datos_sis'];
$nombre_usuario    = $datos_sis['nombre'];

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

    case 20: //ELIMINAR CLIENTE 
        $info = $conexion->fetch_array($querys->getcliente($datos['id']));
        $consulta = $querys->eliminarcliente($datos['id']);
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
        $msj='Se elimino el cliente '.$info['nombre'].', fue eliminado por el usuario '.$nombre_usuario;
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_cliente')
        );
        echo json_encode($data);
        exit(0);
    break;


    /////////////////////////////// INICIO ELIMINAR BLOG
    case 23:
        $info = $conexion->fetch_array($querys->getBlog($datos['id']));
        $consulta = $querys->eliminarBlog($datos['id']);
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
        $msj= "El blog {$info['titulo']} con id: {$info['id_blog']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_blog')
        );
        echo json_encode($data);
        exit(0);
    break;
    /////////////////////////////// FIN ELIMINAR BLOG

    /////////////////////////////// INICIO ELIMINAR CATEGORIA BLOG
    case 24: // ELIMINAR CATEGORIA BLOG
        $info = $conexion->fetch_array($querys->getcategoriablog($datos['id']));
        $consulta = $querys->eliminarcategoriablog($datos['id']);
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
        $msj= "Se eliminio la categoria blog {$info['nombre']} con id: {$info['id_categoria_blog']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_categoriablog')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR CATEGORIA BLOG
    /////////////////////////////// INICIO ELIMINAR ETIQUETA BLOG
    case 25: // ELIMINAR CATEGORIA BLOG
        $info = $conexion->fetch_array($querys->getetiquetablog($datos['id']));
        $consulta = $querys->eliminaretiquetablog($datos['id']);
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
        $msj= "Se eliminio la etiqueta blog {$info['nombre']} con id: {$info['id_etiqueta_blog']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_etiquetablog')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR ETIQUETA BLOG
    ////////////////////////////// INICIO ELIMINAR PROYECTO
    case 26:
        $info = $conexion->fetch_array($querys->getproyecto($datos['id']));
        $consulta = $querys->eliminarproyecto($datos['id']);
        if($conexion->consulta($consulta) == 0){
            $data = array(
                'error' => true,
                'titulo' => 'Error',
                'mensaje' => 'Fallo al eliminar el proyecto, inténtelo de nuevo más tarde. ¡Gracias!',
                'tipo' => 'warning',
                'funcion' => null,
            );
            echo json_encode($data);
            exit(0);
        }
        $msj= "El blog {$info['titulo']} con id: {$info['id_proyecto']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_proyecto')
        );
        echo json_encode($data);
        exit(0);
    break;
    ////////////////////////////// FIN ELIMINAR PROYECTO

    /////////////////////////////// INICIO ELIMINAR CATEGORIA PROYECTO
    case 27: // ELIMINAR CATEGORIA PROYECTO
        $info = $conexion->fetch_array($querys->getcategoriaproyecto($datos['id']));
        $consulta = $querys->eliminarcategoriaproyecto($datos['id']);
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
        $msj= "Se eliminio la categoria proyecto {$info['nombre']} con id: {$info['id_categoria_proyecto']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_categoriaproyecto')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR CATEGORIA PROYECTO
    ////////////////////////////// INICIO ELIMINAR SERVICIO
    case 28:
        $info = $conexion->fetch_array($querys->getservicio($datos['id']));
        $consulta = $querys->eliminarservicio($datos['id']);
        if($conexion->consulta($consulta) == 0){
            $data = array(
                'error' => true,
                'titulo' => 'Error',
                'mensaje' => 'Fallo al eliminar el proyecto, inténtelo de nuevo más tarde. ¡Gracias!',
                'tipo' => 'warning',
                'funcion' => null,
            );
            echo json_encode($data);
            exit(0);
        }
        $msj= "El blog {$info['titulo']} con id: {$info['id_servicio']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_servicio')
        );
        echo json_encode($data);
        exit(0);
        break;
    ////////////////////////////// FIN ELIMINAR SERVICIO
    /////////////////////////////// INICIO ELIMINAR CATEGORIA SERVICIO
    case 29: // ELIMINAR CATEGORIA SERVICIO
        $info = $conexion->fetch_array($querys->getcategoriaservicio($datos['id']));
        $consulta = $querys->eliminarcategoriaservicio($datos['id']);
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
        $msj= "Se eliminio la categoria servicio {$info['nombre']} con id: {$info['id_categoria_servicio']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_categoriaservicio')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR CATEGORIA SERVICIO
    /////////////////////////////// INICIO ELIMINAR PREGUNTA FRECUENTE
    case 30: // ELIMINAR PREGUNTA FRECUENTE
        $info = $conexion->fetch_array($querys->getpreguntafrecuente($datos['id']));
        $consulta = $querys->eliminarpreguntafrecuente($datos['id']);
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
        $msj= "Se eliminio la pregunta {$info['pregunta']} con id: {$info['id_pregunta_frecuente']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_preguntafrecuente')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR PREGUNTA FRECUENTE
    case 31: // ELIMINAR TESTIMONIO
        $info = $conexion->fetch_array($querys->gettestimonio($datos['id']));
        $consulta = $querys->eliminartestimonio($datos['id']);
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
        $msj= "Se eliminio el testimonio {$info['nombre']} con id: {$info['id_testimonio']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_testimonio')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR TESTIMONIO
    /////////////////////////////// INICIO ELIMINAR COMENTARIO BLOG
    case 32: // ELIMINAR COMENTARIO BLOG
        $info = $conexion->fetch_array($querys->getcomentario($datos['id']));
        $consulta = $querys->eliminarcomentario($datos['id']);
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
        $msj= "Se eliminio el comentario {$info['nombre']} con id: {$info['id_comentario']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_comentario')
        );
        echo json_encode($data);
        exit(0);
        break;
    /////////////////////////////// FIN ELIMINAR COMENTARIO BLOG
    case 33: // ELIMINAR TESTIMONIO
        $info = $conexion->fetch_array($querys->getSlider($datos['id']));
        $consulta = $querys->eliminarSlider($datos['id']);
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
        $msj= "Se eliminio el slider {$info['nombre']} con id: {$info['id_slider']}, fue eliminado por el usuario $nombre_usuario";
        $data = array(
            'error' => false,
            'titulo' => 'Completado',
            'mensaje' => $msj,
            'tipo' => 'success',
            'funcion' => array('lista_slider')
        );
        echo json_encode($data);
        exit(0);
    break;
    /////////////////////////////// FIN ELIMINAR TESTIMONIO
}

$log = $querys->addSesionDetalle($datos_sis['id_usuario'], $msj, $consulta, $funciones->getRealIP(), $funciones->getBrowser(), $funciones->getOs(), date('Y-m-d H:i:s'));
$conexion->consulta($log);

echo $msj;
?>