<?php 
    require "../php/inicializandoDatosExterno.php";
    $id = $funciones->limpia($_POST['id']);
    $datos = $conexion->fetch_array($querys->getConfiguracion());
?>

<form action="php/subir.php" enctype="multipart/form-data" method="post" id="enviar_formulario">
    <div class="row">                        

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="nombre">Nombre de la empresa</label>
                    <input  
                        class="form-control"
                        name="nombre"
                        placeholder="nombre"
                        type="text" value="<?php if(isset($id) && isset($datos['nombre_empresa'])) echo $datos['nombre_empresa'];?>"
                    >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="email">Correo</label>
                <input  
                    class="form-control"
                    name="email"
                    placeholder="Correo"
                    data-validation="[EMAIL]"
                    id="signup_v1-email"
                    type="text" value="<?php if(isset($id) && isset($datos['correo'])) echo $datos['correo'];?>"
                >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="telefono">Teléfono</label>
                <input  
                    class="form-control"
                    name="telefono"
                    id="mask-telefono"
                    placeholder="Número de Teléfono"
                    type="text" value="<?php if(isset($id) && isset($datos['telefono'])) echo $datos['telefono'];?>"
                >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="whatsapp">WhatsApp</label>
                <input  
                    class="form-control"
                    name="whatsapp"
                    id="mask-telefono"
                    placeholder="Número de WhatsApp"
                    type="text" value="<?php if(isset($id) && isset($datos['whatsapp'])) echo $datos['whatsapp'];?>"
                >
            </div>
        </div>


        <div class="col-md-8">
            <div class="form-group">
                <label class="form-label" for="direccion">Dirección</label>
                    <input  
                        class="form-control"
                        name="direccion"
                        placeholder="Dirección"
                        type="text" value="<?php if(isset($id) && isset($datos['direccion'])) echo $datos['direccion'];?>"
                    >
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="dominio">Dominio</label>
                    <input  
                        class="form-control"
                        name="dominio"
                        placeholder="Ejemplo: http://localhost/plantilla_base_back/"
                        type="text" value="<?php if(isset($id) && isset($datos['dominio'])) echo $datos['dominio'];?>"
                    >
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="text1">Aviso de privacidad</label>
                <textarea class="env_editor" id="text1" name="text1"><?php  if(isset($id) && isset($datos['aviso_privacidad'])) echo htmlspecialchars($datos['aviso_privacidad']);?></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="text2">Términos y condiciones</label>
                <textarea class="env_editor" id="text2" name="text2"><?php if(isset($id) && isset($datos['termino_condicion'])) echo htmlspecialchars($datos['termino_condicion']);?></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Logo</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="logo" id="logo">
                        <?php
                            if(isset($datos['logo']) && $datos['logo'] != "") {
                                echo '<br><br><br>';
                                echo '<div align="center"><img src="archivos/configuracion/imagenes/'.$datos['logo'].'" width="500px"></div>';
                            }     
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="text-right">
                <input type="hidden" name="logo2" value="<?php if(isset($datos['logo']) && $datos['logo'] != "") echo $datos['logo'] ?>" />
                <input type="hidden" name="membrete2" value="<?php if(isset($datos['membrete']) && $datos['membrete'] != "") echo $datos['membrete'] ?>" />     
                <br>
                <?php 
                    echo '<input type="submit" id="btn_guardar" class="btn btn-primary btn-sm" value="Actualizar" /> <input type="hidden" name="opcion" value="6" />';
                ?>
                <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="registro_configuracion()"/>
            </div>
        </div>
    </div>
</form> 
