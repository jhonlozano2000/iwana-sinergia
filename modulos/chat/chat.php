<div id="main-chat-wrapper" class="inner-content">
	<div class="chat-window-wrapper scroller scrollbar-dynamic" id="chat-users" >
		<div class="chat-header">	
			<div class="pull-left">
				<input type="text" placeholder="Buscar">
			</div>		
			<div class="pull-right">
				<a href="#" class="" ><div class="iconset top-settings-dark "></div> </a>
			</div>			
		</div>
		<noscript>
			<div class="side-widget">
				<div class="side-widget-title">group chats</div>
				<div class="side-widget-content">
					<div id="groups-list">
						<ul class="groups" >
							<li><a href="#"><div class="status-icon green"></div>Office work</a></li>
							<li><a href="#"><div class="status-icon green"></div>Personal vibes</a></li>
						</ul>
					</div>
				</div>
			</div>
		</noscript>
		<noscript>
		<div class="side-widget fadeIn">
			<div class="side-widget-title">Favoritos</div>
			<div id="favourites-list">
				<div class="side-widget-content" >
					<div class="user-details-wrapper active" data-chat-status="online" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="Jane Smith">
						<div class="user-profile">
							<img src="../../config/assets/img/profiles/d.jpg"  alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
						</div>
						<div class="user-details">
							<div class="user-name">
								Jane Smith
							</div>
							<div class="user-more">
								Hello you there?
							</div>
						</div>
						<div class="user-details-status-wrapper">
							<span class="badge badge-important">3</span>
						</div>
						<div class="user-details-count-wrapper">
							<div class="status-icon green"></div>
						</div>
						<div class="clearfix"></div>
					</div>	
				</div>
			</div>
		</div>
		</noscript>
		<div class="side-widget">
			<div class="side-widget-title">Mas Funcionarios</div>
			<div class="side-widget-content" id="friends-list">
			<input name="id_usua_recive" type="hidden" id="id_usua_recive">
				<?php
				/*
				session_start();
				require_once '../../config/class.Conexion.php';
				require_once '../../config/variable.php';
				require_once("../clases/seguridad/class.SeguridadUsuario.php");
				*/
			

				$CharUsuarios = Usuario::Listar(10, $_SESSION['SesionUsuaId'], "", "", "", "", "", "");
				foreach($CharUsuarios as $ItemChatUsuario){

					$ImagenFuncioPerfil = "";
					if($ItemChatUsuario['foto'] != ""){
						$ImagenFuncioPerfil = $RutaMiServidor."/archivos/fotos_perfil/".$_SESSION['SesionFuncioImagenPerfil'];
					}else{
						if($ItemChatUsuario['genero'] == 'M'){
			                $ImagenFuncioPerfil = AVATAR_M;
			            }else{
			                $ImagenFuncioPerfil = AVATAR_F;
			            }
					}
					
					?>
					<div class="user-details-wrapper" data-chat-status="online" data-chat-user-pic="<?php echo $ImagenFuncioPerfil; ?>" data-chat-user-pic-retina="<?php echo $ImagenFuncioPerfil; ?>" data-user-name="<?php echo $ItemChatUsuario['nom_funcio']; ?>" data-ruta_root="<?php echo $RutaMiServidor."/modulos/chat/"; ?>" data-id_usua_recive="<?php echo $ItemChatUsuario['id_usua']; ?>">
						<div class="user-profile">
							<img src="<?php echo $ImagenFuncioPerfil; ?>"  alt="" data-src="<?php echo $ImagenFuncioPerfil; ?>" data-src-retina="<?php echo $ImagenFuncioPerfil; ?>" width="35" height="35">
						</div>
						<div class="user-details">
							<div class="user-name">
								<?php echo $ItemChatUsuario['nom_funcio']; ?>
							</div>
							<div class="user-more">
								Hello you there?
							</div>
						</div>
						<div class="user-details-status-wrapper">

						</div>
						<div class="user-details-count-wrapper">
							<?php if($ItemChatUsuario['nom_funcio'] == 1){ ?>
								<div class="status-icon green"></div>
							<?php }else{ ?>
								<div class="status-icon red"></div>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php
				}
				?>
			</div>		
		</div>
	</div>

	<div class="chat-window-wrapper" id="messages-wrapper" style="display:none">
		<div class="chat-header">	
			<div class="pull-left">
				<input type="text" placeholder="search">
			</div>		
			<div class="pull-right">
				<a href="#" class="" ><div class="iconset top-settings-dark "></div> </a>
			</div>					
		</div>
		<div class="clearfix"></div>	
		<div class="chat-messages-header">
			<div class="status online"></div><span class="semi-bold">Jane Smith(Typing..)</span>
			<a href="#" class="chat-back"><i class="icon-custom-cross"></i></a>
		</div>
		<div class="chat-messages scrollbar-dynamic clearfix">
			<div class="inner-scroll-content clearfix">
				<div id="DivMostrearChar"></div>
			</div>
		</div>
		<div class="chat-input-wrapper" style="display:none">
			<textarea id="chat-message-input" rows="1" placeholder="Escribe tu mensaje" data-ruta_root="<?php echo $RutaMiServidor."/modulos/chat/"; ?>"></textarea>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script type="text/javascript" src="<?php echo $RutaMiServidor."/modulos/chat/" ?>funciones.ajax.js"></script>