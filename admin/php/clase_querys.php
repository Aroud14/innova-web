<?php

class Querys {
	//***************************************************************************************
	//********************* guardar datos en log ******************************
	function addSesionDetalle($id_usuario, $msj, $script, $ip, $navegador, $so){
		$strQuery = 'INSERT INTO tbl_log_usuario (id_usuario , descripcion, script, ip, navegador, so, fecha_accion) 
					VALUES("'.$id_usuario.'", "'.$msj.'", "'.$script.'", "'.$ip.'", "'.$navegador.'", "'.$so.'", NOW())';
		return $strQuery;
	}

	function getConfiguracion(){
		$stConsulta = "SELECT * ";
		$stConsulta.= "FROM tblc_configuracion ";
		$stConsulta.= "WHERE id_configuracion = '1'";

		return $stConsulta;
	}

	//***************************************************************************************
	//*********************INICIA QUERYS PARA INICIO DE SESIÓN ******************************
	//VALIDANDO SI EL USUARIO EXISTE
	
	function existeUsuario($usuario){
		$stConsulta = "SELECT * ";
		$stConsulta.= "FROM tbl_usuario ";
		$stConsulta.= "WHERE usuario LIKE '".$usuario."'";
		return $stConsulta;
	}
	
	function obtenerPermisoModulo($idUsuario, $modulo){
		$strQuery = "SELECT COUNT(up.id_permiso) AS PERMISO ";
		$strQuery.= "FROM tbl_usuario_permiso up ";
		$strQuery.= "JOIN tblc_permiso p ";
		$strQuery.= "ON(up.id_permiso = p.id_permiso) ";
		$strQuery.= "WHERE up.id_usuario = ".$idUsuario." AND p.archivo LIKE '".$modulo."'";

		return $strQuery;
	}
	//FIN VALIDANDO SI EL USUARIO EXISTE

	//BITACORA LOG USUARIO
	function datosUsuario($id){
		$stConsulta = "SELECT * FROM tbl_usuario WHERE id_usuario=".$id;
		return $stConsulta;
	}

	function logUsuario($id, $query, $inicio, $limite){
		$stConsulta = "SELECT * ";
		$stConsulta.= "FROM tbl_log_usuario";
		$stConsulta.= "WHERE id_usuario=".$id;
		$stConsulta.= "ORDER BY fecha_accion DESC LIMIT ".$inicio.",".$limite;
		return $stConsulta;
	}
	//BITACORA LOG USUARIO
	
