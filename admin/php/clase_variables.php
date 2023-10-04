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
				$this->BaseDatos = "innova_web";
				$this->Servidor = "localhost";
				$this->Usuario = "root";
				$this->Clave = "";

			break;
			default:
				echo "La opcion de la base de datos seleccionada no existe";
				exit(0);
			break;
			} 
	}
}
?>