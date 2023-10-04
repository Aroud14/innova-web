<script>
window.onload = function() {
    lista_mensajes_web();
}
</script>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Mensajes de la página web</h4>
    </div>
</div>

<div class="row" id="mostrar-busqueda">
    <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Búsqueda</h3>
            <form role="form" class="row" id="form_busqueda">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="correo" id="correo" placeholder="E-mail">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
                    </div>
                </div>

                <div class="col-md-2">
                    <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="lista_mensajes_web()" />
                    <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="location.href='mensajes_web'"/>
                </div>
                <input type="hidden" id="pagina" name="pagina" value="1" >
            </form>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div id="contenido" class="col-sm-12 col-md-12 col-xs-12"></div>
</div>