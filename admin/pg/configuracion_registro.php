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



        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="lema">Lema de la empresa</label>
                <input
                        class="form-control"
                        name="lema"
                        placeholder="lema"
                        type="text" value="<?php if(isset($id) && isset($datos['lema'])) echo $datos['lema'];?>"
                >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="mision">Mision de la empresa</label>
                <input
                        class="form-control"
                        name="mision"
                        placeholder="mision"
                        type="text" value="<?php if(isset($id) && isset($datos['mision'])) echo $datos['mision'];?>"
                >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="vision">Vision de la empresa</label>
                <input
                        class="form-control"
                        name="vision"
                        placeholder="vision"
                        type="text" value="<?php if(isset($id) && isset($datos['vision'])) echo $datos['vision'];?>"
                >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="facebook">Facebook</label>
                <input
                        class="form-control"
                        name="facebook"
                        placeholder="facebook/user"
                        type="text" value="<?php if(isset($id) && isset($datos['facebook'])) echo $datos['facebook'];?>"
                >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="instagram">Instagram</label>
                <input
                        class="form-control"
                        name="instagram"
                        placeholder="instagram"
                        type="text" value="<?php if(isset($id) && isset($datos['instagram'])) echo $datos['instagram'];?>"
                >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="horario_dia">Dias Labororables</label>
                <input
                        class="form-control"
                        name="horario_dia"
                        placeholder="ex. dia a dia"
                        type="text" value="<?php if(isset($id) && isset($datos['horario_dias_info'])) echo $datos['horario_dias_info'];?>"
                >
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="horario_hora">Horario Labororable</label>
                <input
                        class="form-control"
                        name="horario_hora"
                        placeholder="ex. 8:00am - 5:00pm"
                        type="text" value="<?php if(isset($id) && isset($datos['horario_horas_info'])) echo $datos['horario_horas_info'];?>"
                >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="host">Dominino</label>
                <input
                        class="form-control"
                        name="host"
                        placeholder="www.dominio.com"
                        type="text" value="<?php if(isset($id) && isset($datos['host'])) echo $datos['host'];?>"
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

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="valores">Valores de la empresa</label>
                <textarea
                        class="form-control"
                        name="valores"
                        placeholder="Nuestros valores"
                        type="text"
                ><?php if(isset($id) && isset($datos['valores'])) echo $datos['valores'];?></textarea>
            </div>
        </div>




        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="aviso_privacidad">Aviso de privacidad</label>
                    <textarea  
                        class="form-control"
                        name="aviso_privacidad"
                        placeholder="Aviso de privacidad"
                        type="text"
                ><?php if(isset($id) && isset($datos['aviso_privacidad'])) echo $datos['aviso_privacidad'];?></textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="termino_condicion">Términos y condiciones</label>
                    <textarea  
                        class="form-control"
                        name="termino_condicion"
                        placeholder="Términos y condiciones"
                        type="text"
                ><?php if(isset($id) && isset($datos['termino_condicion'])) echo $datos['termino_condicion'];?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="sobre_nosotros">Sobre Nosotros</label>
                <textarea
                        class="form-control"
                        name="sobre_nosotros"
                        placeholder="sobre_nosotros"
                        type="text"
                ><?php if(isset($id) && isset($datos['sobre_nosotros'])) echo $datos['sobre_nosotros'];?></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Logo Principal</h5>
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
            <div class="form-group">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Logo Pie de Pagina</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="logoF" id="logoF">
                        <?php
                        if(isset($datos['logo2']) && $datos['logo2'] != "") {
                            echo '<br><br><br>';
                            echo '<div align="center"><img src="archivos/configuracion/imagenes/'.$datos['logo2'].'" width="500px"></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-12"> 
            <div class="text-right">
                <input type="hidden" name="logo2" value="<?php if(isset($datos['logo']) && $datos['logo'] != "") echo $datos['logo'] ?>" />
                <input type="hidden" name="logoF2" value="<?php if(isset($datos['logo2']) && $datos['logo2'] != "") echo $datos['logo2'] ?>" />
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
