<?php include("includes/plantilla_inicio.php"); ?>

<?php include("includes/header.php"); ?>

<?php
    $resultados = $conexion->obtenerlista($querys->getSliders());
?>


    <section class="section">
        <div class="swiper-container swiper-slider swiper-slider-modern swiper-slider-2" data-loop="true" data-dragable="false" data-slide-effect="fade">
            <div class="swiper-wrapper">
                <?php
                    foreach($resultados as $resultado)
                    {
                ?>
                            <div class="swiper-slide" data-slide-bg="<?= $resultado->archivo ?>" style="background-position: 80% center">
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




<?php include("includes/footer.php"); ?>

<?php include("includes/plantilla_fin.php"); ?>
