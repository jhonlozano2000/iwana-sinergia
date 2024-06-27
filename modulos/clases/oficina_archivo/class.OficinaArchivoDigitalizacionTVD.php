<?php
class DigitalizacionTVD{
	private $Accion;
	private $IdDigital;
	private $IdDependencia;
	private $IdOficina;
	private $IdSerie;
	private $IdSubSerie;
	private $Codigo;
	private $Titulo;
	private $FechaInicio;
	private $FechaFin;
	private $Criterio1;
	private $Criterio2;
	private $Criterio3;
	private $Deposito;
	private $Caja;
	private $Carpeta;
	private $Folios;
	private $Acti;

	public function __construct($Accion = null, $IdDigital = null, $IdDependencia = null, $IdOficina = null, $IdSerie = null, $IdSubSerie = null, $Codigo = null,
								$Titulo = null, $FechaInicio = null, $FechaFin = null, $Criterio1 = null, $Criterio2 = null, $Criterio3 = null, $Deposito = null,
								$Caja = null, $Carpeta = null, $Folios = null, $Acti = null){

		$this -> Accion        = $Accion;
		$this -> IdDigital     = $IdDigital;
		$this -> IdDependencia = $IdDependencia;
		$this -> IdOficina     = $IdOficina;
		$this -> IdSerie       = $IdSerie;
		$this -> IdSubSerie    = $IdSubSerie;
		$this -> Codigo        = $Codigo;
		$this -> Titulo        = $Titulo;
		$this -> FechaInicio   = $FechaInicio;
		$this -> FechaFin      = $FechaFin;
		$this -> Criterio1     = $Criterio1;
		$this -> Criterio2     = $Criterio2;
		$this -> Criterio3     = $Criterio3;
		$this -> Deposito      = $Deposito;
		$this -> Caja          = $Caja;
		$this -> Carpeta       = $Carpeta;
		$this -> Folios        = $Folios;
		$this -> Acti          = $Acti;
	}

	public function get_IdDigital(){
		return $this -> IdDigital;
	}

	public function get_IdDependencia(){
		return $this -> IdDependencia;
	}

	public function get_IdOficina(){
		return $this -> IdOficina;
	}

	public function get_IdSerie(){
		return $this -> IdSerie;
	}

	public function get_IdSubSerie(){
		return $this -> IdSubSerie;
	}

	public function get_Codigo(){
		return $this -> IdForma;
	}

	public function get_Titulo(){
		return $this -> Titulo;
	}

	public function get_FechaInicio(){
		return $this -> FechaInicio;
	}

	public function get_FechaFin(){
		return $this -> FechaFin;
	}

	public function get_Criterio1(){
		return $this -> Criterio1;
	}

	public function get_Criterio2(){
		return $this -> Criterio2;
	}

	public function get_Criterio3(){
		return $this -> Criterio3;
	}

	public function get_Deposito(){
		return $this -> Deposito;
	}

	public function get_Caja(){
		return $this -> Caja;
	}

	public function get_Carpeta(){
		return $this -> Carpeta;
	}

	public function get_Folios(){
		return $this -> Folios;
	}

	public function get_Acti(){
		return $this -> Acti;
	}



	public function set_Accion($Accion) {
		return $this -> Accion = $Accion;
	}

	public function set_IdDigital($IdDigital) {
		return $this -> IdDigital = $IdDigital;
	}

	public function set_IdDependencia($IdDependencia) {
		return $this -> IdDependencia = $IdDependencia;
	}

	public function set_IdOficina($IdOficina){
		return $this -> IdOficina = $IdOficina;
	}

	public function set_IdSerie($IdSerie) {
		return $this -> IdSerie = $IdSerie;
	}

	public function set_IdSubSerie($IdSubSerie) {
		return $this -> IdSubSerie = $IdSubSerie;
	}

	public function set_Codigo($Codigo) {
		return $this -> Codigo = $Codigo;
	}

	public function set_Titulo($Titulo) {
		return $this -> Titulo = $Titulo;
	}

	public function set_FechaInicio($FechaInicio) {
		return $this -> FechaInicio = $FechaInicio;
	}

	public function set_FechaFin($FechaFin) {
		return $this -> FechaFin = $FechaFin;
	}

	public function set_Criterio1($Criterio1) {
		return $this -> Criterio1 = $Criterio1;
	}

	public function set_Criterio2($Criterio2) {
		return $this -> Criterio2 = $Criterio2;
	}

	public function set_Criterio3($Criterio3) {
		return $this -> Criterio3 = $Criterio3;
	}

	public function set_Deposito($Deposito) {
		return $this -> Deposito = $Deposito;
	}

	public function set_Caja($Caja) {
		return $this -> Caja = $Caja;
	}

