<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> 
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="ti-menu"></i>
        </a>
            
        <div class="top-left-part">
            <!--<a class="logo" href="index-2.html"><b><img src="plugins/images/eliteadmin-logo.png" alt="home" /></b><span class="hidden-xs"><img src="plugins/images/eliteadmin-text.png" alt="home" /></span></a>-->
            <!--<a class="logo" href="index-2.html"><b><img src="plugins/images/eliteadmin-logo.png" alt="home" /></b><span class="hidden-xs"><img src="plugins/images/eliteadmin-text.png" alt="home" /></span></a>-->
            <!--
            <a class="logo" href="inicio"><b><img src="img/logo_inicio.png" alt="home" style="height: 45px;" /></b><span class="hidden-xs"><img src="img/nom_inicio.png" alt="home" /></span></a>
            --->          
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li>
                <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                    <i class="icon-arrow-left-circle ti-menu"></i>
                </a>
            </li>
        </ul>
        
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown"> 
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
                    <img src="../assets/img/user.png" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs"><?php echo $nombre ?></b> 
                </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    <li>
                        <a href="#">
                            <i class="ti-user"></i> Mi Portafolio
                        </a>
                    </li>
                </ul>
            </li>
            <li id="lnkLogout" class="right-side-toggle">
                <a title="Salir" class="waves-effect waves-light" href="#">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <?php 
                $obtener_menu_padre = $conexion->obtenerlista($querys->MenuPadre($id_usuario));
                foreach ($obtener_menu_padre as $menu_padre)
                {
                    $obtener_submenu = $conexion->obtenerlista($querys->MenuHijo($id_usuario, $menu_padre->id_permiso));
                    $num_arreglo = count($obtener_submenu);
                    
                    if($num_arreglo != 0){
                        $carret = '<span class="fa arrow"></span>';
                    }else{
                        $carret = '';
                    }

                    if($menu_padre->archivo === $modulo){
                        $activo = 'active';
                    }else {
                        $activo = '';
                    }

                    echo '<li> 
                            <a href="'.$menu_padre->archivo.'" class="waves-effect '.$activo.'">
                                <i class="fa '.$menu_padre->icono.'  zmdi-hc-fw fa-fw"></i> 
                                <span class="hide-menu">'.$menu_padre->nombre.$carret.'</span>
                            </a>';
                            if($num_arreglo != 0){
                                echo '<ul class="nav nav-second-level">';
                                    foreach($obtener_submenu as $menu_hijo){
                                        echo '<li class="'.$activo.'"><a href="'.$menu_hijo->archivo.'">'.$menu_hijo->nombre.'</a></li>';
                                    }
                                echo '</ul>'; 
                            }
                    echo '</li>';

                }
            ?>

            <!--<li> 
                <a href="index-2.html" class="waves-effect active">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw" ></i> 
                    <span class="hide-menu"> Dashboard <span class="fa arrow"></span> 
                    <span class="label label-rouded label-custom pull-right">4</span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="index-2.html">Demographical</a></li>
                    <li> <a href="index3.html">Analitical</a> </li>
                    <li> <a href="index4.html">Simpler</a> </li>
                </ul>
            </li>
            <li> 
                <a href="widgets.html" class="waves-effect">
                    <i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu">Widgets</span>
                </a> 
            </li>-->
        </ul>
    </div>
</div>