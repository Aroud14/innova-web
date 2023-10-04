<?php
class Variables {
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
	var $Puerto;
	public function opcion($opc){
		switch($opc){
			case 1:
				$this->BaseDatos = "web_eyd";
				$this->Servidor = "localhost";
				$this->Usuario = "web_eyd";
				$this->Clave = "T4mjl9!89";

			break;
			default:
				echo "La opcion de la base de datos seleccionada no existe";
				exit(0);
			break;
			} 
	}
}
?>