<?php
class TerceroEmpresa{
	private $Accion;
	private $IdEmpresa;
	private $IdDepartamento;
	private $IdMunicipio;
	private $Nit;
	private $RazonSocial;
	private $Dir;
	private $Tel;
	private $Cel;
	private $Fax;
	private $Email;
	private $Web;
	
	public function __construct($Accion = null, $IdEmpresa = null, $IdDepartamento = null, $IdMunicipio = null, $Nit = null, 
								$RazonSocial = null,  $Dir = null, $Tel = null, $Cel = null, $Fax = null, $Email = null, $Web = null){

		$this -> Accion         = $Accion;
		$this -> IdEmpresa      = $IdEmpresa;
		$this -> IdDepartamento = $IdDepartamento;
		$this -> IdMunicipio    = $IdMunicipio;
		$this -> Nit            = $Nit;
		$this -> RazonSocial    = $RazonSocial;
		$this -> Dir            = $Dir;
		$this -> Tel            = $Tel;
		$this -> Cel            = $Cel;
		$this -> Fax            = $Fax;
		$this -> Email          = $Email;
		$this -> Web            = $Web;
	}

	public function getId_Empresa(){
		return $this -> IdEmpresa;
	}

	public function getId_Depar(){
		return $this -> IdDepartamento;
	}

	public function getId_Muni(){
		return $this -> IdMunicipio;
	}

	public function get_Nit(){
		return $this -> Nit;
	}

	public function get_RazonSocial(){
		return $this -> RazonSocial;
	}

	public function get_Dir(){
		return $this -> Dir;
	}

	public function get_Tel(){
		return $this -> Tel;
	}

	public function get_Cel(){
		return $this -> Cel;
	}

	public function get_Fax(){
		return $this -> Fax;
	}

	public function get_Email(){
		return $this -> Email;
	}

	public function get_Web(){
		return $this -> Web;
	}

	/////////////////////////////////////
	public function set_Accion($Accion){
		return $this -> Accion = $Accion;
	}

	public function setId_Empresa($IdEmpresa){
		return $this -> IdEmpresa = $IdEmpresa;
	}

	public function setId_Depar($IdDepartamento){
		return $this -> IdDepartamento = $IdDepartamento;
	}

	public function setId_Muni($IdMunicipio){
		return $this -> IdMunicipio = $IdMunicipio;
	}

	public function set_Nit($Nit){
		return $this -> Nit = $Nit;
	}

	public function set_RazonSocial($RazonSocial){
		return $this -> RazonSocial = $RazonSocial;
	}

	public function set_Dir($Dir){
		return $this -> Dir = $Dir;
	}

	public function set_Tel($Tel){
		return $this -> Tel = $Tel;
	}

	public function set_Cel($Cel){
		return $this -> Cel = $Cel;
	}

	public function set_Fax($Fax){
		return $this -> Fax = $Fax;
	}

	public function set_Email($Email){
		return $this -> Email = $Email;
	}

