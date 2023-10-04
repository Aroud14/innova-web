<?php include("includes/plantilla_inicio.php"); ?>
<?php include("includes/header.php"); ?>

<main id="blog">
    <section class="section breadcrumb-modern context-dark parallax-container" data-parallax-img="images/parallax-03.jpg">
        <div class="parallax-content section-30 section-sm-70">
            <div class="shell">
                <h2 class="veil reveal-sm-block">Blog</h2>
                <div class="offset-sm-top-35">
                    <ul class="list-inline list-inline-lg list-inline-dashed p">
                        <li><a href="index.html">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div id="fb-root"></div>

    <section class="section novi-background bg-cover section-70 section-md-114 bg-catskill">
        <div class="shell">
            <div class="range range-85 range-xs-center">
                <div class="cell-md-8">
                    <div class="range range-30 text-sm-left range-xs-center" id="contenedor">
                        <?php
                            $blogs = $conexion->obtenerlista($querys->getlistablogs());
                        ?>

                        <?php foreach ($blogs as $i => $blog) : ?>
                            <div class="cell-sm-6">
                                <article class="post-news">
                                    <a href="news-post-page.html">
                                        <img class="img-responsive" src="<?= "admin/archivos/$blog->portada_imagen" ?>" width="370" height="240" alt="">
                                    </a>
                                    <div class="post-news-body">
                                        <h6><a href="news-post-page.html"><?= $blog->titulo ?></a></h6>
                                        <div class="offset-top-20">
                                            <p><?= $blog->contenido ?></p>
                                        </div>
                                        <div class="post-news-meta offset-top-20">
                                            <span class="icon novi-icon icon-xs mdi mdi-calendar-clock text-middle text-madison"></span>
                                            <span class="text-middle inset-left-10 text-italic text-black"> <?= $blog->fecha_registro ?> </span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php include_once 'includes/blog/asidemenu.php' ?>
            </div>
        </div>
    </section>
</main>

<?php include("includes/footer.php"); ?>
<?php include("includes/plantilla_fin.php"); ?>