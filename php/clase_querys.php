<?php
require_once 'querys/blog.php';

class Querys {
	use Blog;

	//---------------------------INICIO SLIDERS-----------------------------  
	function getSliders(){
		$strQuery = "SELECT * FROM tbl_slider WHERE fecha_eliminado IS NULL AND estatus = 1 ORDER BY orden ASC";
		return $strQuery;
	}

	
	function geConteotSliders(){
		$strQuery = 'SELECT count(*) FROM tbl_slider WHERE fecha_eliminado IS NULL AND estatus = 1';
		return $strQuery;
	}
	//---------------------------FIN SLIDERS-------------------------------

	//---------------------------INICIO DATOS DE LA EMPRESA-----------------------------  
	function getDatosEmpresa(){
		$strQuery = "SELECT * FROM tblc_configuracion WHERE id_configuracion = 1";
		return $strQuery;
	}
	//---------------------------FIN DATOS DE LA EMPRESA-------------------------------

	//---------------------------INICIO CATEGORIAS DE SERVICIOS-----------------------------  
	function getCategoriaServicio(){
		$strQuery = "SELECT * FROM tblc_categoria_servicio WHERE fecha_eliminado IS NULL AND estatus = 1 ORDER BY fecha_registro DESC LIMIT 5";
		return $strQuery;
	}

	function getCategoriaServicio2(){
		$strQuery = "SELECT * FROM tblc_categoria_servicio WHERE fecha_eliminado IS NULL AND estatus = 1 ORDER BY RAND() LIMIT 5";
		return $strQuery;
	}

	function geConteotCategoriaServicio(){
		$strQuery = 'SELECT count(*) FROM tblc_categoria_servicio WHERE fecha_eliminado IS NULL AND estatus = 1';
		return $strQuery;
	}
	//---------------------------FIN CATEGORIAS DE SERVICIOS-------------------------------

	//---------------------------INICIO SERVICIOS-----------------------------  
	function getConteoServicio($id){
		$strQuery = "SELECT count(*) FROM tbl_servicio WHERE fecha_eliminado IS NULL AND estatus = 1 AND id_categoria_servicio =".$id;
		return $strQuery;
	}

	//---------------------------FIN SERVICIOS-------------------------------

	//---------------------------INICIO BLOG-----------------------------  
	function getBlog(){
		$strQuery = "SELECT * FROM tbl_blog WHERE fecha_eliminado IS NULL AND estatus = 1 ORDER BY RAND() LIMIT 3";
		return $strQuery;
	}

	function geConteotBlog(){
		$strQuery = 'SELECT count(*) FROM tbl_blog WHERE fecha_eliminado IS NULL AND estatus = 1';
		return $strQuery;
	}
	//---------------------------FIN BLOG-------------------------------
}
?>
