<?php
class DB_mysql extends Variables{
	/* identificador de conexión y consulta */
	
	var $Conexion_ID = 0;
	var $Consulta_ID = 0; 
	/* número de error y texto error */
	var $Errno = 0;
	var $Error = "";	 
	var $msjError = 'ERROR al realizar la consulta';	 
	/* Método Constructor: Cada vez que creemos una variable	
	de esta clase, se ejecutará esta función*/
	/*Conexión a la base de datos*/
	
	public function __construct($opc = "1"){
		$this->opcion($opc);
		
		// Conectamos al servidor
		
	$this->Conexion_ID = mysqli_connect($this->Servidor, $this->Usuario, $this->Clave, $this->BaseDatos);
            	
		if (!$this->Conexion_ID) {		
			 $this->Error = "Ha fallado la conexión.";
			
			 $data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => $this->Error,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);

			exit(0);
		}	 
		/* Si hemos tenido éxito conectando devuelve 	
		el identificador de la conexión, sino devuelve 0 */
		mysqli_set_charset($this->Conexion_ID,'utf8');
		return $this->Conexion_ID;	
	}
	
	function escapar_variable($var = ''){
		//escapamos la variable
		$var = @mysqli_real_escape_string($var);
		return $var;
		}
	
	/* Ejecuta un consulta */
	
	public function consulta($sql = ""){	 
		if ($sql == ""){		
			$this->Error = "No ha especificado una consulta SQL";	
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => $this->Error,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
			}
			
		//ejecutamos la consulta
		$this->Consulta_ID = @mysqli_query($this->Conexion_ID, $sql);
	
		if (!$this->Consulta_ID) {		
			 $this->Errno = mysqli_errno($this->Conexion_ID);		
			 $this->Error = mysqli_error($this->Conexion_ID);	
			 $data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => $this->Error,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
		}
	
	/* Si hemos tenido éxito en la consulta devuelve 
	el identificador de la conexión, sino devuelve 0 */
	
		return $this->Consulta_ID;
	}
	
	//Conteo de registros de una consulta
	public function conteoconsulta($sql){	 
	
		if($this->consulta($sql) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => $this->msjError,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
		}	
	/* Si hemos tenido éxito en la consulta devuelve 
	el identificador de la conexión, sino devuelve 0 */
		return mysqli_num_rows($this->Consulta_ID);
	}	
	
	/* Devuelve el el ultimo id insertado */
	
	public function obtenerconexion() {
		return $this->Conexion_ID;
	}
	
	public function ultimoid() {
		return mysqli_insert_id($this->Conexion_ID);
	}
	
	/* Devuelve el número de campos de una consulta */
	
	public function numcampos() {
		return mysqli_num_fields($this->Consulta_ID);
	}
	
	/* Devuelve el número de registros de una consulta */
	
	public function numregistros(){
		return mysqli_num_rows($this->Consulta_ID);
	}
	
	/* Devuelve el nombre de un campo de una consulta */
	
	public function nombrecampo($numcampo) {
		return mysqli_field_name($this->Consulta_ID, $numcampo);
	}
	
	/* Muestra los datos de una consulta */
	
	public function verconsulta($sql) {
		if($this->consulta($sql) == 0){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => $this->msjError,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
		}
			
		echo "<table border=1>\n";
		// mostramos los nombres de los campos
		for ($i = 0; $i < $this->numcampos(); $i++){
			echo "<td><b>".$this->nombrecampo($i)."</b></td>\n";
		}
		echo "</tr>\n";
		// mostrarmos los registros
		while ($row = mysqli_fetch_row($this->Consulta_ID)) {
			echo "<tr> \n";
			for ($i = 0; $i < $this->numcampos(); $i++){
				echo "<td>".$row[$i]."</td>\n";
			}
			echo "</tr>\n";
		}
	}

	public function obtenerlista($sql){
		if($this->consulta($sql) == '0'){
			$data = array(
				'error' => true,
				'titulo' => 'Error',
				'mensaje' => $this->msjError,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
		}
					
		$array = array();
		while ($row = mysqli_fetch_object($this->Consulta_ID)){
			$array[] = $row;
		}
		return $array;	
	}
	
	public function consultadato($sql) {
		if($this->consulta($sql) == '0'){
			
			$data = array(
				'error' => true,
				'titulo' =>  $this->Error,
				'mensaje' => $this->msjError,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
			}
		// mostrarmos los registros
		$row = mysqli_fetch_array($this->Consulta_ID);
		return $row[0];
	}

	public function consultaregistro($sql) {
		if($this->consulta($sql) == '0'){
			$data = array(
				'error' => true,
				'titulo' =>  $this->Error,
				'mensaje' => $this->msjError.' Err:'.$sql,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
			
		}
		// mostrarmos los registros
		$row = mysqli_fetch_array($this->Consulta_ID);
		return $row[0];
	}

	public function consultaexistencia($sql) {
		if($this->consulta($sql) == 0){
			$data = array(
				'error' => true,
				'titulo' =>  'Error',
				'mensaje' => $this->msjError.' Err:'.$sql,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
		}
		// mostrarmos los registros
		$row = mysqli_fetch_array($this->Consulta_ID);
		//identifica si existen datos para enviar el ID de lo contrario regresa cero
		if($this->numregistros() >= 1)
			return $row[0];
		else
			return 0;
	}

	public function fetch_array($sql) {
		if($this->consulta($sql) == '0'){
			$data = array(
				'error' => true,
				'titulo' =>  $this->Error,
				'mensaje' => $this->msjError.' Err:'.$sql,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
			
		}
		// mostrarmos los registros
		return mysqli_fetch_array($this->Consulta_ID);
	}
	
	public function fetch_objet($sql) {
		if($this->consulta($sql) == 0){
			$data = array(
				'error' => true,
				'titulo' =>  'Error',
				'mensaje' => $this->msjError.' Err:'.$sql,
				'tipo' => 'warning',
				'funcion' => null

			);
			echo json_encode($data);	
			exit(0);
		}
		// mostrarmos los registros
		return mysqli_fetch_object($this->Consulta_ID);
	}	

	//cerrar coexion
	public function cerrarconexion(){
		@mysqli_free_result($this->Conexion_ID);
		@mysqli_close($this->Conexion_ID);		
		
		}
	
} //fin de la Clse DB_mysql
?>