<?php
	require "../php/inicializandoDatosExterno.php"; 
	$tipos_prestamos = array();

	if($_POST['id']>0){
	    $id = $funciones->limpia($_POST['id']);
	    $datos = $conexion->fetch_array($querys->getUsuario($id));
	    ////checkes
	    $editar_chek = ($datos['editar'] >0) ? 'checked' : '';
    	$eliminar_chek = ($datos['eliminar'] >0) ? 'checked' : '';
		$cancelar_chek = ($datos['cancelar'] >0) ? 'checked' : '';
		$editar_validado_chek = ($datos['editar_validado'] >0) ? 'checked' : '';
	}
?>

<div class="card-body">

	<h5 class="card-title">Formulario de Registro</h5>
	<form action="php/subir.php" enctype="multipart/form-data" method="post" id="enviar_formulario">
		<div class="row">
				
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="nombre">Nombre completo</label>
					<input 
						required 
						class="form-control"
						name="nombre"
						placeholder="Nombre"
						type="text" value="<?php if(isset($id)) echo $datos['nombre'];?>"
					>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="tipo">Tipo de usuario</label>
					<select  class="form-control select2" name="tipo" id="tipo">
						<?php 
							if(isset($id))
								echo $funciones->getComboTipoUsuario($datos['tipo']);
							else
								echo $funciones->getComboTipoUsuario(1);
						?>								
					</select>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label class="form-label" for="estatus">Activo</label>
					<select  class="form-control" name="estatus" id="estatus">
						<?php 
							if(isset($id))
								echo $funciones->getComboEstatus($datos['estatus']);
							else
								echo $funciones->getComboEstatus(1);
						?>								
					</select>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label class="form-label" for="tiene_horario">¿Tiene horario?</label>
					<select  class="form-control" name="tiene_horario" id="tiene_horario">
						<?php 
							if(isset($id))
								echo $funciones->getComboEstatus($datos['tiene_horario']);
							else
								echo $funciones->getComboEstatus(1);
						?>								
					</select>
				</div>
			</div>

			<div style="clear:both;"></div>
			<h4>DATOS DE CONTACTO</h4>
			<hr>

			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="correo">Correo</label>
					<input 
						required 
						class="form-control"
						name="correo"
						placeholder="correo"
						type="email" value="<?php if(isset($id)) echo $datos['correo'];?>"
					>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="telefono">Teléfono</label>
					<input 
						required 
						class="form-control"
						name="telefono"
						placeholder="telefono"
						type="text" value="<?php if(isset($id)) echo $datos['telefono'];?>"
					>
				</div>
			</div>
	
			<div style="clear:both;"></div>

			<h4>DATOS DE ACCESO</h4>
			<hr>

			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="usuario">Usuario</label>
					<input required id="usuario"
								class="form-control"
								name="usuario"
								placeholder="Usuario"
								type="text" value="<?php if(isset($id)) echo $datos['usuario'];?>">
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="contrasena">Contraseña</label>
					<input id="contrasena"
								class="form-control"
								name="contrasena"
								placeholder="Contraseña" 
								type="password" >
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label" for="contrasena2">Repetir Contraseña</label>
					<input id="contrasena2"
								class="form-control"
								name="contrasena2"
								placeholder="Repetir Contraseña" 
								type="password">
				</div>
			</div>
			
			<div style="clear:both;"></div>
			<h4>HABILIDADES DEL USUARIO</h4>
			<hr>

			<div class="col-md-4">
				<div class="">
					<div class="checkbox">
						<label>
						<input type="checkbox" name="editar" id="editar" value="1" <?php if(isset($id)) echo $editar_chek; ?>/> Editar
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="eliminar" id="eliminar" value="1" <?php if(isset($id)) echo $eliminar_chek; ?>/> Eliminar
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="cancelar" id="cancelar" value="1" <?php if(isset($id)) echo $cancelar_chek; ?>/> Cancelar
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="editar_validado" id="editar_validado" value="1" <?php if(isset($id)) echo $editar_validado_chek; ?>/> Editar validado
						</label>
					</div>
				</div>
			</div>

			<div class="col-md-12">	
				<div class="text-right">			
					<br>
					<input type="hidden" name="id" value="<?php if(isset($id)) echo $datos['id_usuario'];?>" />
					<input type="hidden" name="usuario2" value="<?php if(isset($id)) echo $datos['usuario'];?>" />
					<?php 

					if(!isset($id)) echo '<input type="submit" id="btn_guardar" class="btn btn-success btn-sm" value="Guardar" />  <input type="hidden" name="opcion" value="3" />';
					else echo '<input type="submit" id="btn_guardar" class="btn btn-primary btn-sm" value="Actualizar" /> <input type="hidden" name="opcion" value="4" />';

					?>
					<input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="lista_usuario()"/>
				</div>
			</div>

		</div><!--.row-->
			
	</form>	 

</div>