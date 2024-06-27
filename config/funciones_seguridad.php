<?php
if(!isset($_SESSION['SesionUsuaId'])){
	header("Location: ".MI_ROOT."/index.php");
}
?>