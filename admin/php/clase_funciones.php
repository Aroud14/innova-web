<?php
 date_default_timezone_set ('America/Mexico_City');

class Funciones {
	public $querys;
	public $db;
	private $Consulta_ID = 0; 
	var $Errno = 0;
	var $Error = "";	 
	var $msjError = "ERROR al realizar la consulta";
	function __construct($opbd = 1){
		$this->querys = new Querys();
		$this->db = new DB_mysql($opbd);
		if($this->db->Error){
			header("Location: error/1");
			exit;
			}		
	}

	public function getComboActivo($value)
	{
		$array_visible=array('-1'=>'Estatus(Todos)', 1=>"SI", 0=>"NO");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboUnidadMedida($value)
	{
		$array_visible=array(1=>"Pieza", 2=>"Gramaje");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboOpcionSeleccionable($value)
	{
		$array_visible=array(0=>"No seleccionable al agregar prendas", 1=>"Seleccionable al agregar prendas");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function email_valido($mail){
	  return (false !== filter_var($mail, FILTER_VALIDATE_EMAIL));
	}


	public function llenarcombo($resultados) {
		foreach($resultados as $resultado){
			echo '
			<option value="'.$resultado->id.'" name="'.$resultado->valor.'">'.$this->cdetectUtf8($resultado->valor).'</option>';
		}
	}


	
	public function llenarcombomodifica($resultados,$id) {
		// mostrarmos los registros
		foreach($resultados as $resultado){			
			if($id == $resultado->id) echo '<option value="'.$resultado->id.'" selected="selected">'.$this->cdetectUtf8($resultado->valor).'</option>';
			else echo '<option value="'.$resultado->id.'">'.$this->cdetectUtf8($resultado->valor).'</option>';		
		}
	}
	
	public function llenarcombomodificaarreglo2($resultados,$arregloid) {
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if(!in_array($resultado->id, $arregloid)) echo '<option value="'.$resultado->id.'">'.$resultado->valor.'</option>';		
		}
	}	
	
	public function llenarcombomodificaarreglo($resultados,$arregloid) {
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if(in_array($resultado->id, $arregloid)) echo '<option value="'.$resultado->id.'" selected="selected">'.$resultado->valor.'</option>';
			else echo '<option value="'.$resultado->id.'">'.$resultado->valor.'</option>';		
		}
	}

	/* Muestra opciones con input tipo radio */
	
	public function llenaradio($resultados,$nombre) {
		$x = 1;
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if($x == 1){
				echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" checked="checked" />'.$resultado->valor.'&nbsp;&nbsp;';
				$x++;
			}
			else
				echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" />'.$resultado->valor.'&nbsp;&nbsp;';
				
		}
	}
	
	public function llenaradiomodifica($resultados,$id,$nombre) {
		// mostrarmos los registros
		foreach($resultados as $resultado){			
			if($id == $resultado->id) echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" checked="checked" />'.$resultado->valor.'&nbsp;&nbsp;';
			else echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" />'.$resultado->valor.'&nbsp;&nbsp;';		
		}
	}
	

	

