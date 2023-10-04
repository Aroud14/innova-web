<?php

class Querys {
	//---------------------------INICIO SLIDERS-----------------------------  
	function getSliders(){
		$strQuery = "SELECT * FROM tbl_slider WHERE fecha_eliminado IS NULL AND estatus = 1 ORDER BY orden ASC";
		return $strQuery;
	}
	//---------------------------FIN SLIDERS-------------------------------
}
?>
