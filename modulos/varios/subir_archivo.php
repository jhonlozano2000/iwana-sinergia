<?php
include("../../config/variable.php");

//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	if($_POST['Origen'] == "Entrada"){
		if(!is_dir(MI_ROOT_TEMP_RELATIVA."/recibidos/"))
			mkdir(MI_ROOT_TEMP_RELATIVA."/recibidos/", 0777);

		if(move_uploaded_file($_FILES['archivo']['tmp_name'], MI_ROOT_TEMP_RELATIVA."/recibidos/".$_POST['IdRadicado'].".pdf")){
			echo 1;
		}
	}elseif($_POST['Origen'] == "Salida"){

		if(!is_dir(MI_ROOT_TEMP_RELATIVA."/enviados/"))
			mkdir(MI_ROOT_TEMP_RELATIVA."/enviados/", 0777);

		if (move_uploaded_file($_FILES['archivo']['tmp_name'], MI_ROOT_TEMP_RELATIVA."/enviados/".$_POST['IdRadicado'].".pdf")){
			echo 1;
		}
	}else{
		echo "No se pudo";
	}

}
?>