	public function cortarTexto($string, $chars = 100, $elipsis = '...') {
	    // elimino tags y returns y separo en cadenas de $chars caracteres (o menos)
	    // luego tokenizo las cadenas con el caracter "\n", el mismo que usé
	    // antes para separar la cadena
	    $cut = strtok(wordwrap(strip_tags(nl2br($string)), $chars,"\n"), "\n");

	    // elimino puntuaciones y espacios finales
	    $cut = rtrim($cut, " \t\n\r\0\x0B,;.?-");

	    // si la longitud de la cadena es mayor que la longitud del recorte
	    // y la longitud del recorte es mayor que 0, agrego $elipsis
	    if(strlen($string)>strlen($cut) && strlen($cut)>0){
	        $cut .= $elipsis;
	    }

	    return $cut;
	}
	function textoTruncate($string, $limit, $break=" ", $pad="...") {
		// return with no change if string is shorter than $limit
		if(strlen($string) <= $limit)
		return $string;
		// is $break present between $limit and the end of the string?
		if(false !== ($breakpoint = strpos($string, $break, $limit))) {
			if($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		return $string;
	}

	//convierte la fecha a formato año / mes / dia
	public function cambiarFormatoFecha($fecha){
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
    	return $dia."<strong>.</strong>".$mes."<strong>.</strong>".$anio; 
	}
	//convierte la fecha a formato año - mes - dia
	public function cambiarFormatoFechabase($fecha){
		if(strstr($fecha,"-")){
			list($dia,$mes,$anio)=explode("-",$fecha);
		}
		else{
			list($dia,$mes,$anio)=explode("/",$fecha);
		}
    	return $anio."-".$mes."-".$dia; 
	}

	public function cambiarFormatoFechabase2($fecha){
		if(strstr($fecha,"-")){
			list($mes,$dia,$anio)=explode("-",$fecha);
		}
		else{
			list($mes,$dia,$anio)=explode("/",$fecha);
		}
    	return $anio."-".$mes."-".$dia; 
	}

	//convierte la fecha a formato dia / mes / año
	public function cambiarFormatoFechaform($fecha){
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
    	return $dia."/".$mes."/".$anio; 
	}

	//convierte color exadecimal a RGB
	public function rgbColor($fondo)	{
		$red = (int) hexdec(substr($fondo, 0, 2));
		$green = (int) hexdec(substr($fondo, 2, 2));
		$blue = (int) hexdec(substr($fondo, 4, 2));
		return array($red, $green, $blue);
	}

	//limpia cadena para evitar inyeccion SQL
	public function limpia($var){
		$var = strip_tags($var);
		$malo = array("\\",";","\'","'","$","%","!",","," OR "," AND "," XOR "," SELECT "," * "," FROM "," WHERE "," ORDER "," GROUP "," BY "," ALTER "," UPDATE ","(",")",'"',"select"," from "," and "," where "," order "," delete "," update ",".php",".asp",".aspx",".html",".xml",".js",".css",".exe",".tar",".rar",".ocx"); // Aqui poner caracteres no permitidos
		$i=0;
		$o=count($malo);
		$o= $o-1;
		while($i<=$o){
			$var = str_replace($malo[$i],"",$var);
			$i++;
		}		
		/*if (get_magic_quotes_gpc()) {
				$var = mysqli_real_escape_string(stripslashes($var));
			}else{
				$var = mysqli_real_escape_string($var);
			}*/
		
		return $var;
	}

		public function limpiamonto($var){
		$var = strip_tags($var);
		$malo = array("\\",";","\'","'","$","%","!",","," OR "," AND "," XOR "," SELECT "," * "," FROM "," WHERE "," ORDER "," GROUP "," BY "," ALTER "," UPDATE ","(",")",'"',"select"," from "," and "," where "," order "," delete "," update ",".php",".asp",".aspx",".html",".xml",".js",".css",".exe",".tar",".rar",".ocx","-","_"); // Aqui poner caracteres no permitidos
		$i=0;
		$o=count($malo);
		$o= $o-1;
		while($i<=$o){
			$var = str_replace($malo[$i],"",$var);
			$i++;
		}		
		/*if (get_magic_quotes_gpc()) {
				$var = mysqli_real_escape_string(stripslashes($var));
			}else{
				$var = mysqli_real_escape_string($var);
			}*/
		
		return $var;
	}

    public function estatus($u){
		if ($u==0)  {$ru = "<font color='#BE000D'><b>NO</b></font>";}
		elseif ($u==1)  {$ru = "<font color='#008D0C'><b>SI</b></font>";}	
		echo $ru; //Retornar el resultado
	}

	public function tipoDatoSeleccionado($u){
		if ($u==1)  {$ru = "<font color='#008D0C'><b>Texto</b></font>";}
		elseif ($u==2)  {$ru = "<font color='#008D0C'><b>Números</b></font>";}
		elseif ($u==3)  {$ru = "<font color='#008D0C'><b>Opciones</b></font>";}	
		echo $ru; //Retornar el resultado
	}

	public function unidadMedida($u){
		//if ($u==0)  {$ru = "<font color='#BE000D'><b>NO</b></font>";}
		if ($u==1)  {$ru = "<font color='#008D0C'><b>Pieza</b></font>";}
		else if ($u==2)  {$ru = "<font color='#008D0C'><b>Gramaje</b></font>";}
		echo $ru; //Retornar el resultado
	}  

	public function periodos($u){
		if ($u==1)  {$ru = "<font color='#008D0C'><b>DÍAS</b></font>";}
		elseif ($u==2)  {$ru = "<font color='#008D0C'><b>MESES</b></font>";}	
		echo $ru; //Retornar el resultado
	} 
	
	 public function permiso_edita($u){
		if ($u==0)  {$ru = "<font color='#BE000D'><b>NO</b></font>";}
		elseif ($u==1)  {$ru = "<font color='#008D0C'><b>SI</b></font>";}	
		echo $ru; //Retornar el resultado
	}   
	 public function permiso_elimina($u){
   		if ($u==0)  {$ru = "<font color='#BE000D'><b>NO</b></font>";}
		elseif ($u==1)  {$ru = "<font color='#008D0C'><b>SI</b></font>";}		
		echo $ru; //Retornar el resultado
	}

    public function diasSemanas($u){
   		if ($u==0)  {$ru = "<font color='#085CEE'><b>Domingo </b></font>";}
		elseif ($u==1)  {$ru = "<font color='#085CEE'><b> Lunes </b></font>";}
		elseif ($u==2)  {$ru = "<font color='#085CEE'><b> Martes </b></font>";}
		elseif ($u==3)  {$ru = "<font color='#085CEE'><b> Miércoles </b></font>";}
		elseif ($u==4)  {$ru = "<font color='#085CEE'><b> Jueves </b></font>";}
		elseif ($u==5)  {$ru = "<font color='#085CEE'><b> Viernes </b></font>";}
		elseif ($u==6)  {$ru = "<font color='#085CEE'><b> Sábado </b></font>";}
		
		return $ru; //Retornar el resultado
	}

	function porcentaje($monto, $porcentaje){
		return ($monto * $porcentaje)/100;
	}

	public function sanear_string($string)
	{
	
		$string = trim($string);
	
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);
	
		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);
	
		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);
	
		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);
	
		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);
	
		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);
	
		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "~",
				 "#", "@", "|", "!", "\"",
				 "·", "$", "%", "&", "/",
				 "(", ")", "?", "'", "¡",
				 "¿", "[", "^", "`", "]",
				 "+", "}", "{", "¨", "´",
				 ">", "< ", ";", ",", ":",
				 ".", "'", '"','“','”'),
			'',
			$string
		);
	
	
		return $string;
	}

	public function url_amiga($string){

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);

		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "~",
					"#", "@", "|", "!", "\"",
					"·", "$", "%", "&", "/",
					"(", ")", "?", "'", "¡",
					"¿", "[", "^", "`", "]",
					"+", "}", "{", "¨", "´",
					">", "< ", ";", ",", ":",
					".", "'", '"','“','”',"‘","’","…","..."),
			'',
			$string
		);

		$string = strtolower($string);
		$string = str_replace("–", "-", $string);
		$string = str_replace(" ", "-", $string);
		return $string;
	}

	public function cadena_permitida($string){   
	   //compruebo que los caracteres sean los permitidos 
	   $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-"; 
	   for ($i=0; $i<strlen($string); $i++){ 
	      if (strpos($permitidos, substr($string,$i,1))===false){ 
	         return false; 
	      } 
	   } 
	   return true; 
	}

	public function limpiarCatacteres($string){
		$string = trim($string);
			//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "~",
				 "#", "@", "|", "!", "\"",
				 "·", "$", "%", "&", "/",
				 "(", ")", "?", "'", "¡",
				 "¿", "[", "^", "`", "]",
				 "+", "}", "{", "¨", "´",
				 ">", "< ", ";", ",", ":",
				 ".", "'", '"','“','”','‘',
				 '’'),
			'',
			$string
		);
		return $string;
	}

	public function limpiarComilla($string){
		$string = trim($string);
			//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("'","`","'",'“','”','‘','’',"'"),'"',
			$string
		);
		return $string;
	}

	function number_words($valor,$desc_moneda, $sep, $desc_decimal) {
		$arr = explode(".", $valor);
		$entero = $arr[0];
		if (isset($arr[1])) {
			$decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
		}
   
		$fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
		if (is_array($arr)) {
			$num_word = ($arr[0]>=1000000) ? "{$fmt->format($entero)} de $desc_moneda" : "{$fmt->format($entero)} $desc_moneda";
			if (isset($decimos) && $decimos > 0) {
				$num_word .= " $sep  {$fmt->format($decimos)} $desc_decimal";
			}
		}
		return $num_word;
   	}

	function fechaUrlAmiga($fecha){
		$aFecha = explode(' ',$fecha);

		list($anio,$mes,$dia)=explode("-",$aFecha[0]);

		return $anio."/".$mes."/".$dia;
	}

	public function mes_nombre($mes){
		
		 switch($mes)
			{         
               case 1:
                  $mes='Enero';
                  break;     
               case 2:
                  $mes='Febrero';
                  break;     
               case 3:
                  $mes='Marzo';
                  break;
               case 4:
                  $mes='Abril';
                  break;
               case 5:
                  $mes='Mayo';
                  break;
               case 6:
                  $mes='Junio';
                  break;
               case 7:
                  $mes='Julio';
                  break;
               case 8:
                  $mes='Agosto';
                  break;
               case 9:
                  $mes='Septiembre';
                  break;
               case 10:
                  $mes='Octubre';
                  break;
               case 11:
                  $mes='Noviembre';
                  break;
               case 12:
                  $mes='Diciembre';
                  break;
			}
		return $mes;
	}

	public function fecha(){
		$fecha = getdate();
		$dia = $fecha["mday"];
		$mes = $fecha["mon"];

           switch($mes)
              {         
               case 1:
                  $mes='Enero';
                  break;     
               case 2:
                  $mes='Febrero';
                  break;     
               case 3:
                  $mes='Marzo';
                  break;
               case 4:
                  $mes='Abril';
                  break;
               case 5:
                  $mes='Mayo';
                  break;
               case 6:
                  $mes='Junio';
                  break;
               case 7:
                  $mes='Julio';
                  break;
               case 8:
                  $mes='Agosto';
                  break;
               case 9:
                  $mes='Septiembre';
                  break;
               case 10:
                  $mes='Octubre';
                  break;
               case 11:
                  $mes='Noviembre';
                  break;
               case 12:
                  $mes='Diciembre';
                  break;
              }
           
		$año = $fecha["year"];
		echo "$dia de $mes del $año";		
	}

	public function mes($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}

           switch($mes)
              {         
               case 1:
                  $mes='Enero';
                  break;     
               case 2:
                  $mes='Febrero';
                  break;     
               case 3:
                  $mes='Marzo';
                  break;
               case 4:
                  $mes='Abril';
                  break;
               case 5:
                  $mes='Mayo';
                  break;
               case 6:
                  $mes='Junio';
                  break;
               case 7:
                  $mes='Julio';
                  break;
               case 8:
                  $mes='Agosto';
                  break;
               case 9:
                  $mes='Septiembre';
                  break;
               case 10:
                  $mes='Octubre';
                  break;
               case 11:
                  $mes='Noviembre';
                  break;
               case 12:
                  $mes='Diciembre';
                  break;
              }
           
		return $mes;		
	}


	public function fecha2($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}

           switch($mes)
              {         
               case 1:
                  $mes='Enero';
                  break;     
               case 2:
                  $mes='Febrero';
                  break;     
               case 3:
                  $mes='Marzo';
                  break;
               case 4:
                  $mes='Abril';
                  break;
               case 5:
                  $mes='Mayo';
                  break;
               case 6:
                  $mes='Junio';
                  break;
               case 7:
                  $mes='Julio';
                  break;
               case 8:
                  $mes='Agosto';
                  break;
               case 9:
                  $mes='Septiembre';
                  break;
               case 10:
                  $mes='Octubre';
                  break;
               case 11:
                  $mes='Noviembre';
                  break;
               case 12:
                  $mes='Diciembre';
                  break;
              }
           
		return "$dia de $mes $anio";		
	}
	
	public function fecha3($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
		$i = strtotime($fecha);
		$dia1 = date("w",mktime(0, 0, 0, $mes, $dia, $anio));
           switch($mes)
              {         
               case 1:
                  $mes='Enero';
                  break;     
               case 2:
                  $mes='Febrero';
                  break;     
               case 3:
                  $mes='Marzo';
                  break;
               case 4:
                  $mes='Abril';
                  break;
               case 5:
                  $mes='Mayo';
                  break;
               case 6:
                  $mes='Junio';
                  break;
               case 7:
                  $mes='Julio';
                  break;
               case 8:
                  $mes='Agosto';
                  break;
               case 9:
                  $mes='Septiembre';
                  break;
               case 10:
                  $mes='Octubre';
                  break;
               case 11:
                  $mes='Noviembre';
                  break;
               case 12:
                  $mes='Diciembre';
                  break;
              }
			  
           switch($dia1)
              {
				  case 0:
                  $dia1='Domingo';
                  break;        
               case 1:
                  $dia1='Lunes';
                  break;     
               case 2:
                  $dia1='Martes';
                  break;     
               case 3:
                  $dia1='Miércoles';
                  break;
               case 4:
                  $dia1='Jueves';
                  break;
               case 5:
                  $dia1='Viernes';
                  break;
               case 6:
                  $dia1='Sabado';
                  break;
              }
           
		return "$dia1, $dia de $mes $anio";		
	}

	public function fecha4($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
           
		return "$dia/$mes/$anio";		
	}

	public function getComboEstatus($value)
	{
		$array_visible=array(1=>"SI", 0=>"NO");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboTipoDatos($value)
	{
		$array_visible=array(1=>"Texto", 2=>"Números", 3=>"Opciones");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboTipoCalculoMora($value)
	{
		$array_visible=array(1=>"Al vencer la fecha", 2=>"Al finiquitar");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboTipoPeriodo($value)
	{
		$array_visible=array(1=>"Dias", 2=>"Meses");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboTipoUsuario($value)
	{
		$array_visible=array(1=>"Administrador", 2=>"Promotor");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function tipo_sexo($id){
		switch($id){		
			case 1: $publicado = '<span class="label label-pill label-success">Hombre</span>'; break;
			case 2: $publicado = '<span class="label label-pill label-warning">Mujer</span>'; break;
			}
		return $publicado;
	}

	public function getcombomes($value){
		$array_visible=array('01'=>"ENERO", '02'=>"FEBRERO", '03'=>"MARZO", '04'=>"ABRIL", '05'=>"MAYO", '06'=>"JUNIO", '07'=>"JULIO", '08'=>"AGOSTO", '09'=>"SEPTIEMBRE", '10'=>"OCTUBRE", '11'=>"NOVIEMBRE", '12'=>"DICIEMBRE");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getcombotipomenu($value){
		$array_visible=array(1=>"Menu", 2=>"Label");
		foreach($array_visible as $t => $visible){
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboVisibleSexo($value)
	{
		$array_visible=array(1=>"Hombre", 2=>"Mujer");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getComboVisibleEstatusProv($value)
	{
		$array_visible=array(0=>"Sin Aprobar", 1=>"Aprobado");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	function genera_password($size=8){		
		/*$logitud = 8;
		$psswd = substr( md5('6%!'.microtime().'?'), 1, $logitud);	
		$psswd = '#$'.$psswd.'9&/';
		$psswd = substr( $psswd, 1, 10); oportunidades de negocio	
		return $psswd;*/

		$caracteres = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$#@!?=%-+*.[]{}_,;:<>|';
		$caractereslong = strlen($caracteres);
		$clave = '';
		for($i = 0; $i < 24; $i++) {
		  $clave .= $caracteres[rand(0, $caractereslong - 1)];
		}
		return $clave;

	}
	
	function create_password($password){
		
		$password = '((&876%!"·¿?!"·$'.$password.'12$&¿?3%%9&/';
		$base = base64_encode($password);
		$md5 = md5($base);
		$resultado = password_hash($md5, PASSWORD_DEFAULT);

		return $resultado;
	}

	function verify_password($password, $hash){
		
		$password = '((&876%!"·¿?!"·$'.$password.'12$&¿?3%%9&/';
		$base = base64_encode($password);
		$md5 = md5($base);

		if (password_verify($md5, $hash)) {
		    return 1;
		} else {
		    return 0;
		}
	}

	function getBrowser() { 
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
		$navegadores = array(
			'Opera' => 'Opera',
			'Mozilla Firefox'=> '(Firebird)|(Firefox)',
			'Google Chrome'=>'Chrome',
			'Galeon' => 'Galeon',
			'Mozilla'=>'Gecko',
			'MyIE'=>'MyIE',
			'Lynx' => 'Lynx',
			'Google Chorme'=>'Chrome',
			'Netscape' => '(CHROME/23\.0\.1271\.97)|(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
			'Konqueror'=>'Konqueror',
			'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
			'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
			'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
			'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
			'Internet Explorer' => 'MSIE',
			);
			
		foreach($navegadores as $navegador=>$pattern){
			if(strpos($user_agent, $pattern) !== false) return $navegador;
			}
			
	}
	
	/* function getOs() {
		$user_agent= strtolower($_SERVER['HTTP_USER_AGENT']);		
		$plataformas = array(
		  'Windows ME' => 'win 9x 4.90',
		  'Windows CE' => 'win ce',
		  'Windows 8' => 'Windows NT 6.2+',
		  'Windows 7' => 'Windows NT 6.1+',
		  'Windows Vista' => 'Windows NT 6.0+',
		  'Windows XP' => 'Windows NT 5.1+',
		  'Windows 2003' => 'Windows NT 5.2+',
		  'Windows' => 'Windows otros',
		  'Windows Phone' => 'windows phone',
		  'iPhone' => 'iPhone',
		  'iPad' => 'iPad',
		  'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
		  'Mac otros' => 'Macintosh',
		  'Android' => 'Android',
		  'BlackBerry' => 'BlackBerry',
		  'Linux' => 'Linux',
		  'Symbian' => 'symbian',
		  'Free BSD' => 'freebsd',
		  'webOS' => 'webos',
	   );

	   foreach($plataformas as $plataforma=>$pattern){
		  if (preg_match($pattern, $user_agent, $coincidencias))
			 return $coincidencias;
	   }

	   return 'Sistema Operativo Desconocido';
	} */

	function getOs() {
		$user_agent= strtolower($_SERVER['HTTP_USER_AGENT']);
		$plataformas = array(
			'/windows nt 11.0/i'    =>  'Windows 11',
			'/windows nt 10.0/i'    =>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile WebOS',
			'/chromeos/i'           =>  'ChromeOS',
			'/ios/i'                =>  'iOS'
		);
		foreach ($plataformas as $regex => $plataforma) { 

		    if (preg_match($regex, $user_agent)) {
		        return $this->limpia($plataforma);
		    }
		}   
	   return 'Sistema Operativo Desconocido';
	}
	
	function getRealIP() {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
			}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}
	
	function html2txt($document){
		$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
					   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
					   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
					   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
		);
		$text = preg_replace($search, '', $document);
		return $text;
	}

	function download_file($archivo, $downloadfilename = null) {
	
		if (file_exists($archivo)) {
			$downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $downloadfilename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($archivo));
	
			ob_clean();
			flush();
			readfile($archivo);
			exit;
		}

	}
	
	function cdetectUtf8($str){ 
        if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, iso-8859-15, windows-1251")!="UTF-8" ){ 
        
            return  utf8_encode($str); 
            } 
        else{ 
            return $str; 
            } 
	}

	function ordenaFechaHora($fechaHora){
		$aFecha_Hora    = explode(' ', $fechaHora);
		$fechaOrdenada  = $this->fecha4($aFecha_Hora[0]);
		$hora           = $aFecha_Hora[1];

		return $fechaOrdenada.' '.$hora;
	}

	public function abreviarCantidad($valor){
		$result = 0; $divisor = 0; $literal = ''; $decimal = '';

		if ($valor > 999) {
			$decimal = 1;
		}

		if($valor>= 1000 && $valor <= 999999){
			$divisor = 1000;
			$literal = 'K';
			$r = bcdiv($valor,$divisor,$decimal);
			$result = number_format($r, $decimal).' '.$literal;
		}elseif($valor>= 1000000 && $valor <= 999999999){
			$divisor = 1000000;
			$literal = 'M';
			$r = bcdiv($valor,$divisor,$decimal);
			$result = number_format($r, $decimal).' '.$literal;
		}elseif($valor >= 1000000000){
			$divisor = 1000000000;
			$literal = 'B';
			$r = bcdiv($valor,$divisor,$decimal);
			$result = number_format($r,$decimal).' '.$literal;
		}else{
			$result = $valor;
		}


		return $result;
	}
	
	public function iconosfa($value = '')
	{
		$array_visible= $this->iconosfa_array();
		foreach($array_visible as $t => $visible)
		{
			if($value==$visible) echo "<option data-icon='".$visible."' value='".$visible."' selected='selected'>".$visible."</option>";
			else echo "<option data-icon='".$visible."' value='".$visible."'>".$visible."</option>";
		}
	}

	public function iconosfa_array(){
		$data = array (
			0 => 'fa fa-bookmark',
			1 => 'fa fa-bookmark-o',
			2 => 'fa fa-envelope-open',
			3 => 'fa fa-envelope-open-o',
			4 => 'fa fa-id-badge',
			5 => 'fa fa-id-card',
			6 => 'fa fa-id-card-o',
			7 => 'fa fa-address-card',
			8 => 'fa fa-address-card-o',
			9 => 'fa fa-window-close',
			10 => 'fa fa-window-close-o',
			11 => 'fa fa-archive',
			12 => 'fa fa-area-chart',
			13 => 'fa fa-car',
			14 => 'fa fa-balance-scale',
			15 => 'fa fa-ban',
			16 => 'fa fa-university',
			17 => 'fa fa-bar-chart',
			18 => 'fa fa-bars',
			19 => 'fa fa-bell',
			20 => 'fa fa-bell-o',
			21 => 'fa fa-bell-slash',
			22 => 'fa fa-bell-slash-o',
			23 => 'fa fa-birthday-cake',
			24 => 'fa fa-book',
			25 => 'fa fa-briefcase',
			26 => 'fa fa-building',
			27 => 'fa fa-building-o',
			28 => 'fa fa-bus',
			29 => 'fa fa-taxi',
			30 => 'fa fa-calculator',
			31 => 'fa fa-calendar',
			32 => 'fa fa-calendar-check-o',
			33 => 'fa fa-calendar-times-o',
			34 => 'fa fa-camera',
			35 => 'fa fa-camera-retro',
			36 => 'fa fa-car',
			37 => 'fa fa-cart-arrow-down',
			38 => 'fa fa-cart-plus',
			39 => 'fa fa-check',
			40 => 'fa fa-check-circle',
			41 => 'fa fa-check-circle-o',
			42 => 'fa fa-check-square',
			43 => 'fa fa-check-square-o',
			44 => 'fa fa-times',
			45 => 'fa fa-cloud-download',
			46 => 'fa fa-cloud-upload',
			47 => 'fa fa-comment',
			48 => 'fa fa-comment-o',
			49 => 'fa fa-commenting',
			50 => 'fa fa-commenting-o',
			51 => 'fa fa-comments',
			52 => 'fa fa-comments-o',
			53 => 'fa fa-credit-card',
			54 => 'fa fa-credit-card-alt',
			55 => 'fa fa-database',
			56 => 'fa fa-desktop',
			57 => 'fa fa-download',
			58 => 'fa fa-envelope',
			59 => 'fa fa-envelope-o',
			60 => 'fa fa-envelope-open',
			61 => 'fa fa-envelope-open-o',
			62 => 'fa fa-exclamation-circle',
			63 => 'fa fa-exclamation-triangle',
			64 => 'fa fa-folder',
			65 => 'fa fa-folder-o',
			66 => 'fa fa-folder-open',
			67 => 'fa fa-folder-open-o',
			68 => 'fa fa-users',
			69 => 'fa fa-home',
			70 => 'fa fa-picture-o',
			71 => 'fa fa-line-chart',
			72 => 'fa fa-location-arrow',
			73 => 'fa fa-lock',
			74 => 'fa fa-map-marker',
			75 => 'fa fa-map-o',
			76 => 'fa fa-map-signs',
			77 => 'fa fa-microphone',
			78 => 'fa fa-microphone-slash',
			79 => 'fa fa-money',
			80 => 'fa fa-pie-chart',
			81 => 'fa fa-search',
			82 => 'fa fa-shopping-bag',
			83 => 'fa fa-shopping-basket',
			84 => 'fa fa-shopping-cart',
			85 => 'fa fa-tag',
			86 => 'fa fa-tags',
			87 => 'fa fa-trash',
			88 => 'fa fa-trash-o',
			89 => 'fa fa-user',
			90 => 'fa fa-user-circle',
			91 => 'fa fa-user-circle-o',
			92 => 'fa fa-user-o',
			93 => 'fa fa-user-plus',
			94 => 'fa fa-users',
			95 => 'fa fa-file',
			96 => 'fa fa-file-archive-o',
			97 => 'fa fa-file-audio-o',
			98 => 'fa fa-file-video-o',
			99 => 'fa fa-file-o',
			100 => 'fa fa-file-pdf-o',
			101 => 'fa fa-file-text',
			102 => 'fa fa-file-text-o',
			103 => 'fa fa-file-video-o',
			104 => 'fa fa-youtube-play',
			105 => 'fa fa-facebook',
			106 => 'fa fa-facebook-official',
			107 => 'fa fa-google',
			108 => 'fa fa-instagram',
			109 => 'fa fa-linkedin',
			110 => 'fa fa-linkedin-square',
			111 => 'fa fa-paypal',
			112 => 'fa fa-twitter',
			113 => 'fa fa-twitter-square',
			114 => 'fa fa-youtube',
			115 => 'fa fa-youtube-play',
			116 => 'fa fa-youtube-square',
			117 => 'fa fa-ambulance',
			118 => 'fa fa-heartbeat',
			119 => 'fa fa-stethoscope',
			120 => 'fa fa-hospital-o',
			121 => 'fa fa-user-md',
			122 => 'fa fa-heart',
			123 => 'fa fa-medkit',
			124 => 'fa fa-heart-o',
			125 => 'fa fa-plus-square',
			126 => 'fa fa-plane',
		  );

		  return $data;
	}

	public function comboDias($id=-1) {
		if($id == -1){
			echo '<option value="0">'."Domingo".'</option>';
			echo '<option value="1">'."Lunes".'</option>';
			echo '<option value="2">'."Martes".'</option>';
			echo '<option value="3">'."Miércoles".'</option>';
			echo '<option value="4">'."Jueves".'</option>';
			echo '<option value="5">'."Viernes".'</option>';
			echo '<option value="6">'."Sábado".'</option>';
		} else {
			$dias = [
				[
					"id" => 0,
					"nombre" => "Domingo"
				],
				[
					"id" => 1,
					"nombre" => "Lunes"
				],
				[
					"id" => 2,
					"nombre" => "Martes"
				],
				[
					"id" => 3,
					"nombre" => "Miércoles"
				],
				[
					"id" => 4,
					"nombre" => "Jueves"
				],
				[
					"id" => 5,
					"nombre" => "Viernes"
				],
				[
					"id" => 6,
					"nombre" => "Sábado"
				]
			];
		
			foreach ($dias as $dia) {
				echo '<option value="'.$dia["id"].'" '.($dia["id"] == $id ? "selected=\"selected\"" : "").'>'.$dia["nombre"].'</option>';
			}
		}
	}

	public function crear_ids($string){

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);

		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "~",
					"#", "@", "|", "!", "\"",
					"·", "$", "%", "&", "/",
					"(", ")", "?", "'", "¡",
					"¿", "[", "^", "`", "]",
					"+", "}", "{", "¨", "´",
					">", "< ", ";", ",", ":",
					".", "'", '"','“','”',"‘","’","…","..."),
			'',
			$string
		);

		$string = strtolower($string);
		$string = str_replace(" ", "_", $string);
		return $string;
	}

	public function llenarcombostring($resultados) {
		$array = explode ( ',', $resultados);

		foreach($array as $resultado){
			$resultado = trim($resultado);
			echo '<option value="'.$resultado.'" name="'.$this->crear_ids($resultado).'">'.$this->cdetectUtf8($resultado).'</option>';
		}
	}

	public function monto1($valor, $valor2){
		echo "$".number_format($valor, 2, '.', ',')." ".$valor2;
	}

	public function getComboTipoPermiso($value)
	{
		//$array_visible=array('-1'=>'Estatus(Todos)', 1=>"SI", 0=>"NO");
		$array_visible=array(1=>"MENU DERECHA", 2=>"SIN MENU");

		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

} //fin de la Clse Funciones


?>