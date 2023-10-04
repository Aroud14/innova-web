<?php include("includes/plantilla_inicio.php"); ?>

<?php include("includes/header.php"); ?>

<?php
    $totalSlider = $conexion->consultaregistro($querys->geConteotSliders());
    if($totalSlider != 0)
    {
        $resultados = $conexion->obtenerlista($querys->getSliders());
?>
        <section class="section">
            <div class="swiper-container swiper-slider swiper-slider-modern swiper-slider-2" data-loop="true" data-dragable="false" data-slide-effect="fade">
                <div class="swiper-wrapper">
                    <?php
                        foreach($resultados as $resultado)
                        {
                    ?>
                            <div class="swiper-slide" data-slide-bg="admin/archivos/<?= $resultado->archivo ?>" style="background-position: 80% center">
                                <div class="swiper-slide-caption section-70">
                                    <div class="container">
                                        <div class="range range-xs-center">
                                            <div class="cell-md-9 cell-xs-10">
                                                <div data-caption-animate="fadeInUp" data-caption-delay="100">
                                                    <h1 class="text-bold"><?= $resultado->nombre ?></h1>
                                                </div>
                                                <div class="offset-top-20 offset-xs-top-40 offset-xl-top-15" data-caption-animate="fadeInUp" data-caption-delay="150">
                                                    <h6 class=""><?= $resultado->subtitulo ?></h6>
                                                </div>

                                                <?php
                                                if($resultado->enlace != "" && $resultado->enlace != "#")
                                                {
                                                ?>
                                                    <div class="offset-top-20 offset-xl-top-30" data-caption-animate="fadeInUp" data-caption-delay="400">
                                                        <div class="group-xl group-middle">
                                                            <a class="btn btn-primary" href="<?= $resultado->enlace ?>">Saber más</a>
                                                        </div>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                            }
                    ?>
                </div>

                <div class="swiper-button-prev fa-arrow-left"></div>
                <div class="swiper-button-next fa-arrow-right"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <?php
    }

    if($datosEmpresa['sobre_nosotros'] != '')
    {
        ?>
            <section class="section novi-background bg-cover section-70 section-md-114 bg-default">
                <div class="shell">
                    <div class="range range-50">
                        <div class="cell-sm-4 cell-sm-push-2 text-sm-left">
                            <div class="inset-sm-left-50">
                                <img class="img-responsive reveal-inline-block img-rounded" src="images/users/user-christopher-smith-340x300.jpg" alt="" width="340" height="300">
                            </div>
                        </div>
                        <div class="cell-sm-8 cell-sm-push-1 text-sm-left">
                            <h2 class="text-bold">Sobre Nosotros</h2>
                            <hr class="divider bg-madison hr-sm-left-0">
                            <div class="offset-top-30 offset-sm-top-30">
                                <p>
                                    <?= $datosEmpresa['sobre_nosotros'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }

    $totalCategoriaServicio = $conexion->consultaregistro($querys->geConteotCategoriaServicio());
    if($totalCategoriaServicio != 0)
    {
        $resultados = $conexion->obtenerlista($querys->getCategoriaServicio());
        ?>
            <section class="section context-dark section-image-aside section-image-aside-left">
                <div class="novi-background bg-cover section-70 section-md-114 bg-madison">
                    <div class="shell">
                        <div class="range range-xs-center range-sm-right offset-top-0">
                            <div class="cell-xs-10 cell-sm-7 text-sm-left">
                                <div class="section-image-aside-img bg-cover veil reveal-sm-block" style="background-image: url(images/home-10-846x1002.jpg)"></div>
                                <div class="section-image-aside-body inset-sm-left-70 inset-lg-left-110">
                                    <h2 class="text-bold">Nuestros Servicios</h2>
                                    <hr class="divider hr-sm-left-0 bg-white">
                                    <div class="offset-top-30 offset-md-top-30 text-light">Nuestros servicios se seleccionan mediante un proceso riguroso y se crean exclusivamente para cada semestre.</div>
                                    <div class="text-left post-vacation-wrap offset-top-30">
                                        <?php
                                            foreach($resultados as $resultado)
                                            {
                                        ?>
                                                <article class="post-vacation">
                                                    <a class="post-vacation-img-wrap bg-cover bg-image" href="course-details.html" style="background-image: url(admin/archivos/<?= $resultado->archivo ?>)"></a>
                                                    <div class="post-vacation-body">
                                                        <div>
                                                            <h6 class="post-vacation-title">
                                                                <a href="course-details.html"><?= $resultado->nombre ?></a>
                                                            </h6>
                                                        </div>
                                                        <div class="offset-lg-top-10">
                                                            <p><?= $resultado->descripcion ?></p>
                                                        </div>
                                                    </div>
                                                </article>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section novi-background bg-cover section-70 section-md-114 bg-default">
                <div class="shell">
                    <h2 class="text-bold">Estadísticas</h2>
                    <hr class="divider bg-madison">
                    <div class="range range-65 range-xs-center range-md-left offset-top-55 counters">
                        <?php
                            $resultados = $conexion->obtenerlista($querys->getCategoriaServicio2());
                            foreach($resultados as $resultado)
                            {
                                $totalServicios = $conexion->consultaregistro($querys->getConteoServicio($resultado->id_categoria_servicio));
                        ?>
                                <div class="cell-sm-6 cell-md-3">
                                    <div class="counter-type-1"><span class="icon novi-icon icon-lg icon-outlined text-madison mdi mdi-wallet-travel"></span>
                                        <div class="h3 text-bold text-primary offset-top-15">
                                            <span class="counter"><?= $totalServicios ?></span>
                                        </div>
                                        <hr class="divider bg-gray-light divider-sm">
                                        <div class="offset-top-10">
                                            <h6 class="text-black font-accent"><?= $resultado->nombre ?></h6>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </section>
        <?php
    }

    $totalBlog = $conexion->consultaregistro($querys->geConteotBlog());
    if($totalBlog != 0)
    {
        ?>
            <section class="section novi-background bg-cover section-70 section-md-114 bg-catskill">
                <div class="shell isotope-wrap">
                    <h2 class="text-bold">Blog</h2>
                    <hr class="divider bg-madison">
        
                    <div class="row range-30 isotope offset-top-50 text-left">
                        <?php
                            $resultados = $conexion->obtenerlista($querys->getBlog());
                            foreach($resultados as $resultado)
                            {
                                    $originalDate = $resultado->fecha;
                                    $fecha = date("d/m/Y", strtotime($originalDate));
                                ?>
                                    <div class="col-xs-12 col-sm-6 col-md-4 isotope-item">
                                        <article class="post-news">
                                            <a href="news-post-page.html">
                                                <img class="img-responsive" src="admin/archivos/<?= $resultado->portada_imagen ?>" alt="<?= $resultado->titulo ?>" style="width: 370px; height: 240px; object-fit: cover;">
                                            </a>
                                            <div class="post-news-body">
                                                <h6>
                                                    <a href="news-post-page.html"><?= $resultado->titulo ?></a>
                                                </h6>
                                                <div class="offset-top-20">
                                                    <p><?= $resultado->nombre_autor ?></p>
                                                </div>
                                                <div class="post-news-meta offset-top-20">
                                                    <span class="icon novi-icon icon-xs mdi mdi-calendar-clock text-middle text-madison"></span>
                                                    <span class="text-middle inset-left-10 text-italic text-black"><?= $fecha ?></span>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="offset-top-50"><a class="btn btn-primary" href="grid-news.html">Ver más</a></div>
                </div>
            </section>
        <?php
    }
?>

<?php include("includes/footer.php"); ?>

<?php include("includes/plantilla_fin.php"); ?>
