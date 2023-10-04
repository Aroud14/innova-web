<?php
    require_once ("../../admin/php/clase_variables.php");
	require_once ("../../admin/php/clase_mysql.php");
	require_once ("../../admin/php/clase_funciones.php");
	require_once ('../../admin/php/clase_paginador.php');
	require_once ('../../php/clase_querys.php');

	$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	$querys    = new Querys();

    $id_categoria   = $funciones->limpia($_POST['id_categoria'] ?? 0);
    $titulo         = $funciones->limpia($_POST['titulo']       ?? '');
    $fecha_creacion = $funciones->limpia($_POST['creacion']     ?? '');
    $blogs          = $conexion->obtenerlista($querys->getlistablogs($id_categoria, $titulo, $fecha_creacion));
?>

<?php foreach ($blogs as $i => $blog) : ?>
    <div class="cell-sm-6">
        <article class="post-news">
            <a href="news-post-page.html">
                <img class="img-responsive" src="<?= "admin/archivos/$blog->portada_imagen" ?>" width="370" height="240" alt="">
            </a>
            <div class="post-news-body">
                <h6><a href="news-post-page.html"><?= $blog->titulo ?></a></h6>
                
                <div class="post-news-meta offset-top-20">
                    <span class="icon novi-icon icon-xs mdi mdi-calendar-clock text-middle text-madison"></span>
                    <span class="text-middle inset-left-10 text-italic text-black"><?= $blog->fecha_registro ?></span>
                </div>
            </div>
        </article>
    </div>
<?php endforeach; ?>