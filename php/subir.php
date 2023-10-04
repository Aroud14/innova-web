<?php
require_once("../admin/php/clase_variables.php");
require_once("../admin/php/clase_mysql.php"); 
require_once("../admin/php/clase_funciones.php");
include_once("../admin/php/clase_upload.php");
include_once("clase_querys.php");

//$push = new PushNotifications();
$funciones = new Funciones();
//LLAMAMOS A LA CLASE CONEXION
$conexion = new DB_mysql(1);
//llamamos a la clase upload para cargar archivos
$upload = new upload();
$querys = new Querys();

$datos = array();

$guardar = "Registro Guardado Satisfactoriamente";
$editar = "Registro Modificado Satisfactoriamente";

$ip        = $funciones->getRealIP();
$navegador = $funciones->getBrowser();
$so        = $funciones->getOs();

switch($_POST['opcion']){
    /// MENSAJES ENVIADOS DESDE LA PAGINA WEB
    case 1:
        $datos['nombre']    = $_POST['nombre'];
        $datos['apellidos'] = $_POST['apellidos'];
        $datos['correo']    = $_POST['email'];
        $datos['telefono']  = $_POST['telefono'];
        $datos['mensaje']   = $_POST['mensaje'];

        $consulta = "INSERT INTO tblc_mensajes_web(nombre, apellidos, correo, telefono, mensaje) VALUES ('".$datos['nombre']."', '".$datos['apellidos']."', '".$datos['correo']."', '".$datos['telefono']."', '".$datos['mensaje']."') ";

        if($conexion->consulta($consulta) == 0){
            $data = array(
                'icono' => 'error',
                'titulo' => 'Error al enviar',
                'mensaje' => 'Su mensaje no se pudo enviar correctamente, vuelva a intentar o recarge la página web por favor',
            );
            exit(0);
        }

        $data = array(
            'icono' => 'success',
            'titulo' => 'Se envio correctamente',
            'mensaje' => 'Su mensaje se envio correctamente, nuestros promotores se contactaran con usted en un plazo de 24 horas habiles',
        );
        echo json_encode($data);
        exit(0);
    break;

}
?>