	//---------------------------TABLA SESION SISTEMA-----------------------------
	function combo_anios_bitacora($id){
		$strQuery = "SELECT YEAR(fecha_accion) as id, YEAR(fecha_accion) as valor FROM tbl_log_usuario";
		$strQuery.= " WHERE id_usuario = ".$id;
		$strQuery.= " ORDER BY YEAR(fecha_accion) DESC";

		return $strQuery;
	}
	function ultimafecha_bitacora($id){
		$strQuery = "SELECT MAX(fecha_accion) FROM tbl_log_usuario";
		$strQuery.= " WHERE id_usuario = ".$id;
		$strQuery.= " ORDER BY fecha_accion DESC";

		return $strQuery;
	}
	//Obtener el listado
	function getlistbitacora($id, $anio, $mes, $inicio, $limite){
		$sentencia = ($anio != '') ? " AND fecha_accion = YEAR(".$anio.")" : '';
		$sentencia .= ($mes != '') ? " AND fecha_accion = MONTH(".$mes.")" : '';

		$strQuery = 'SELECT * FROM tbl_log_usuario AS s';
		$strQuery .= ' WHERE id_usuario = '.$id.$sentencia;
		$strQuery .= ' ORDER BY fecha_accion DESC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}
	//Obtener el conteo
	function getconteobitacora($id, $anio, $mes){
		$sentencia = ($anio != '') ? " AND fecha_accion = YEAR(".$anio.")" : '';
		$sentencia .= ($mes != '') ? " AND fecha_accion = MONTH(".$mes.")" : '';

		$strQuery = 'SELECT COUNT(id_log) FROM tbl_log_usuario WHERE id_usuario = '.$id.$sentencia;

		return $strQuery;	
	}

	//---------------------------TABLA SESION SISTEMA-----------------------------

	//---------------------------TABLA PERMISO------------------------------------
	function getlispermisousuario($id_usuario){
		$strQuery = "SELECT DISTINCT up.id_permiso as id, p.* FROM tblc_permiso AS p
					 INNER JOIN tbl_usuario_permiso AS up ON p.id_permiso = up.id_permiso
					  WHERE up.id_usuario =".$id_usuario." AND p.estatus = '1' ORDER BY p.ordenamiento";

		return $strQuery;
	}

	function permisosmenuusuario($id_usuario){
		$strQuery = "SELECT DISTINCT up.id_permiso as id, p.* FROM tblc_permiso AS p
		INNER JOIN tbl_usuario_permiso AS up ON p.id_permiso = up.id_permiso
		WHERE up.id_usuario =".$id_usuario." AND p.id_padre = '0' AND p.estatus = '1' ORDER BY p.ordenamiento";

		return $strQuery;
	}

	function permisosubmenuusuario($id_usuario, $idpadre){
		$strQuery = "SELECT DISTINCT up.id_permiso as id, p.* FROM tblc_permiso AS p";
		$strQuery .= " INNER JOIN tbl_usuario_permiso AS up ON p.id_permiso = up.id_permiso";
		$strQuery .= " WHERE up.id_usuario =".$id_usuario." AND p.id_padre = ".$idpadre." AND p.estatus = '1' ORDER BY p.ordenamiento";

		return $strQuery;
	}

	function Conteopermisosubmenuusuariomodulo($id_usuario, $idpadre, $modulo){
		$strQuery = "SELECT COUNT(up.id_permiso) FROM tblc_permiso AS p";
		$strQuery .= " INNER JOIN tbl_usuario_permiso AS up ON p.id_permiso = up.id_permiso";
		$strQuery .= " WHERE up.id_usuario =".$id_usuario." AND p.id_padre = ".$idpadre." AND p.archivo LIKE '".$modulo."'";

		return $strQuery;
	}

	function getpermiso($id){
		$strQuery = 'SELECT * FROM tblc_permiso';
		$strQuery.= ' WHERE id_permiso = ' .$id;

		return $strQuery;
	}

	//Obtener el listado
	function getlistpermiso($nombre, $archivo, $padre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia .= ($archivo != '') ? " AND archivo LIKE '%".$archivo."%'" : '';

		$strQuery = 'SELECT * FROM tblc_permiso';
		$strQuery .= ' WHERE id_padre = ' .$padre .$sentencia;
		$strQuery.= ' ORDER BY ordenamiento ASC LIMIT ';
		$strQuery.= $inicio. "," .$limite;

		return $strQuery;
	}

	//Obtener el conteo
	function getconteopermiso($nombre, $archivo, $padre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia .= ($archivo != '') ? " AND archivo LIKE '%".$archivo."%'" : '';
		
		$strQuery = 'SELECT COUNT(id_permiso) FROM tblc_permiso';
		$strQuery .= ' WHERE id_padre = 0'.$padre.$sentencia;

		return $strQuery;
	}

	function getpermisopadre(){
		$strQuery = 'SELECT * FROM tblc_permiso';
		$strQuery.= ' WHERE id_padre=0';
		$strQuery.= ' ORDER BY ordenamiento ASC';

		return $strQuery;
	}

	function getpermisohijo($id){
		$strQuery = 'SELECT * FROM tblc_permiso';
		$strQuery.= ' WHERE id_padre='.$id;
		$strQuery.= ' ORDER BY ordenamiento ASC';

		return $strQuery;
	}

	function getcombopermiso(){
		$strQuery = 'SELECT id_permiso AS id, nombre AS valor, icono AS nombre_icono';
		$strQuery.= ' FROM tblc_permiso';
		$strQuery.= ' WHERE id_padre = 0 AND tipo = 1';
		$strQuery.= ' ORDER BY ordenamiento ASC';

		return $strQuery;
	}

	function eliminarpermiso($id){
		$strQuery = 'DELETE FROM tblc_permiso';
		$strQuery.= ' WHERE id_permiso = '.$id;
		return $strQuery;
	}

	//---------------------------TABLA PERMISO------------------------------------
	function eliminarPermisosForaneos(int $id)
	{
		$strQuery = "DELETE FROM tbl_usuario_permiso WHERE id_permiso = $id";
		return $strQuery;
	}
	//---------------------------TABLA USUARIO------------------------------------  

	//Obtener un registros
	function getUsuario($id){
		$strQuery = 'SELECT tu.*FROM tbl_usuario as tu WHERE tu.id_usuario = '.$id;
		return $strQuery;
	}

	function getHorarioUsuario($id){
		$strQuery = 'SELECT * FROM tbl_usuario_horario WHERE id_usuario_horario = ' .$id;
		return $strQuery;
	}

	function verificarHorarioTrabajo($id){
		$strQuery = 'SELECT COUNT(id_usuario_horario) FROM tbl_usuario_horario';
		$strQuery.= ' WHERE fecha_eliminado IS NULL AND id_usuario = "'.$id.'" AND dia = "'.date('w').'" AND hora_inicio <= "'.date('H:i:s').'" AND hora_termino >= "'.date('H:i:s').'"';
		return $strQuery;
	}

	function getListaHorarioUsuarioLogin($id){
		$strQuery = "SELECT * FROM tbl_usuario_horario WHERE fecha_eliminado IS NULL AND id_usuario = " .$id;
		return $strQuery;
	}

	function getListaHorarioUsuario($id, $dia, $horaInicio, $horaTermino, $inicio, $limite){
		$sentencia = ($dia != "") ? " AND dia = '".$dia."'" : '';
		$sentencia.= ($horaInicio != "") ? " AND hora_inicio = '".$horaInicio."'" : '';
		$sentencia.= ($horaTermino != "") ? " AND hora_termino = '".$horaTermino."'" : '';
		$strQuery = "SELECT * FROM tbl_usuario_horario WHERE fecha_eliminado IS NULL AND id_usuario = " .$id . $sentencia . " ORDER BY id_usuario_horario LIMIT " .$inicio. ',' .$limite;
		return $strQuery;
	}

	function getConteoListaHorarioUsuario($id, $dia, $horaInicio, $horaTermino){
		$sentencia = ($dia != "") ? " AND dia = '".$dia."'" : '';
		$sentencia.= ($horaInicio != "") ? " AND hora_inicio = '".$horaInicio."'" : '';
		$sentencia.= ($horaTermino != "") ? " AND hora_termino = '".$horaTermino."'" : '';
		$strQuery = "SELECT COUNT(id_usuario_horario) FROM tbl_usuario_horario WHERE fecha_eliminado IS NULL AND id_usuario = " .$id . $sentencia;
		return $strQuery;
	}

	//Obtener el listado
	function getlistusuarios($nombre, $usuario, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia .= ($usuario != '') ? " AND usuario LIKE '%".$usuario."%'" : '';
		$strQuery = 'SELECT * FROM tbl_usuario WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre LIMIT ';
		$strQuery .= $inicio.",".$limite;
		return $strQuery;
	}

	//Obtener el conteo
	function getconteousuarios($nombre, $usuario){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia .= ($usuario != '') ? " AND usuario LIKE '%".$usuario."%'" : '';
		$strQuery = 'SELECT COUNT(id_usuario) FROM tbl_usuario 
					WHERE fecha_eliminado IS NULL'.$sentencia;
		return $strQuery;
	}

	//Obtener el combo
	function getcombousuarios(){
		$strQuery = 'SELECT id_usuario AS id, CONCAT(nombre, " ", apellidos) as valor 
					 FROM tbl_usuario
					 WHERE fecha_eliminado IS NULL ORDER BY nombre';
		return $strQuery;
	}

	//Eliminar un registros	
	function eliminarusuarios($id){
		$strQuery = "UPDATE tbl_usuario SET fecha_eliminado = NOW()";
		$strQuery.= " WHERE id_usuario = ".$id;
		return $strQuery;
	}

	function eliminarHorarioUsuario($id){
		$strQuery = "UPDATE tbl_usuario_horario SET fecha_eliminado = NOW()";
		$strQuery.= " WHERE id_usuario_horario = ".$id;
		return $strQuery;
	}

	function getNombreUsuario($id){
		$strQuery = "SELECT nombre FROM tbl_usuario WHERE id_usuario = " .$id;
		return $strQuery;
	}

	//------------------------- FIN USUARIO ---------------------------
	
	//---------------------------TABLA PERMISOS-----------------------------  

	//Obtener un registros
	function getpermisostotal(){
		$strQuery = 'SELECT * FROM tblc_permiso';
		return $strQuery;
	}

	function getpermisospadre($id_padre){
		$strQuery = 'SELECT * FROM tblc_permiso WHERE id_padre = '.$id_padre.' AND fecha_eliminado IS NULL AND estatus = 1';
		return $strQuery;
	}

	function getpermisoshijo($id_hijo){
		$strQuery = 'SELECT count(*) FROM tblc_permiso WHERE id_padre ='.$id_hijo.' AND fecha_eliminado IS NULL AND estatus = 1';
		return $strQuery;
	}

	function getpermisos_usuarios($id, $id_permiso){
		$strQuery = 'SELECT * FROM tbl_usuario_permiso WHERE id_usuario ='.$id.' AND id_permiso ='.$id_permiso;
		return $strQuery;
	}

	//------------------------- FIN PERMISOS ---------------------------
	
	//---------------------------TABLA log-----------------------------  
	function getLog($id){
		$strQuery = "SELECT * FROM tbl_log_usuario WHERE id_usuario = " .$id;
		return $strQuery;
	}

	function getListaLog($id, $fechainv, $ip, $navegador, $so, $inicio, $limite){
		$sentencia = ($fechainv != "") ? " AND fecha_accion LIKE '%".$fechainv."%'" : '';
		$sentencia.= ($ip != "") ? " AND ip = '".$ip."'" : '';
		$sentencia.= ($navegador != "") ? " AND navegador LIKE '%".$navegador."%'" : '';
		$sentencia.= ($so != "") ? " AND so LIKE '%".$so."%'" : '';
		$strQuery = "SELECT * FROM tbl_log_usuario WHERE id_usuario = " .$id . $sentencia . " ORDER BY id_log_usuario LIMIT " .$inicio. ',' .$limite;
		return $strQuery;
	}

	function getConteoListaLog($id, $fechainv, $ip, $navegador, $so){
		$sentencia = ($fechainv != "") ? " AND fecha_accion LIKE '%".$fechainv."%'" : '';
		$sentencia.= ($ip != "") ? " AND ip = '".$ip."'" : '';
		$sentencia.= ($navegador != "") ? " AND navegador LIKE '%".$navegador."%'" : '';
		$sentencia.= ($so != "") ? " AND so LIKE '%".$so."%'" : '';
		$strQuery = "SELECT COUNT(id_log_usuario) FROM tbl_log_usuario WHERE id_usuario = " .$id . $sentencia;
		return $strQuery;
	}

	//------------------------- FIN log ---------------------------



	//---------------------------INICIO ESTADO-----------------------------  
	function getEstado($id){
		$strQuery = "SELECT * FROM tblc_estado WHERE id_estado = " .$id;
		return $strQuery;
	}

	function getNombreEstado($id){
		$strQuery = "SELECT nombre FROM tblc_estado WHERE id_estado = " .$id;
		return $strQuery;
	}

	function getListaEstado($nombre, $claveInegi, $inicio, $limite){
		$sentencia = ($nombre != "") ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia.= ($claveInegi != "") ? " AND clave_inegi LIKE '%".$claveInegi."%'" : '';
		$strQuery = "SELECT * FROM tblc_estado WHERE fecha_eliminado IS NULL " . $sentencia . " ORDER BY nombre LIMIT " .$inicio. ',' .$limite;
		return $strQuery;
	}

	function getConteoListaEstado($nombre, $claveInegi){
		$sentencia = ($nombre != "") ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia.= ($claveInegi != "") ? " AND clave_inegi LIKE '%".$claveInegi."%'" : '';
		$strQuery = "SELECT COUNT(id_estado) FROM tblc_estado WHERE fecha_eliminado IS NULL " . $sentencia;
		return $strQuery;
	}

	function getComboEstados(){
		$strQuery = "SELECT id_estado AS id, nombre AS valor FROM tblc_estado WHERE fecha_eliminado IS NULL ORDER BY nombre";
		return $strQuery;
	}

	// ELIMINAR ESTADO
	function eliminarEstado($id){
		$strQuery = "UPDATE tblc_estado SET fecha_eliminado = NOW() WHERE id_estado = " .$id;
		return $strQuery;
	}
	//---------------------------FIN ESTADO-------------------------------



	//---------------------------INICIO MUNICIPIO-----------------------------  
	function getMunicipio($id){
		$strQuery = "SELECT * FROM tblc_municipio WHERE id_municipio = " .$id;
		return $strQuery;
	}

	function getNombreMunicipio($id){
		$strQuery = "SELECT nombre FROM tblc_municipio WHERE id_municipio = " .$id;
		return $strQuery;
	}

	function getComboMunicipios($id){
		$strQuery = "SELECT id_municipio AS id, nombre as valor FROM tblc_municipio WHERE fecha_eliminado IS NULL AND id_estado = " . $id . " ORDER BY nombre";
		return $strQuery;
	}

	function getNombreEstadoPorMunicipio($id){
		$strQuery = "SELECT e.nombre FROM tblc_estado AS e
		INNER JOIN tblc_municipio AS m ON m.id_estado = e.id_estado
		WHERE m.id_municipio = " .$id;
		return $strQuery;
	}

	function getListaMunicipio($nombre, $estado, $claveInegi, $inicio, $limite){
		$sentencia = ($nombre != "") ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia.= ($estado != "") ? " AND id_estado = '".$estado."'" : '';
		$sentencia.= ($claveInegi != "") ? " AND clave_inegi LIKE '%".$claveInegi."%'" : '';
		$strQuery = "SELECT * FROM tblc_municipio WHERE fecha_eliminado IS NULL " . $sentencia . " ORDER BY nombre LIMIT " .$inicio. ',' .$limite;
		return $strQuery;
	}

	function getConteoListaMunicipio($nombre, $estado, $claveInegi){
		$sentencia = ($nombre != "") ? " AND nombre LIKE '%".$nombre."%'" : '';
		$sentencia.= ($estado != "") ? " AND id_estado = '".$estado."' " : '';
		$sentencia.= ($claveInegi != "") ? " AND clave_inegi LIKE '%".$claveInegi."%'" : '';
		$strQuery = "SELECT COUNT(id_municipio) FROM tblc_municipio WHERE fecha_eliminado IS NULL " . $sentencia;
		return $strQuery;
	}

	// ELIMINAR ESTADO
	function eliminarMunicipio($id){
		$strQuery = "UPDATE tblc_municipio SET fecha_eliminado = NOW() WHERE id_municipio = " .$id;
		return $strQuery;
	}
	//---------------------------FIN MUNICIPIO-------------------------------

}
?>
