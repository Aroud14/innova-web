<?php 
    $siteKey = "6Lce7pUUAAAAAKINNN5uLt89_8HEmYib5NEzJZ6S";
    $lang = "es";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="POS - Bootstrap Admin Template">
        <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Inicio de Sesión</title>
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        
    </head>
    <body class="account-page">
    
        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <form target="frame_enviar" method="post" action="php/inicio_sesion.php" enctype="multipart/form-data" id="login_session_m">
                            <div class="login-userset">
                                <div class="login-logo">
                                    <img src="assets/img/logo.png" alt="img">
                                </div>
                                <div class="login-userheading">
                                    <h3>Inicio de Sesión</h3>
                                    <h4>Por favor, ingrese los datos de su cuenta</h4>
                                </div>
                            <div class="form-login">
                                    <label>Usuario</label>
                                    <div class="form-addons">
                                        <input type="text" placeholder="Ingrese su usuario" id="login_name" name="login_name">
                                        <img src="assets/img/icons/mail.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Contraseña</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" placeholder="Capture su contraseña" id="login_pw" name="login_pw">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>

                                <div class="form-login">
                                    <div class="alreadyuser">
                                        <h4 id="msjRequire"></h4>
                                    </div>
                                </div>

                                <div class="form-login">
                                    <div class="alreadyuser">
                                        <h4><a href="#" class="hover-a">¿Olvidaste tu contraseña?</a></h4>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <a class="btn btn-login" href="javascript:login_sesion_m();">Entrar</a>
                                </div>

                            </div>

                        </form>
                        <iframe id="frame_enviar" name="frame_enviar" frameborder="0" style="display:none"></iframe>
                    </div>
                    <div class="login-img">
                        <img src="assets/img/login.jpg" alt="img">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->
        
        <!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>

         <!-- Feather Icon JS -->
        <script src="assets/js/feather.min.js"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        
        <script src="assets/js/login-funciones.js"></script>

        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>"> </script>
         
        <!-- Custom JS -->
        <script src="assets/js/script.js"></script>
        
    </body>
</html>