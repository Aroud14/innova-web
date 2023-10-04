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


	//---------------------------TABLA BLOG-------------------------------
	public function getBlog(int $id)
	{
		$strQuery = "SELECT * FROM tbl_blog WHERE id_blog = {$id}";
		return $strQuery;
	}

	public function getBlogList($titulo, $fecha, $inicio, $limite){
		$sentencia = ($titulo != '') ? " AND titulo LIKE '%".$titulo."%'" : '';
		$sentencia .= ($fecha != '') ? " AND fecha LIKE '%".$fecha."%'" : '';


		$strQuery = 'SELECT * FROM tbl_blog';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY titulo ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getBlogCount($nombre, $fecha){
		$sentencia = ($nombre != '') ? " AND t.titulo LIKE '%".$nombre."%'" : '';
		$sentencia .= ($fecha != '') ? " AND t.fecha LIKE '%".$fecha."%'" : '';

		$strQuery = "SELECT COUNT(t.id_blog) FROM tbl_blog as t";
		$strQuery .= ' WHERE t.fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarBlog($id){
		$strQuery = 'UPDATE tbl_blog SET fecha_eliminado = NOW() WHERE id_blog = '.$id;
		return $strQuery;
	}

	public function getComboBlog(){

		$strQuery = 'SELECT id_blog as id, titulo as valor FROM tbl_blog
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}
	//---------------------------TABLA FIN BLOG---------------------------

	//---------------------------TABLA CATEGORIA BLOG---------------------
	public function getcategoriablog(int $id)
	{
		$strQuery = "SELECT * FROM tblc_categoria_blog WHERE id_categoria_blog = {$id}";
		return $strQuery;
	}

	public function getlistcategoriablog($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_categoria_blog';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteocategoriablog($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT COUNT(id_categoria_blog) FROM tblc_categoria_blog
					 WHERE fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarcategoriablog($id){
		$strQuery = 'UPDATE tblc_categoria_blog SET fecha_eliminado = NOW() WHERE id_categoria_blog = '.$id;
		return $strQuery;
	}
	public function getcombocategoriablog(){
		$strQuery = 'SELECT id_categoria_blog as id, nombre as valor FROM tblc_categoria_blog
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}

	//------------------------ TABLA ETIQUETA BLOG --------

	public function getetiquetablog(int $id)
	{
		$strQuery = "SELECT * FROM tblc_etiqueta_blog WHERE id_etiqueta_blog = {$id}";
		return $strQuery;
	}

	public function getlistetiquetablog($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_etiqueta_blog';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteoetiquetablog($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT COUNT(id_etiqueta_blog) FROM tblc_etiqueta_blog
					 WHERE fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminaretiquetablog($id){
		$strQuery = 'UPDATE tblc_etiqueta_blog SET fecha_eliminado = NOW() WHERE id_etiqueta_blog = '.$id;
		return $strQuery;
	}
	public function getcomboetiquetablog(){
		$strQuery = 'SELECT id_etiqueta_blog as id, nombre as valor FROM tblc_etiqueta_blog
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}

	//---------------- TABLA CATEGORIA SERVICIO

	public function getcategoriaservicio(int $id){
		return "SELECT * FROM tblc_categoria_servicio WHERE id_categoria_servicio ={$id}";
	}

	public function getlistcategoriaservicio($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_categoria_servicio';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteocategoriaservicio($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		return 'SELECT COUNT(id_categoria_servicio) FROM tblc_categoria_servicio
					 WHERE fecha_eliminado IS NULL'.$sentencia;
	}

	public function eliminarcategoriaservicio($id){
		return 'UPDATE tblc_categoria_servicio SET fecha_eliminado = NOW() WHERE id_categoria_servicio = '.$id;
	}
	public function getcombocategoriaservicio(){
		return 'SELECT id_categoria_servicio as id, nombre as valor FROM tblc_categoria_servicio
					WHERE fecha_eliminado IS NULL';
	}

	//---------------- TABLA PREGUNTA FRECUENTE

	public function getpreguntafrecuente(int $id){
		return "SELECT * FROM tblc_pregunta_frecuente WHERE id_pregunta_frecuente ={$id}";
	}

	public function getlistpreguntafrecuente($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_pregunta_frecuente';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}


	public function getconteopreguntafrecuente($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		return 'SELECT COUNT(id_pregunta_frecuente) FROM tblc_pregunta_frecuente
					 WHERE fecha_eliminado IS NULL'.$sentencia;
	}

	public function eliminarpreguntafrecuente($id){
		return 'UPDATE tblc_pregunta_frecuente SET fecha_eliminado = NOW() WHERE id_pregunta_frecuente = '.$id;
	}
	public function getcombopreguntafrecuente(){
		return 'SELECT id_pregunta_frecuente as id, pregunta as valor FROM tblc_pregunta_frecuente
					WHERE fecha_eliminado IS NULL';
	}

	//---------------- TABLA SUBTEMA

	public function getsubtema(int $id){
		return "SELECT * FROM tblc_subtema WHERE id_subtema ={$id}";
	}

	public function getlistsubtema($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_subtema';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;

	}

		public function getconteosubtema($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		return 'SELECT COUNT(id_subtema) FROM tblc_subtema
					 WHERE fecha_eliminado IS NULL'.$sentencia;
	}

	public function eliminarsubtema($id){
		return 'UPDATE tblc_subtema SET fecha_eliminado = NOW() WHERE id_subtema = '.$id;
	}
	public function getcombosubtema(){
		return 'SELECT id_subtema as id, titulo as valor FROM tblc_subtema
					WHERE fecha_eliminado IS NULL';}


	//---------------- TABLA PROYECTO

	public function getproyecto(int $id){
		return "SELECT * FROM tbl_proyecto WHERE id_proyecto={$id}";
	}

	public function getlistproyecto($titulo, $fecha, $inicio, $limite){
		$sentencia = ($titulo != '') ? " AND titulo LIKE '%".$titulo."%'" : '';
		$sentencia .= ($fecha != '') ? " AND fecha LIKE '%".$fecha."%'" : '';


		$strQuery = 'SELECT * FROM tbl_proyecto';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY titulo ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteoproyecto($nombre, $fecha){
		$sentencia = ($nombre != '') ? " AND t.titulo LIKE '%".$nombre."%'" : '';
		$sentencia .= ($fecha != '') ? " AND t.fecha LIKE '%".$fecha."%'" : '';

		$strQuery = "SELECT COUNT(t.id_proyecto) FROM tbl_proyecto as t";
		$strQuery .= ' WHERE t.fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarproyecto($id){
		return 'UPDATE tbl_proyecto SET fecha_eliminado = NOW() WHERE id_proyecto = '.$id;
	}
	public function getcomboproyecto(){
		return 'SELECT id_proyecto as id, titulo as valor FROM tbl_proyecto
					WHERE fecha_eliminado IS NULL';}

	//---------------- TABLA CATEGORIA PROYECTO


	public function getcategoriaproyecto(int $id){
		return "SELECT * FROM tblc_categoria_proyecto WHERE id_categoria_proyecto ={$id}";
	}

	public function getlistcategoriaproyecto($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_categoria_proyecto';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteocategoriaproyecto($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		return 'SELECT COUNT(id_categoria_proyecto) FROM tblc_categoria_proyecto
					 WHERE fecha_eliminado IS NULL'.$sentencia;
	}

	public function eliminarcategoriaproyecto($id){
		return 'UPDATE tblc_categoria_proyecto SET fecha_eliminado = NOW() WHERE id_categoria_proyecto = '.$id;
	}
	public function getcombocategoriaproyecto(){
		return 'SELECT id_categoria_proyecto as id, nombre as valor FROM tblc_categoria_proyecto
					WHERE fecha_eliminado IS NULL';
	}

	//---------------- TABLA SERVICIO

	public function getservicio(int $id){
		return "SELECT * FROM tbl_servicio WHERE id_servicio={$id}";
	}

	public function getlistservicio($titulo, $fecha, $inicio, $limite){
		$sentencia = ($titulo != '') ? " AND titulo LIKE '%".$titulo."%'" : '';
		$sentencia .= ($fecha != '') ? " AND fecha LIKE '%".$fecha."%'" : '';


		$strQuery = 'SELECT * FROM tbl_servicio';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY titulo ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteoservicio($nombre, $fecha){
		$sentencia = ($nombre != '') ? " AND t.titulo LIKE '%".$nombre."%'" : '';
		$sentencia .= ($fecha != '') ? " AND t.fecha LIKE '%".$fecha."%'" : '';

		$strQuery = "SELECT COUNT(t.id_servicio) FROM tbl_servicio as t";
		$strQuery .= ' WHERE t.fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarservicio($id){
		return 'UPDATE tbl_servicio SET fecha_eliminado = NOW() WHERE id_servicio = '.$id;
	}
	public function getcomboservicio(){
		return 'SELECT id_servicio as id, titulo as valor FROM tbl_servicio
					WHERE fecha_eliminado IS NULL';}


	//	TESTIMONIOS

	public function gettestimonio(int $id)
	{
		$strQuery = "SELECT * FROM tbl_testimonio WHERE id_testimonio = {$id}";
		return $strQuery;
	}

	public function getlisttestimonio($titulo, $fecha, $inicio, $limite){
		$sentencia = ($titulo != '') ? " AND titulo LIKE '%".$titulo."%'" : '';
		$sentencia .= ($fecha != '') ? " AND fecha LIKE '%".$fecha."%'" : '';


		$strQuery = 'SELECT * FROM tbl_testimonio';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY titulo ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteotestimonio($nombre, $fecha){
		$sentencia = ($nombre != '') ? " AND t.titulo LIKE '%".$nombre."%'" : '';
		$sentencia .= ($fecha != '') ? " AND t.fecha LIKE '%".$fecha."%'" : '';

		$strQuery = "SELECT COUNT(t.id_testimonio) FROM tbl_testimonio as t";
		$strQuery .= ' WHERE t.fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminartestimonio($id){
		$strQuery = 'UPDATE tbl_testimonio SET fecha_eliminado = NOW() WHERE id_testimonio = '.$id;
		return $strQuery;
	}

	public function getcombotestimonio(){

		$strQuery = 'SELECT id_testimonio as id, titulo as valor FROM tbl_testimonio
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}


	//---------------------------TABLA COMENTARIO BLOG---------------------
	public function getcomentario(int $id)
	{
		$strQuery = "SELECT * FROM tblc_comentario WHERE id_comentario = {$id}";
		return $strQuery;
	}

	public function getlistcomentario($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tblc_comentario';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteocomentario($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT COUNT(id_comentario) FROM tblc_comentario
					 WHERE fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarcomentario($id){
		$strQuery = 'UPDATE tblc_comentario SET fecha_eliminado = NOW() WHERE id_comentario = '.$id;
		return $strQuery;
	}
	public function getcombocomentario(){
		$strQuery = 'SELECT id_comentario as id, nombre as valor FROM tblc_comentario
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}

	public function getcountcomentariode(int $id){
		return "SELECT COUNT(id_comentario) FROM tblc_comentario WHERE fecha_eliminado IS NULL AND id_blog={$id}";
	}

	//---------------------------TABLA SLIDER-------------------------------
	public function getSlider(int $id)
	{
		$strQuery = "SELECT * FROM tbl_slider WHERE id_slider = {$id}";
		return $strQuery;
	}

	public function getSliderList($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tbl_slider';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY orden ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getSliderCount($nombre){
		$sentencia = ($nombre != '') ? " AND t.nombre LIKE '%".$nombre."%'" : '';

		$strQuery = "SELECT COUNT(t.id_slider) FROM tbl_slider as t";
		$strQuery .= ' WHERE t.fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarSlider($id){
		$strQuery = 'UPDATE tbl_slider SET fecha_eliminado = NOW() WHERE id_slider = '.$id;
		return $strQuery;
	}

	public function getComboSlider(){

		$strQuery = 'SELECT id_slider as id, titulo as valor FROM tbl_slider
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}
	//---------------------------TABLA FIN BLOG---------------------------

	//---------------------------TABLA CLIENTE-----------------------------
	//Obtener un registro
	public function getcliente(int $id)
	{
		$strQuery = "SELECT * FROM tbl_cliente WHERE id_cliente = {$id}";
		return $strQuery;	
	}

	public function getlistcliente($nombre, $inicio, $limite){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT * FROM tbl_cliente';
		$strQuery .= ' WHERE fecha_eliminado IS NULL'.$sentencia;
		$strQuery .= ' ORDER BY nombre ASC LIMIT ';
		$strQuery .= $inicio.",".$limite;

		return $strQuery;
	}

	public function getconteocliente($nombre){
		$sentencia = ($nombre != '') ? " AND nombre LIKE '%".$nombre."%'" : '';

		$strQuery = 'SELECT COUNT(id_cliente) FROM tbl_cliente
					 WHERE fecha_eliminado IS NULL'.$sentencia;

		return $strQuery;
	}

	public function eliminarcliente($id){
		$strQuery = 'UPDATE tbl_cliente SET fecha_eliminado = NOW() WHERE id_cliente = '.$id;
		return $strQuery;
	}
	public function getcombocliente(){
		$strQuery = 'SELECT id_cliente as id, nombre as valor FROM tbl_cliente
					WHERE fecha_eliminado IS NULL';
		return $strQuery;
	}
	//---------------------------TABLA FIN CLIENTE-----------------------------


}

?>
