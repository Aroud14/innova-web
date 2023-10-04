<div class="cell-xs-8 cell-md-4 text-left">
    <aside class="aside inset-md-left-30">
        <div class="aside-item">
            <h6 class="text-bold">Buscar por titulo</h6>
            <div class="text-subline"></div>
            <div class="offset-top-30">
                <form class="form-search rd-search form-search-widget" id="filtro_titulo" action=""> 
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-search-input  form-control" type="text" id="titulo" name="titulo" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <span class="icon fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="aside-item" id="filtro-año">
            <h6 class="text-bold">Buscar por año</h6>
            <div class="text-subline"></div>

            <?php
                $elementos = $conexion->obtenerlista($querys->getblogfiltrosporanio());
    
                $num_elementos = count($elementos);
                $mitad = floor($num_elementos / 2);

                if ($num_elementos % 2 == 0) {
                    $primera_mitad = array_slice($elementos, 0, $mitad);
                    $segunda_mitad = array_slice($elementos, $mitad);
                } else {
                    $primera_mitad = array_slice($elementos, 0, $mitad + 1);
                    $segunda_mitad = array_slice($elementos, $mitad + 1);
                }
            ?>
            
            <div class="row offset-top-20">
                <?php if(count($primera_mitad) > 0): ?>
                    <div class="col-xs-6">
                        <ul class="list list-marked list-marked-primary">
                            <?php foreach($primera_mitad as $elemento): ?>
                                <li data-anio-creacion="<?= $elemento->anio ?>"><a href="#"><?= $elemento->anio ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if(count($segunda_mitad)): ?>
                    <div class="col-xs-6">
                        <ul class="list list-marked list-marked-primary">
                            <?php foreach($segunda_mitad as $elemento): ?>
                                <li data-anio-creacion="<?= $elemento->anio ?>"><a href="#"><?= $elemento->anio ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="aside-item">
            <h6 class="text-bold">Categorías</h6>
            <div class="text-subline"></div>
            <div class="offset-top-20">
                <ul class="list list-marked list-marked-primary" id="filtro-categorias">
                    <?php
                        $categorias = $conexion->obtenerlista($querys->getlistacategorias());
                    ?>
                    <?php foreach($categorias as $categoria): ?>                    
                        <li data-id="<?= $categoria->id_categoria_blog?>"><a href="#"><?=$categoria->nombre?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </aside>
</div>

<script>
    window.onload = () => {
        $('#filtro-categorias > li').on('click', function(){
            let id_categoria = $(this).data('id');
            blogs({ id_categoria }, {
                success: () => {

                }
            })
            
        });
        
        $("#filtro_titulo").submit(function(e){
            e.preventDefault();
            let titulo = $(this).find('#titulo').val();
            blogs({ titulo }, {
                success: () => {

                }
            })
        });
        
        $('#filtro-año li').on('click', function(){
            let anio_creacion = $(this).data('anio-creacion');
            blogs({ anio_creacion }, {
                success: () => {

                }
            })
            
        });
        
        const blogs = (filters, { success = () => true }) => {

            $.ajax({
                type: "POST",
                url: 'includes/blog/blogs.php',
                data: filters,
                success: (html) => {
                    let contenedor = $('#blog').find('#contenedor');
                    contenedor.html(html);
                    success();
                }
            });
        }
    }
</script>