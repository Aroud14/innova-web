<?php
    require "php/inicializandoDatos.php";
?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Sistema E&D">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Desarrollos Inteligentes">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>E&D | ADMIN</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="archivos/configuracion/imagenes/17381687_21082023_1220.png">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/plugins/owlcarousel/owl.theme.default.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <!-- Summernote CSS -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- Preloader -->
    <div id="global-loader" >
        <div class="whirly-loader"> </div>
    </div>

    <div id="main-wrapper">
        <!-- Navigation HEADER-->
        <?php require 'pg/modal.php'; ?>

        <?php include_once('pg/menu_cabeza.php'); ?>
        <?php include_once('pg/menu_inicio.php'); ?>

        <!-- Page Content -->
        <div class="page-wrapper cardhead">
            <div class="content container-fluid" id="ContenidoGeneral">
                <?php
                    if(file_exists('pg/'.$modulo.'.php'))
                    {
                        if ($permiso != 0) 
                        {
                            require('pg/'.$modulo.'.php');
                        }
                        else
                        {
                            require('pg/accesoDenegado.php');
                        }
                    }
                    else
                    {
                        require('pg/error-404.php');
                    }
                ?>
                <footer class="footer text-center"> Desarrollos Inteligentes<?php echo date('Y') ?> &copy; </footer>
            </div>
        </div>

    </div>
    
    <!-- jQuery -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Feather Icon JS -->
    <script src="assets/js/feather.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Sweetalert 2 -->
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>

    <!-- Select2 JS -->
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <!-- <script src="assets/plugins/select2/js/custom-select.js"></script> -->

    <!-- Owl JS -->
    <script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

    <!-- Datatable JS -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    
    <!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Datetimepicker JS -->
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>

    <!-- Summernote JS -->
    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

    <!-- Fileupload JS -->
    <script src="assets/plugins/fileupload/fileupload.min.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBBoqs6vpWzyZCHTt5q44ltgcGav3v9GWc"></script>
    <script src="assets/js/scriptsGoogleMaps.js"></script>
    <script src="assets/js/funciones.js"></script>
    <script src="assets/js/ajax-funciones.js"></script>

    <!-- CKEDITOR -->
    <script src="assets/ckeditor5/ckeditor_super_build.js"></script>
    <script src="assets/ckfinder/ckfinder.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
            if($('.mydatepicker').length > 0 ){
                $('.mydatepicker').datetimepicker({
                    format: 'DD-MM-YYYY',
                    icons: {
                        up: "fas fa-angle-up",
                        down: "fas fa-angle-down",
                        next: 'fas fa-angle-right',
                        previous: 'fas fa-angle-left'
                    }
                });
            }
        });
    </script>

     <!-- Custom JS -->
     <script src="assets/js/script.js"></script>
    
</body>

</html>