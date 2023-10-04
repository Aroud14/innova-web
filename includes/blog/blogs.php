<?php
    require_once ("../../admin/php/clase_variables.php");
	require_once ("../../admin/php/clase_mysql.php");
	require_once ("../../admin/php/clase_funciones.php");
	require_once ('../../admin/php/clase_paginador.php');
	require_once ('../../php/clase_querys.php');

	$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	$querys    = new Querys();

    $id_categoria  = $funciones->limpia($_POST['id_categoria']  ?? 0);
    $titulo        = $funciones->limpia($_POST['titulo']        ?? '');
    $anio_creacion = $funciones->limpia($_POST['anio_creacion'] ?? '');

    $blogs         = $conexion->obtenerlista($querys->getlistablogs($id_categoria, $titulo, $anio_creacion));
?>

<?php
if(count($blogs) == 0):
    require_once '0-results.php';
    exit;
endif;
?>

<?php foreach ($blogs as $i => $blog) : ?>
    <div class="cell-sm-6">
        <article class="post-news">
            <a href="blog-detalles/<?=$blog->id_blog?>">
                <img class="img-responsive" src="<?= "admin/archivos/$blog->portada_imagen" ?>" width="370" height="240" alt="">
            </a>
            <div class="post-news-body">
                <h6><a href="blog-detalles/<?=$blog->id_blog?>"><?= $blog->titulo ?></a></h6>
                
                <div class="post-news-meta offset-top-20">
                    <span class="icon novi-icon icon-xs mdi mdi-calendar-clock text-middle text-madison"></span>
                    <span class="text-middle inset-left-10 text-italic text-black"><?= $blog->fecha_registro ?></span>
                </div>
            </div>
        </article>
    </div>
<?php endforeach; ?>