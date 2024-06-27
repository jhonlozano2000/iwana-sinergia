<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	session_start();
	require_once '../../config/class.Conexion.php';
	require_once '../../config/variable.php';
	require_once '../../config/funciones.php';
	require_once '../clases/chat/class.chat.php';

	$IdFuncioRecive = isset($_POST['id_usua_recive']) ? $_POST['id_usua_recive'] : null;

	$Conversaciones = chat::Listar(1, "", $_SESSION['SesionUsuaId'], "", $IdFuncioRecive, "");
	foreach($Conversaciones as $ItemConversacion){

		$ImagenCharRecive = "";
		$ImagenCharEnvia = "";

		if($ItemConversacion['origen'] == 'recive'){

			if($ItemConversacion['foto'] != ""){
				$ImagenCharRecive = $RutaMiServidor."/archivos/fotos_perfil/".$ItemConversacion['foto'];
			}else{
				if($ItemConversacion['genero'] == 'M'){
					$ImagenCharRecive = AVATAR_M;
				}else{
					$ImagenCharRecive = AVATAR_F;
				}
			}
			?>
			<!-- <div class="sent_time">Yesterday 121:25pm</div> -->
			<div class="user-details-wrapper">
				<div class="user-profile">
					<img src="<?php echo $ImagenCharRecive; ?>"  alt="" data-src="<?php echo $ImagenCharRecive; ?>" data-src-retina="<?php echo $ImagenCharRecive; ?>" width="35" height="35">
				</div>
				<div class="user-details">
					<div class="bubble">	
						<?php echo $ItemConversacion['texto']; ?>
					</div>
				</div>					
				<div class="clearfix"></div>
				
				<div class="sent_time off">Yesterday 11:25pm</div>
			</div>		
		<?php }else{

			if($ItemConversacion['foto'] != ""){
				$ImagenCharEnvia = $RutaMiServidor."/archivos/fotos_perfil/".$ItemConversacion['foto'];
			}else{
				if($ItemConversacion['genero'] == 'M'){
					$ImagenCharEnvia = AVATAR_M;
				}else{
					$ImagenCharEnvia = AVATAR_F;
				}
			}

			?>
			<!-- <div class="sent_time ">Today 11:25pm</div> -->

			<div class="user-details-wrapper pull-right">
				<div class="user-profile">
					
				</div>
				<div class="user-details">
					<div class="bubble sender">	
						<?php echo $ItemConversacion['texto']; ?>
					</div>
				</div>					
				<div class="clearfix"></div>
				<!-- <div class="sent_time off">Sent On Tue, 2:45pm</div> -->
			</div>	

			<?php
		}
	}
}
?>