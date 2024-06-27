<?php
class Chat{
	private $Accion;
	private $IdChat;
	private $IdUsuaEnvia;
	private $FecHorEnvio;
	private $IdUsuaRecive;
	private $FecHorVisto;
	private $Texto;
	
	public function __construct($Accion = null, $IdChat= null, $IdUsuaEnvia = null, $FecHorEnvio = null ,$IdUsuaRecive = null , $FecHorVisto = null, $Texto = null){

		$this -> Accion       = $Accion;
		$this -> IdChat       = $IdChat;
		$this -> IdUsuaEnvia  = $IdUsuaEnvia;
		$this -> FecHorEnvio  = $FecHorEnvio;
		$this -> IdUsuaRecive = $IdUsuaRecive;
		$this -> FecHorVisto  = $FecHorVisto;
		$this -> Texto        = $Texto;
		
	}

	public function get_IdChat(){
		return $this -> IdChat;
	}

	public function get_IdUsuaEnvia(){
		return $this -> IdUsuaEnvia;
	}
	
	public function get_FecHorEnvio(){
		return $this -> FecHorEnvio;
	}
	
	public function get_IdUsuaRecive(){
		return $this -> IdUsuaRecive;
	}
	
	public function get_FecHorVisto(){
		return $this -> FecHorVisto;
	}

	public function getTexto(){
		return $this -> Texto;
	}
	
	public function setAccion($Accion){
		return $this -> Accion = $Accion;
	}
	
	public function set_IdChat($IdChat){
		return $this -> IdChat = $IdChat;
	}

	public function set_IdUsuaEnvia($IdUsuaEnvia){
		return $this -> IdUsuaEnvia = $IdUsuaEnvia;
	}
	
	public function set_FecHorEnvio($FecHorEnvio){
		return $this -> FecHorEnvio = $FecHorEnvio;
	}
	
	public function set_IdUsuaRecive($IdUsuaRecive){
		return $this -> IdUsuaRecive = $IdUsuaRecive;
	}

	public function set_FecHorVisto($FecHorVisto){
		$this -> FecHorVisto = $FecHorVisto;
	}

	public function setTexto($descripcion){
		$this-> Texto = $descripcion;
	}
	
	public function Gestionar(){
		$conexion = new Conexion();
		try{	
			if($this->Accion = "INSERTAR_MENSAJE"){
			
				$Sql = "INSERT INTO `chat`(`id_usua_envia`, `id_usua_recive`, `texto`)
						VALUES (:id_usua_envia, :id_usua_recive, :texto);";

				$Instruc = $conexion -> prepare($Sql);
				$Instruc -> bindParam(':id_usua_envia', $this->IdUsuaEnvia, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_usua_recive', $this->IdUsuaRecive, PDO::PARAM_INT);
				$Instruc -> bindParam(':texto', $this->Texto, PDO::PARAM_STR);
			}
				
			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdChat = $conexion -> lastInsertId();
			$conexion = null;
			
			if($Instruc){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta Insertar Chat, Acicon '.$this->Accion." - ".$e->getMessage();
			exit;
		}
		
	}

	public static function Listar($Accion, $IdChat, $IdUsuaEnvia, $FecHorEnvio, $IdUsuaRecive, $FecHorVisto){
		$conexion = new Conexion();

		try{
			/********************************************************************************************************************
			/* LOS FUNCIONARIOS PARA LISTAR UN CHAT
			/********************************************************************************************************************/
			if($Accion == 1){
				$Sql = "SELECT `chat`.`id_chat`, `chat`.`id_usua_envia`, `chat`.`fechor_envia`, `chat`.`id_usua_recive`, `chat`.`fechor_visto`, `chat`.`texto`, `funcio_envia`.`foto`, `funcio_envia`.`genero`, 'envia' AS 'origen'
						FROM `chat`
						    INNER JOIN `segu_usua` AS `usua` ON (`chat`.`id_usua_envia` = `usua`.`id_usua`)
						    INNER JOIN `gene_funcionarios` AS `funcio_envia` ON (`usua`.`id_funcio` = `funcio_envia`.`id_funcio`)
						WHERE (`chat`.`id_usua_envia` = :id_usua_envia)
						UNION
						SELECT `chat`.`id_chat`, `chat`.`id_usua_envia`, `chat`.`fechor_envia`, `chat`.`id_usua_recive`, `chat`.`fechor_visto`, `chat`.`texto`, `funcio_envia`.`foto`, `funcio_envia`.`genero`, 'recive' AS 'origen'
						FROM `chat`
						    INNER JOIN `segu_usua` AS `usua` ON (`chat`.`id_usua_envia` = `usua`.`id_usua`)
						    INNER JOIN `gene_funcionarios` AS `funcio_envia` ON (`usua`.`id_funcio` = `funcio_envia`.`id_funcio`)
						WHERE (`chat`.`id_usua_envia` = :id_usua_recive)
						ORDER BY fechor_envia";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_usua_envia', $IdUsuaEnvia, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_usua_recive', $IdUsuaRecive, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Result = $Instruc->fetchAll();
			}

			
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta listar Chat Accion: '.$Accion." - ".$e->getMessage();
			exit;
		}
	}
}
?>