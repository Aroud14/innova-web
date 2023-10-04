<?php 
$filePath = 'archivos/' . $_SESSION['foto'];
?>
<!-- Header -->
<div class="header">

    <!-- Logo -->
        <div class="header-left active">
        <a href="index.html" class="logo">
            <img src="assets/img/logo.png"  alt="">
        </a>
        <a href="index.html" class="logo-small">
            <img src="assets/img/logo-small.png"  alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>
    <!-- /Logo -->
    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    
    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Notifications -->
        <li class="nav-item">
            <a href="usuario_perfil" class="nav-link">
                <h6><?php echo $datos_sis['nombre'] ?></h6>
            </a>
        </li>
        <!-- /Notifications -->
        
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="assets/img/user.png" alt="">
                <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="<?= (isset($_SESSION['foto']) && $_SESSION['foto'] != '' && file_exists($filePath)) ? 'archivos/'.$_SESSION['foto'] : 'assets/img/user.png' ?>" alt="">
                        <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6><?php echo $datos_sis['nombre'] ?></h6>
                            <h5>Administrador</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="usuario_perfil"> <i class="me-2"  data-feather="user"></i> Mi perfil</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="php/cerrarses.php"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Cerrar sesión</a>
                </div>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="usuario_perfil">Mi perfil</a>
            <a class="dropdown-item" href="php/cerrarses.php">Salir</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
<!-- Header -->