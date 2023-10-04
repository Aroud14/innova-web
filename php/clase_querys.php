<?php

class Querys {
	//---------------------------INICIO SLIDERS-----------------------------  
	function getSliders(){
		$strQuery = "SELECT * FROM tbl_slider WHERE fecha_eliminado IS NULL AND estatus = 1 ORDER BY orden ASC";
		return $strQuery;
	}
	//---------------------------FIN SLIDERS-------------------------------

	//---------------------------INICIO DATOS DE LA EMPRESA-----------------------------  
	function getDatosEmpresa(){
		$strQuery = "SELECT * FROM tblc_configuracion WHERE id_configuracion = 1";
		return $strQuery;
	}
	//---------------------------FIN DATOS DE LA EMPRESA-------------------------------
}
?>
