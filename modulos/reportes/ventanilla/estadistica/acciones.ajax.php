<?php
require('../../../../config/class.Conexion.php');
require('../../../../config/funciones.php');
require_once("../../../clases/seguridad/class.SeguridadUsuario.php");
require_once '../../../clases/reportes/radica/class.ReportRadicacionRecibido.php';

		$TotalFinal = array();
		$Label = array();
		$Total = ReportRadicacionRecibido::Listar(1, '2018-01-01', '2018-03-31');

		$i=0;
		foreach($Total as $Item){
			echo $Item['nom_depen']."<br>";
			$TotalFinal[] = $Item;
		}

		echo json_encode($TotalFinal);
	
?>