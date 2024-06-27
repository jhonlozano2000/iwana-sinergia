<?php
include("config/variable.php");
	session_start();
	session_destroy();
	header('Location: '.MI_ROOT);
	exit(0);
?>