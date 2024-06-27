<?php
class OrigenCorrespondencia{
		
	public static function Listar($Accion, $Id, $Nom){
		$conexion = new Conexion();
		
		if($Accion == 1){
			$Sql = "SELECT * 
					FROM config_origen_correspondencia
					ORDER BY nom_origen";
		}

		$Instruc = $conexion->prepare($Sql);
		$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}
}
?>