	public function set_Web($Web){
		return $this -> Web = $Web;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'NUEVO'){
				$Sql = "INSERT INTO gene_terceros_empresas(id_depar, id_muni, nit_empre, razo_soci, dir, tel, cel, fax, email, web)
						VALUE(:id_depar, :id_muni, :nit_empre, :razo_soci, :dir, :tel, :cel, :fax, :email, :web)";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depar', $this->IdDepartamento, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_muni', $this->IdMunicipio, PDO::PARAM_INT);
				$Instruc -> bindParam(':nit_empre', $this->Nit, PDO::PARAM_INT);
				$Instruc -> bindParam(':razo_soci', $this->RazonSocial, PDO::PARAM_STR);
				$Instruc -> bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc -> bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc -> bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc -> bindParam(':fax', $this->Fax, PDO::PARAM_STR);
				$Instruc -> bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc -> bindParam(':web', $this->Web, PDO::PARAM_STR);

			}elseif($this->Accion == 'EDITAR'){
				$Sql = "UPDATE gene_terceros_empresas SET id_depar = :id_depar, id_muni = :id_muni, 
								nit_empre = :nit_empre, razo_soci = :razo_soci , dir =:dir, tel = :tel, 
								fax = :fax, cel = :cel, email = :email, web = :web
						WHERE id_empre = :id_empre";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depar', $this->IdDepartamento, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_muni', $this->IdMunicipio, PDO::PARAM_INT);
				$Instruc -> bindParam(':nit_empre', $this->Nit, PDO::PARAM_INT);
				$Instruc -> bindParam(':razo_soci', $this->RazonSocial, PDO::PARAM_STR);
				$Instruc -> bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc -> bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc -> bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc -> bindParam(':fax', $this->Fax, PDO::PARAM_STR);
				$Instruc -> bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc -> bindParam(':web', $this->Web, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_empre', $this->IdEmpresa, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this->IdEmpresa = $conexion->lastInsertId();
			$conexion = null;	

			if($Instruc){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
	
	public static function Listar($Accion, $IdEmpresa, $Nit, $RazoSoci, $NumDocu, $NomContacto){
		$conexion = new Conexion();
        
        try{
       		if($Accion == 1){
       			/******************************************************************************************/
	            /*  BUSCO UN UNA EMPRESA POR RAZON SOCIAL
	            /******************************************************************************************/
	            $Sql = "SELECT * 
	            		FROM gene_terceros_empresas 
	            		WHERE razo_soci = :razo_soci";

	            $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':razo_soci', $RazoSoci, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
       			/******************************************************************************************/
	            /*  BUSCO UN UNA EMPRESA POR RAZON SOCIAL
	            /******************************************************************************************/
	            $Sql = "SELECT * 
	            		FROM gene_terceros_empresas
	            		ORDER BY razo_soci ASC";

	            $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':razo_soci', $RazoSoci, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 3){
       			/******************************************************************************************/
	            /*  BUSCO UN UNA EMPRESA POR RAZON SOCIAL
	            /******************************************************************************************/
	            $Sql = "SELECT `empre`.*, `depar`.`nom_depar`, `muni`.`nom_muni`
						FROM `gene_terceros_empresas` AS `empre`
						    INNER JOIN `config_depar` AS `depar` ON (`empre`.`id_depar` = `depar`.`id_depar`)
						    INNER JOIN `config_muni` AS `muni` ON (`empre`.`id_muni` = `muni`.`id_muni`)
						WHERE (`empre`.`nit_empre` LIKE ?) OR (`empre`.`razo_soci` LIKE ?)
	            		ORDER BY `empre`.`razo_soci` ASC";

	            $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array('%'.$RazoSoci.'%', '%'.$Nit.'%')) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
	        }
        
            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;

        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
            exit;
        } 
	}

	public static function Buscar($Accion, $IdEmpresa, $Nit, $RazoSoci, $NumDocu, $NomRemite) {
		$conexion = new Conexion();
		
		try{

       		if($Accion == 1){
	            /******************************************************************************************/
	            /*  BUSCO UN UNA EMPRESA POR RAZON SOCIAL
	            /******************************************************************************************/
	            $Sql =" SELECT * 
	            		FROM gene_terceros_empresas 
	            		WHERE razo_soci = :razo_soci";

	            $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':razo_soci', $RazoSoci, PDO::PARAM_STR);
                
	        }elseif($Accion == 2){
	            /******************************************************************************************/
	            /*  BUSCO UN UNA EMPRESA DE UN TERCERO
	            /******************************************************************************************/
	            $Sql =" SELECT * 
	            		FROM gene_terceros_empresas 
	            		WHERE id_empre = :id_empre";

	            $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_empre', $IdEmpresa, PDO::PARAM_STR);
            }elseif($Accion == 3){
	            /******************************************************************************************/
	            /*  BUSCO UN UNA EMPRESA POR NIT
	            /******************************************************************************************/
	            $Sql =" SELECT * 
	            		FROM gene_terceros_empresas 
	            		WHERE nit_empre = :nit_empre";

	            $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':nit_empre', $Nit, PDO::PARAM_STR);
            }
       		
				
			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

			if ($Result) {
					return new self("", $Result['id_empre'], $Result['id_depar'], $Result['id_muni'], $Result['nit_empre'], $Result['razo_soci'], 
									$Result['dir'], $Result['tel'], $Result['cel'], $Result['fax'], $Result['email']);
			} else {
					return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
}
?>