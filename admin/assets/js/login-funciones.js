//******************* INCIA LOGIN  *************************************************
function login_sesion_m(){
   if($('#login_name').val().length < 1 && $('#login_pw').val().length < 1){
    $('#msjRequire').html('Ingrese un Usuario y Contraseña');
    return false;
  }
  else{
    $('#msjRequire').html('');
  }

  if($('#login_name').val().length < 1){
    $('#msjRequire').html('Ingrese un Usuario');
    return false;
  }
  else{
    $('#msjRequire').html('');
  }

  if($('#login_pw').val().length < 1){
    $('#msjRequire').html('Ingrese una CONTRASEÑA');
    return false;
  }else{
    $('#msjRequire').html('');
  }

	$( "#login_session_m" ).submit();
}
//******************* TERMINA  LOGIN  ***********************************************

