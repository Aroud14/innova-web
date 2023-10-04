
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="side-menu-title" style="color:#4f5467;font-size:14px; margin-top:5px; padding: 10px; "><b>Menu</b></li>
				<!--<li class="nav-small-cap m-t-10"> Menu</li>-->
				<?php 

				$obtener_menu_padre = $conexion->obtenerlista($querys->permisosmenuusuario($datos_sis['id_usuario']));
				foreach($obtener_menu_padre as $menu_padre){

					if($menu_padre->tipo == 1){

						$menu_padreicono_color = $menu_padre->color;
						if($menu_padre->archivo == NULL || $menu_padre->archivo == "#" || $menu_padre->archivo == ""){
							$menu_padre->archivo = '#';
							}

						$obtener_submenu = $conexion->obtenerlista($querys->permisosubmenuusuario($datos_sis['id_usuario'],$menu_padre->id_permiso));

						$num_arreglo = count($obtener_submenu);

						if($num_arreglo != 0){
							$carret = 'submenu';
							$padreactivo = $conexion->consultaregistro($querys->Conteopermisosubmenuusuariomodulo($datos_sis['id_usuario'], $menu_padre->id_permiso, $modulo));
							if($padreactivo == "") $padreactivo = 0;

						}else{
							$carret = '';
							$padreactivo = 0;
						}

						if($menu_padre->archivo == $modulo || $padreactivo != 0){
							$activo = 'active';
						}else {
							$activo = '';
						}

						if($num_arreglo != 0){
							echo '<li class="submenu">
									<a class="'.$activo.'" href="javascript:void(0);"><i class="fa '.$menu_padre->icono.'"></i> <span> '.$menu_padre->nombre.'  </span> <span class="menu-arrow"></span></a>
									<ul>';
								foreach($obtener_submenu as $menu_hijo){
									if ($menu_hijo->archivo == $modulo) {
										$activo2 = 'active';
									}else {
										$activo2 = '';
									}
									echo '<li><a class="'.$activo2.'" href="'.$menu_hijo->archivo.'" >'.$menu_hijo->nombre.'</a></li>';
								}
							echo '</ul>'; 
						}
						else{
							echo '<li>
									<a class="'.$activo.'" href="'.$menu_padre->archivo.'" ><i class="fa '.$menu_padre->icono.'"></i><span> '.$menu_padre->nombre.'</span> </a>
								</li>';
						}

					echo '</li>';		
						
						}
						else{
							echo '<li class="side-menu-title" style="color:#fff;font-size:14px; margin-top:5px; padding: 10px; background-color:'.$menu_padre->color.';"><b>'.$menu_padre->nombre.'</b></li>';
						}

					}

				?>

			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->
	    