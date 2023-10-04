
            <!-- Header -->
            <div class="header">
            
                <!-- Logo -->
                 <div class="header-left active">
                    <a href="index.html" class="logo">
                        <img src="assets/img/17381687_21082023_1220.png" alt="" style="width: 50px;height: 50px;">
                    </a>
                    <a href="index.html" class="logo-small">
                        <img src="assets/img/17381687_21082023_1220.png" alt="">
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
                    <!-- Search -->
                    <li class="nav-item">
                        <div class="top-nav-search">
                            
                            <a href="javascript:void(0);" class="responsive-search">
                                <i class="fa fa-search"></i>
                        </a>
                            <form action="#">
                                <div class="searchinputs">
                                    <input type="text" placeholder="Search Here ...">
                                    <div class="search-addon">
                                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                    </div>
                                </div>
                                <a class="btn"  id="searchdiv"><img src="assets/img/icons/search.svg" alt="img"></a>
                            </form>
                        </div>
                    </li>
                    <!-- /Search -->
                
                    <!-- Notifications -->
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link">
                            <img src="assets/img/icons/notification-bing.svg"   alt="img"> <span class="badge rounded-pill">4</span>
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
                                    <span class="user-img"><img src="assets/img/user.png" alt="">
                                    <span class="status online"></span></span>
                                    <div class="profilesets">
                                        <h6><?php echo $datos_sis['nombre'] ?></h6>
                                        <h5>Administrador</h5>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <a class="dropdown-item" href="perfil"> <i class="me-2"  data-feather="user"></i> Mi perfil</a>
                                <hr class="m-0">
                                <a class="dropdown-item logout pb-0" href="php/cerrarses.php"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- /Header Menu -->
                
                <!-- Mobile Menu -->
                <div class="dropdown mobile-user-menu">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="perfil">Mi perfil</a>
                        <a class="dropdown-item" href="php/cerrarses.php">Salir</a>
                    </div>
                </div>
                <!-- /Mobile Menu -->
            </div>
            <!-- Header -->