	public function set_Carpeta($Carpeta) {
		return $this -> Carpeta = $Carpeta;
	}

	public function set_Folios($Folios) {
		return $this -> Folios = $Folios;
	}

	public function set_Acti($Acti) {
		return $this -> Acti = $Acti;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		$ParameIfOficina = PDO::PARAM_STR;
        if($this->IdOficina == NULL){
            $ParameIfOficina = PDO::PARAM_NULL;
        }


		try{
			if($this->Accion == 'NUEVO_EXPEDIENTE'){

				$Sql = "INSERT INTO archivo_digitales_tvd(id_depen, id_oficina, id_serie, id_subserie, codigo, titulo, fec_ini, fec_fin, Criterio1, Criterio2,
							Criterio3, Deposito, Caja, carpeta, folios)
						VALUES(:id_depen, :id_oficina, :id_serie, :id_subserie, :codigo, :titulo, :fec_ini, :fec_fin, :Criterio1, :Criterio2,
							:Criterio3, :Deposito, :Caja, :carpeta, :folios)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $this->IdDependencia, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_oficina', $this->IdOficina, $ParameIfOficina);
				$Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
				$Instruc -> bindParam(':codigo', $this->Codigo, PDO::PARAM_STR);
				$Instruc -> bindParam(':titulo', $this->Titulo, PDO::PARAM_STR);
				$Instruc -> bindParam(':fec_ini', $this->FechaInicio, PDO::PARAM_STR);
				$Instruc -> bindParam(':fec_fin', $this->FechaFin, PDO::PARAM_STR);
				$Instruc -> bindParam(':Criterio1', $this->Criterio1, PDO::PARAM_STR);
				$Instruc -> bindParam(':Criterio2', $this->Criterio2, PDO::PARAM_STR);
				$Instruc -> bindParam(':Criterio3', $this->Criterio3, PDO::PARAM_STR);
				$Instruc -> bindParam(':Deposito', $this->Deposito, PDO::PARAM_STR);
				$Instruc -> bindParam(':Caja', $this->Caja, PDO::PARAM_STR);
				$Instruc -> bindParam(':carpeta', $this->Carpeta, PDO::PARAM_STR);
				$Instruc -> bindParam(':folios', $this->Folios, PDO::PARAM_STR);

			}if($this->Accion == 'EDITAR_EXPEDIENTE'){
				$Sql = "UPDATE archivo_digitales_tvd SET codigo = :codigo, titulo = :titulo, fec_ini = :fec_ini, fec_fin = :fec_fin,
							criterio1 = :criterio1, criterio2 = :criterio2, criterio3 = :criterio3
						WHERE id_digital = :id_digital";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':codigo', $this->Codigo, PDO::PARAM_STR);
				$Instruc -> bindParam(':titulo', $this->Titulo, PDO::PARAM_STR);
				$Instruc -> bindParam(':fec_ini', $this->FechaInicio, PDO::PARAM_STR);
				$Instruc -> bindParam(':fec_fin', $this->FechaFin, PDO::PARAM_STR);
				$Instruc -> bindParam(':criterio1', $this->Criterio1, PDO::PARAM_STR);
				$Instruc -> bindParam(':criterio2', $this->Criterio2, PDO::PARAM_STR);
				$Instruc -> bindParam(':criterio3', $this->Criterio3, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_digital', $this->IdDigital, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdDigital = $conexion -> lastInsertId();
			$conexion = null;

			if($Instruc){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta Digitalizacion - '.$this->Accion.". ".$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdDigital, $IdDepen, $IdSerie, $IdSubSerie, $Codigo, $Titulo, $Criterio1, $Criterio2, $Criterio3){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/*********************************************************************************************
				* LISTO LOS EXPEDIENTE
				*********************************************************************************************/
				$Sql = "SELECT `digi`.`id_digital`, `serie`.`id_serie`, `serie`.`nom_serie`, `subserie`.`id_subserie`, `subserie`.`nom_subserie`, `depen`.`id_depen`, 
							`depen`.`nom_depen`, `ofi`.`id_oficina`, `ofi`.`nom_oficina`, `digi`.`codigo`, `digi`.`titulo`, `digi`.`fec_ini`, `digi`.`fec_fin`, 
							`digi`.`criterio1`, `digi`.`criterio2`, `digi`.`criterio3`, `digi`.`deposito`, `digi`.`caja`, `digi`.`carpeta`, `digi`.`folios`, `digi`.`acti`
						FROM `archivo_digitales_tvd` AS `digi`
						    INNER JOIN `archivo_tvd_dependencias` AS `depen` ON (`digi`.`id_depen` = `depen`.`id_depen`)
						    LEFT JOIN `archivo_tvd_oficinas` AS `ofi` ON (`digi`.`id_oficina` = `ofi`.`id_oficina`)
						    INNER JOIN `archivo_tvd_series` AS `serie` ON (`digi`.`id_serie` = `serie`.`id_serie`)
						    INNER JOIN `archivo_tvd_subserie` AS `subserie` ON (`digi`.`id_subserie` = `subserie`.`id_subserie`)
						WHERE digi.codigo LIKE ? OR digi.titulo LIKE ?";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute(array('%'.$Criterio1.'%', '%'.$Criterio1.'%')) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				#*********************************************************************************************
				# LISTO LOS EXPEDIENTES DE UNA SERIE Y SUBSERIE
				#*********************************************************************************************
				$Sql = "SELECT `id_digital`, `codigo`, `titulo`
						FROM `archivo_digitales_tvd` AS `expe`
						WHERE `id_depen` = :id_depen AND `id_serie` = :id_serie AND `id_subserie` = :id_subserie";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));

			}elseif($Accion == 3){
				#*********************************************************************************************
				# LISTO EL DETALLE DE UN EXPEDIENTES
				#*********************************************************************************************
				$Sql = "SELECT * FROM archivo_digitales_tvd_detalle WHERE `id_digital` = :id_digital";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdDigital, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				$Sql = "SELECT `digi`.`id_digital`, `digi`.`id_oficina`, `digi`.`codigo`, `digi`.`titulo`, `digi_deta`.`archivo`, `digi_deta`.`id_ruta`,
							`digi_deta`.`fec_registro`
						FROM `archivo_digitales_tvd_detalle` AS `digi_deta`
						    INNER JOIN `archivo_digitales_tvd` AS `digi` ON (`digi_deta`.`id_digital` = `digi`.`id_digital`)
						WHERE (`digi_deta`.`fec_registro` BETWEEN :Criterio1 AND :Criterio2)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':Criterio1', $Criterio1, PDO::PARAM_STR);
				$Instruc -> bindParam(':Criterio2', $Criterio2, PDO::PARAM_INT);
			}elseif($Accion == 5){
				/*********************************************************************************************
				* LISTO LOS EXPEDIENTE
				*********************************************************************************************/
				$Parametros = array();
				$i = 0;
				$Sql = "SELECT `digital`.`id_digital`, `depen`.`nom_depen`, `serie`.`cod_serie`, `serie`.`nom_serie`, `subserie`.`cod_subserie`,
							`subserie`.`nom_subserie`, `digital`.`codigo`, `digital`.`titulo`, `digital`.`fec_ini`, `digital`.`fec_fin`, `digital`.`criterio1`,
							`digital`.`criterio2`, `digital`.`criterio3`, `digital`.`deposito`, `digital`.`caja`, `digital`.`carpeta`, `digital`.`folios`
						FROM `archivo_digitales_tvd` AS `digital`
						    INNER JOIN `archivo_tvd_series` AS `serie` ON (`digital`.`id_serie` = `serie`.`id_serie`)
						    INNER JOIN `archivo_tvd_subserie` AS `subserie` ON (`digital`.`id_subserie` = `subserie`.`id_subserie`)
						    INNER JOIN `archivo_tvd_dependencias` AS `depen` ON (`digital`.`id_depen` = `depen`.`id_depen`)
						";

				if($IdDepen != 0){
					$Sql.= "`depen`.`id_depen` = ?";
					$Parametros[$i++] = $IdDepen;
				}

				if($IdSerie != 0){
					if($i == 0){
						$Sql.= "WHERE `serie`.`id_serie` = ?";
					}else{
						$Sql.= " AND `serie`.`id_serie` = ?";
					}
					$Parametros[$i++] = $IdSerie;
				}

				if($IdSubSerie != 0){
					if($i == 0){
						$Sql.= "WHERE `subserie`.`id_subserie` = ?";
					}else{
						$Sql.= " AND `subserie`.`id_subserie` = ?";
					}
					$Parametros[$i++] = $IdSubSerie;
				}

				if($Codigo != ""){
					if($i == 0){
						$Sql.= "WHERE `digital`.`codigo` LIKE ?";
					}else{
						$Sql.= " AND `digital`.`codigo` LIKE ?";
					}
					$Parametros[$i++] = "'%".$IdSubSerie."%'";
				}

				if($Titulo != ""){
					if($i == 0){
						$Sql.= "WHERE `digital`.`titulo` LIKE ?";
					}else{
						$Sql.= " AND `digital`.`titulo` LIKE ?";
					}
					$Parametros[$i++] = "'%".$Titulo."%'";
				}

				if($Criterio1 != ""){
					if($i == 0){
						$Sql.= "WHERE `digital`.`criterio1` LIKE ?";
					}else{
						$Sql.= " AND `digital`.`criterio1` LIKE ?";
					}
					$Parametros[$i++] = "'%".$Criterio1."%'";
				}

				if($Criterio2 != ""){
					if($i == 0){
						$Sql.= "WHERE `digital`.`criterio2` LIKE ?";
					}else{
						$Sql.= " AND `digital`.`criterio2` LIKE ?";
					}
					$Parametros[$i++] = "'%".$Criterio2."%'";
				}

				if($Criterio3 != ""){
					if($i == 0){
						$Sql.= "WHERE `digital`.`criterio3` LIKE ?";
					}else{
						$Sql.= " AND `digital`.`criterio3` LIKE ?";
					}
					$Parametros[$i++] = "'%".$Criterio3."%'";
				}

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute($Parametros) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			}elseif($Accion == 6){
				/*********************************************************************************************
				* LISTO LOS EXPEDIENTE
				*********************************************************************************************/
				$Sql = "SELECT `digital`.`id_digital`, `depen`.`nom_depen`, `serie`.`cod_serie`, `serie`.`nom_serie`, `subserie`.`cod_subserie`,
							`subserie`.`nom_subserie`, `digital`.`codigo`, `digital`.`titulo`, `digital`.`fec_ini`, `digital`.`fec_fin`, `digital`.`criterio1`,
							`digital`.`criterio2`, `digital`.`criterio3`, `digital`.`deposito`, `digital`.`caja`, `digital`.`carpeta`, `digital`.`folios`
						FROM `archivo_digitales_tvd` AS `digital`
						    INNER JOIN `archivo_tvd_series` AS `serie` ON (`digital`.`id_serie` = `serie`.`id_serie`)
						    INNER JOIN `archivo_tvd_subserie` AS `subserie` ON (`digital`.`id_subserie` = `subserie`.`id_subserie`)
						    INNER JOIN `archivo_tvd_dependencias` AS `depen` ON (`digital`.`id_depen` = `depen`.`id_depen`)
						ORDER BY `digital`.`id_digital` DESC
						LIMIT 0,5";
				$Instruc = $conexion->prepare($Sql);
			}elseif($Accion == 7){
				#*********************************************************************************************
				# LISTO UN EXPEDIENTES
				#*********************************************************************************************
				$Sql = "SELECT * FROM archivo_digitales_tvd WHERE `id_digital` = :id_digital";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdDigital, PDO::PARAM_INT);
			}elseif($Accion == 8){
				/******************************************************************************************/
	            /* LISTO EL TITULO DE LA UBICACION DEL EXPEDIENTE ESTO ES PARA MOSTRALO CUANDO SE
	            /* LISTAN LOS ARCHIVOS
	            /******************************************************************************************/
	            $Sql = "SELECT `expe`.`id_digital`, `expe`.`titulo`, `depen`.`cod_depen`, `depen`.`cod_corres`, `depen`.`nom_depen`, `serie`.`cod_serie`,
	            			`serie`.`nom_serie`, `subserie`.`cod_subserie`, `subserie`.`nom_subserie`
						FROM`archivo_digitales_tvd` AS `expe`
						    INNER JOIN `archivo_tvd_dependencias` AS `depen` ON (`expe`.`id_depen` = `depen`.`id_depen`)
						    INNER JOIN `archivo_tvd_series` AS `serie` ON (`expe`.`id_serie` = `serie`.`id_serie`)
						    INNER JOIN `archivo_tvd_subserie` AS `subserie` ON (`expe`.`id_subserie` = `subserie`.`id_subserie`)
						WHERE (`expe`.`id_digital` = :id_digital)";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdDigital, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdDigital, $IdDepen, $IdSerie, $IdSubSerie, $Codigo, $Titulo, $Criterio1, $Criterio2, $Criterio3) {
		$conexion = new Conexion();

		try{

			if($Accion == 2){
				$Sql = "SELECT * FROM archivo_digitales_tvd
						WHERE codigo = :codigo AND id_depen = :id_depen AND id_serie = :id_serie AND id_subserie = :id_subserie";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':codigo', $Codigo, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
			}elseif($Accion == 3){
				$Sql = "SELECT * FROM archivo_digitales_tvd WHERE id_digital = :id_digital";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdDigital, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_digital'], $Result['id_depen'], $Result['id_depen'], $Result['id_serie'], $Result['id_subserie'], $Result['codigo'],
								$Result['titulo'], $Result['fec_ini'], $Result['fec_fin'], $Result['criterio1'], $Result['criterio2'], $Result['criterio3'],
								$Result['deposito'],$Result['caja'], $Result['carpeta'], $Result['folios'], $Result['acti']);
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
}
?>