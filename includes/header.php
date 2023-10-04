<?php
    $datosEmpresa = $conexion->fetch_array($querys->getDatosEmpresa());
?>

<header class="page-head">
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar novi-background rd-navbar-center" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="220px" data-xl-stick-up-offset="220px" data-xxl-stick-up-offset="220px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-inner">
                <div class="rd-navbar-panel">
                    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap"><span></span></button>
                    <h4 class="panel-title"><?= $datosEmpresa["nombre_empresa"] ?? "" ?></h4>
                        <button class="rd-navbar-top-panel-toggle" data-rd-navbar-toggle=".rd-navbar-top-panel"><span></span>
                    </button>
                    <div class="rd-navbar-top-panel">
                        <div class="shell">
                            <div class="range range-10 range-md-center range-md-middle range-lg-around">
                                <div class="cell-md-3">
                                    <div class="unit unit-horizontal unit-top unit-spacing-xs">
                                        <div class="unit-left"><span class="icon novi-icon mdi mdi-phone text-middle"></span></div>
                                        <div class="unit-body">
                                            <?php 
                                                echo $datosEmpresa['telefono'] != '' ? '<a class="reveal-block" href="tel:'.$datosEmpresa['telefono'].'">Tel: '.$datosEmpresa['telefono'].',</a>' : '';

                                                echo $datosEmpresa['whatsapp'] != '' ? '<a href="https://api.whatsapp.com/send?phone='.$datosEmpresa['whatsapp'].'&text=Hola,%20¿Me%20podria%20dar%20mas%20imformación?">Whats: '.$datosEmpresa['whatsapp'].',</a>' : '';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell-md-3 text-center">
                                    <div class="rd-navbar-brand">
                                        <a class="reveal-inline-block" href="index.php">
                                            <img src="<?= 'admin/archivos/configuracion/imagenes/'.$datosEmpresa["logo"] ?>" alt="" width="191" height="80">
                                        </a>
                                    </div>
                                </div>
                                <div class="cell-md-3">
                                    <div class="inset-md-left-50">
                                        <div class="unit unit-horizontal unit-top unit-spacing-xs text-left">
                                            <div class="unit-left"><span class="icon novi-icon mdi mdi-map-marker text-middle"></span></div>
                                            <div class="unit-body"><?= $datosEmpresa['direccion'] ?? "" ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rd-navbar-menu-wrap clearfix">
                    <div class="rd-navbar-nav-wrap">
                        <div class="rd-navbar-mobile-scroll">
                            <div class="rd-navbar-mobile-header-wrap">
                                <div class="rd-navbar-mobile-brand">
                                    <a href="index.php">
                                        <img src="<?= 'admin/archivos/configuracion/imagenes/'.$datosEmpresa["logo"] ?>" alt="" srcset="Logo principal">
                                    </a>
                                </div>
                            </div>
                            <ul class="rd-navbar-nav">
                                <li><a href="index.php">Inicio</a></li>
                                <li><a href="about-us.html">Nosotros</a>
                                    <ul class="rd-navbar-dropdown">
                                        <li><a href="history.html">History</a></li>
                                    </ul>
                                </li>
                                <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a href="course-grid.html">Course</a>
                                    <ul class="rd-navbar-dropdown rd-navbar-open-right" style="">
                                        <li><a href="course-grid.html">Course Page</a></li>
                                        <li><a href="course-details.html">Course Details Page</a></li>
                                    </ul>
                                </li>
                                <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a href="events.html">Events</a>
                                    <ul class="rd-navbar-dropdown rd-navbar-open-right" style="">
                                        <li><a href="event-page.html">Event Details Page</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Pages</a>
                                    <ul class="rd-navbar-dropdown">
                                        <li><a href="team.html">Lecturer</a></li>
                                        <li><a href="gallery.html">Gallery</a></li>
                                        <li><a href="404.html">404</a></li>
                                        <li><a href="privacy.html">Terms of Use</a></li>
                                        <li><a href="coming-soon.html">Coming Soon</a></li>
                                        <li><a href="search-results.html">Search Results</a></li>
                                        <li><a href="team-member-profile.html">Team Member Profile</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>