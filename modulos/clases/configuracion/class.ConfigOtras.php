<?php
class ConfigOtras
{
	private $Accion;
	private $id;
	private $CoresReciTitulo;
	private $CoresReciSubTitulo;
	private $CoresReciCodigo;
	private $CoresReciVersion;
	private $CoresEnviaTitulo;
	private $CoresEnviaSubTitulo;
	private $CoresEnviaCodigo;
	private $CoresEnviaVersion;
	private $CoresInternaTitulo;
	private $CoresInternaSubTitulo;
	private $CoresInternaCodigo;
	private $CoresInternaVersion;
	private $PlantiCorrespon;
	private $TipoRadicadRecibida;
	private $TipoRadicadEnviada;
	private $TipoRadicadInterna;
	private $TipoImpresionRotulo;
	private $Incluir_TRD;
	private $Incluir_Oficina_TRD;
	private $EmailVentanillaUsuario;
	private $EmailVentanillaContra;
	private $EmailVentanillaServidor;
	private $EmailVentanillaPuerto;
	private $EmailVentanillaAutenti;
	private $TipoCargueArchivos;

	public function __construct(
		$Accion = null,
		$id = null,
		$CoresReciTitulo = null,
		$CoresReciSubTitulo = null,
		$CoresReciCodigo = null,
		$CoresReciVersion = null,
		$CoresEnviaTitulo = null,
		$CoresEnviaSubTitulo = null,
		$CoresEnviaCodigo = null,
		$CoresEnviaVersion = null,
		$CoresInternaTitulo = null,
		$CoresInternaSubTitulo = null,
		$CoresInternaCodigo = null,
		$CoresInternaVersion = null,
		$PlantiCorrespon = null,
		$TipoRadicadRecibida = null,
		$TipoRadicadEnviada = null,
		$TipoRadicadInterna = null,
		$TipoImpresionRotulo = null,
		$Incluir_TRD = null,
		$Incluir_Oficina_TRD = null,
		$EmailVentanillaUsuario = null,
		$EmailVentanillaContra = null,
		$EmailVentanillaServidor = null,
		$EmailVentanillaPuerto = null,
		$EmailVentanillaAutenti = null,
		$TipoCargueArchivos = null
	) {

		$this->Accion                  = $Accion;
		$this->id                      = $id;
		$this->CoresReciTitulo         = $CoresReciTitulo;
		$this->CoresReciSubTitulo      = $CoresReciSubTitulo;
		$this->CoresReciCodigo         = $CoresReciCodigo;
		$this->CoresReciVersion        = $CoresReciVersion;
		$this->CoresEnviaTitulo        = $CoresEnviaTitulo;
		$this->CoresEnviaSubTitulo     = $CoresEnviaSubTitulo;
		$this->CoresEnviaCodigo        = $CoresEnviaCodigo;
		$this->CoresEnviaVersion       = $CoresEnviaVersion;
		$this->CoresInternaTitulo      = $CoresInternaTitulo;
		$this->CoresInternaSubTitulo   = $CoresInternaSubTitulo;
		$this->CoresInternaCodigo      = $CoresInternaCodigo;
		$this->CoresInternaVersion     = $CoresInternaVersion;
		$this->PlantiCorrespon         = $PlantiCorrespon;
		$this->TipoRadicadRecibida     = $TipoRadicadRecibida;
		$this->TipoRadicadEnviada      = $TipoRadicadEnviada;
		$this->TipoRadicadInterna      = $TipoRadicadInterna;
		$this->TipoImpresionRotulo     = $TipoImpresionRotulo;
		$this->Incluir_TRD             = $Incluir_TRD;
		$this->Incluir_Oficina_TRD     = $Incluir_Oficina_TRD;
		$this->EmailVentanillaUsuario  = $EmailVentanillaUsuario;
		$this->EmailVentanillaContra   = $EmailVentanillaContra;
		$this->EmailVentanillaServidor = $EmailVentanillaServidor;
		$this->EmailVentanillaPuerto   = $EmailVentanillaPuerto;
		$this->EmailVentanillaAutenti  = $EmailVentanillaAutenti;
		$this->TipoCargueArchivos      = $TipoCargueArchivos;
	}

	public function get_Id()
	{
		return $this->id;
	}

	public function get_CoresReciTitulo()
	{
		return $this->CoresReciTitulo;
	}

	public function get_CoresReciSubTitulo()
	{
		return $this->CoresReciSubTitulo;
	}

	public function get_CoresReciCodigo()
	{
		return $this->CoresReciCodigo;
	}

	public function get_CoresReciVersion()
	{
		return $this->CoresReciVersion;
	}

	public function get_CoresEnviaTitulo()
	{
		return $this->CoresEnviaTitulo;
	}

	public function get_CoresEnviaSubTitulo()
	{
		return $this->CoresEnviaSubTitulo;
	}

	public function get_CoresEnviaCodigo()
	{
		return $this->CoresEnviaCodigo;
	}

	public function get_CoresEnviaVersion()
	{
		return $this->CoresEnviaVersion;
	}

	public function get_CoresInternaTitulo()
	{
		return $this->CoresInternaTitulo;
	}

	public function get_CoresInternaSubTitulo()
	{
		return $this->CoresInternaSubTitulo;
	}

	public function get_CoresInternaCodigo()
	{
		return $this->CoresInternaCodigo;
	}

	public function get_CoresInternaVersion()
	{
		return $this->CoresInternaVersion;
	}

	public function get_PlantiCorrespon()
	{
		return $this->PlantiCorrespon;
	}

	public function get_TipoRadicadRecibida()
	{
		return $this->TipoRadicadRecibida;
	}

	public function get_TipoRadicadEnviada()
	{
		return $this->TipoRadicadEnviada;
	}

	public function get_TipoRadicadInterna()
	{
		return $this->TipoRadicadInterna;
	}

	public function get_TipoImpresionRotulo()
	{
		return $this->TipoImpresionRotulo;
	}

	public function get_Incluir_TRD()
	{
		return $this->Incluir_TRD;
	}

	public function get_Incluir_Oficina_TRD()
	{
		return $this->Incluir_Oficina_TRD;
	}

	public function get_EmailVentanillaUsuario()
	{
		return $this->EmailVentanillaUsuario;
	}

	public function get_EmailVentanillaContra()
	{
		return $this->EmailVentanillaContra;
	}

	public function get_EmailVentanillaServidor()
	{
		return $this->EmailVentanillaServidor;
	}

	public function get_EmailVentanillaPuerto()
	{
		return $this->EmailVentanillaPuerto;
	}

	public function get_EmailVentanillaAutenti()
	{
		return $this->EmailVentanillaAutenti;
	}

	public function get_TipoCargueArchivos()
	{
		return $this->TipoCargueArchivos;
	}

	/////////////////////////////////////
	public function set_Accion($Accion)
	{
		$this->Accion = $Accion;
	}

	public function set_CoresReciTitulo($CoresReciTitulo)
	{
		$this->CoresReciTitulo = $CoresReciTitulo;
	}

	public function set_CoresReciSubTitulo($CoresReciSubTitulo)
	{
		$this->CoresReciSubTitulo = $CoresReciSubTitulo;
	}

	public function set_CoresReciCodigo($CoresReciCodigo)
	{
		$this->CoresReciCodigo = $CoresReciCodigo;
	}

	public function set_CoresReciVersion($CoresReciVersion)
	{
		$this->CoresReciVersion = $CoresReciVersion;
	}

	public function set_CoresEnviaTitulo($CoresEnviaTitulo)
	{
		$this->CoresEnviaTitulo = $CoresEnviaTitulo;
	}

	public function set_CoresEnviaSubTitulo($CoresEnviaSubTitulo)
	{
		$this->CoresEnviaSubTitulo = $CoresEnviaSubTitulo;
	}

	public function set_CoresEnviaCodigo($CoresEnviaCodigo)
	{
		$this->CoresEnviaCodigo = $CoresEnviaCodigo;
	}

	public function set_CoresEnviaVersion($CoresEnviaVersion)
	{
		$this->CoresEnviaVersion = $CoresEnviaVersion;
	}

	public function set_CoresInternaTitulo($CoresInternaTitulo)
	{
		$this->CoresInternaTitulo = $CoresInternaTitulo;
	}

	public function set_CoresInternaSubTitulo($CoresInternaSubTitulo)
	{
		$this->CoresInternaSubTitulo = $CoresInternaSubTitulo;
	}

	public function set_CoresInternaCodigo($CoresInternaCodigo)
	{
		$this->CoresInternaCodigo = $CoresInternaCodigo;
	}

	public function set_CoresInternaVersion($CoresInternaVersion)
	{
		$this->CoresInternaVersion = $CoresInternaVersion;
	}

	public function set_PlantiCorrespon($PlantiCorrespon)
	{
		$this->PlantiCorrespon = $PlantiCorrespon;
	}

	public function set_TipoRadicadRecibida($TipoRadicadRecibida)
	{
		$this->TipoRadicadRecibida = $TipoRadicadRecibida;
	}

	public function set_TipoRadicadEnviada($TipoRadicadEnviada)
	{
		$this->TipoRadicadEnviada = $TipoRadicadEnviada;
	}

	public function set_TipoRadicadInterna($TipoRadicadInterna)
	{
		$this->TipoRadicadInterna = $TipoRadicadInterna;
	}

	public function set_TipoImpresionRotulo($TipoImpresionRotulo)
	{
		$this->TipoImpresionRotulo = $TipoImpresionRotulo;
	}

	public function set_Incluir_TRD($Incluir_TRD)
	{
		$this->Incluir_TRD = $Incluir_TRD;
	}

	public function set_Incluir_Oficina_TRD($Incluir_Oficina_TRD)
	{
		$this->Incluir_Oficina_TRD = $Incluir_Oficina_TRD;
	}

	public function set_EmailVentanillaUsuario($EmailVentanillaUsuario)
	{
		$this->EmailVentanillaUsuario = $EmailVentanillaUsuario;
	}

	public function set_EmailVentanillaContra($EmailVentanillaContra)
	{
		$this->EmailVentanillaContra = $EmailVentanillaContra;
	}

	public function set_EmailVentanillaServidor($EmailVentanillaServidor)
	{
		$this->EmailVentanillaServidor = $EmailVentanillaServidor;
	}

	public function set_EmailVentanillaPuerto($EmailVentanillaPuerto)
	{
		$this->EmailVentanillaPuerto = $EmailVentanillaPuerto;
	}

	public function set_EmailVentanillaAutenti($EmailVentanillaAutenti)
	{
		$this->EmailVentanillaAutenti = $EmailVentanillaAutenti;
	}

	public function set_TipoCargueArchivos($TipoCargueArchivos)
	{
		return $this->TipoCargueArchivos = $TipoCargueArchivos;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {
			if ($this->Accion == 0) {
				$Sql = "INSERT INTO `config_otras`(`corres_recibida_titulo`, `corres_recibida_subtitulo`, `corres_recibida_codigo`, `corres_recibida_version`, `corres_enviada_titulo`, 
									`corres_enviada_subtitulo`, `corres_enviada_codigo`, `corres_enviada_version`, `corres_interna_titulo`, `corres_interna_subtitulo`, `corres_interna_codigo`, 
									`corres_interna_version`, `planti_correspondencia`, `tipo_radica_recibida`, `tipo_radica_enviado`, `tipo_radica_interno`, `tipo_impre_torulo`, `incluir_trd`, 
									`incluir_oficina_trd`, `email_ventanilla_usuario`, `email_ventanilla_contra`, `mail_ventanilla_servidor`, `email_ventanilla_puerto`, `email_ventanilla_autenti`,
									`tipo_cargue_archivos)
						VALUES (:corres_recibida_titulo, :corres_recibida_subtitulo, :corres_recibida_codigo, :corres_recibida_version, :corres_enviada_titulo, :corres_enviada_subtitulo, 
								:corres_enviada_codigo, :corres_enviada_version, :corres_interna_titulo, :corres_interna_subtitulo, :corres_interna_codigo, :corres_interna_version, 
								:planti_correspondencia, :tipo_radica_recibida, :tipo_radica_enviado, :tipo_radica_interno, :tipo_impre_torulo, :incluir_trd, :incluir_oficina_trd, 
								:email_ventanilla_usuario, :email_ventanilla_contra, :mail_ventanilla_servidor, :email_ventanilla_puerto, :email_ventanilla_autenti, :tipo_cargue_archivos);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':corres_recbida_titulo', $this->CoresReciTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_recbida_subtitulo', $this->CoresReciSubTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_recbida_codigo', $this->CoresReciCodigo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_recbida_version', $this->CoresReciVersion, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_titulo', $this->CoresEnviaTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_subtitulo', $this->CoresEnviaSubTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_codigo', $this->CoresEnviaCodigo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_version', $this->CoresEnviaVersion, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_titulo', $this->CoresInternaTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_subtitulo', $this->CoresInternaSubTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_codigo', $this->CoresInternaCodigo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_version', $this->CoresInternaVersion, PDO::PARAM_STR);
				$Instruc->bindParam(':incluir_trd', $this->Incluir_TRD, PDO::PARAM_INT);
				$Instruc->bindParam(':incluir_oficina_trd', $this->Incluir_Oficina_TRD, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_radica_recibida', $this->TipoRadicadRecibida, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_radica_enviado', $this->TipoRadicadEnviada, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_radica_interno', $this->TipoRadicadInterna, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_impre_torulo', $this->TipoImpresionRotulo, PDO::PARAM_INT);
				$Instruc->bindParam(':email_ventanilla_usuario', $this->EmailVentanillaUsuario, PDO::PARAM_STR);
				$Instruc->bindParam(':email_ventanilla_contra', $this->EmailVentanillaContra, PDO::PARAM_STR);
				$Instruc->bindParam(':mail_ventanilla_servidor', $this->EmailVentanillaServidor, PDO::PARAM_STR);
				$Instruc->bindParam(':email_ventanilla_puerto', $this->EmailVentanillaPuerto, PDO::PARAM_STR);
				$Instruc->bindParam(':email_ventanilla_autenti', $this->EmailVentanillaAutenti, PDO::PARAM_STR);
				$Instruc->bindParam(':tipo_cargue_archivos', $this->TipoCargueArchivos, PDO::PARAM_INT);
			} elseif ($this->Accion == 1) {
				$Sql = "UPDATE config_otras SET corres_recibida_titulo = :corres_recibida_titulo, corres_recibida_subtitulo = :corres_recibida_subtitulo, 
							corres_recibida_codigo = :corres_recibida_codigo, corres_recibida_version = :corres_recibida_version,  
							corres_enviada_titulo = :corres_enviada_titulo, corres_enviada_subtitulo = :corres_enviada_subtitulo, 
							corres_enviada_codigo = :corres_enviada_codigo, corres_enviada_version = :corres_enviada_version, 
							corres_interna_titulo = :corres_interna_titulo, corres_interna_subtitulo = :corres_interna_subtitulo, 
							corres_interna_codigo = :corres_interna_codigo, corres_interna_version = :corres_interna_version, 
							incluir_trd = :incluir_trd, incluir_oficina_trd = :incluir_oficina_trd, tipo_radica_recibida = :tipo_radica_recibida, tipo_radica_enviado = :tipo_radica_enviado, 
							tipo_radica_interno = :tipo_radica_interno, tipo_impre_torulo = :tipo_impre_torulo, email_ventanilla_usuario = :email_ventanilla_usuario, 
							email_ventanilla_contra = :email_ventanilla_contra, mail_ventanilla_servidor = :mail_ventanilla_servidor, 
							email_ventanilla_puerto = :email_ventanilla_puerto, email_ventanilla_autenti = :email_ventanilla_autenti, 
							tipo_cargue_archivos = :tipo_cargue_archivos";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':corres_recibida_titulo', $this->CoresReciTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_recibida_subtitulo', $this->CoresReciSubTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_recibida_codigo', $this->CoresReciCodigo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_recibida_version', $this->CoresReciVersion, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_titulo', $this->CoresEnviaTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_subtitulo', $this->CoresEnviaSubTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_codigo', $this->CoresEnviaCodigo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_enviada_version', $this->CoresEnviaVersion, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_titulo', $this->CoresInternaTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_subtitulo', $this->CoresInternaSubTitulo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_codigo', $this->CoresInternaCodigo, PDO::PARAM_STR);
				$Instruc->bindParam(':corres_interna_version', $this->CoresInternaVersion, PDO::PARAM_STR);
				$Instruc->bindParam(':incluir_trd', $this->Incluir_TRD, PDO::PARAM_INT);
				$Instruc->bindParam(':incluir_oficina_trd', $this->Incluir_Oficina_TRD, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_radica_recibida', $this->TipoRadicadRecibida, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_radica_enviado', $this->TipoRadicadEnviada, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_radica_interno', $this->TipoRadicadInterna, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_impre_torulo', $this->TipoImpresionRotulo, PDO::PARAM_INT);
				$Instruc->bindParam(':email_ventanilla_usuario', $this->EmailVentanillaUsuario, PDO::PARAM_STR);
				$Instruc->bindParam(':email_ventanilla_contra', $this->EmailVentanillaContra, PDO::PARAM_STR);
				$Instruc->bindParam(':mail_ventanilla_servidor', $this->EmailVentanillaServidor, PDO::PARAM_STR);
				$Instruc->bindParam(':email_ventanilla_puerto', $this->EmailVentanillaPuerto, PDO::PARAM_STR);
				$Instruc->bindParam(':email_ventanilla_autenti', $this->EmailVentanillaAutenti, PDO::PARAM_STR);
				$Instruc->bindParam(':tipo_cargue_archivos', $this->TipoCargueArchivos, PDO::PARAM_INT);
			} elseif ($this->Accion == 2) {
				$Sql = "UPDATE config_otras
						SET planti_correspondencia = :planti_correspondencia";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':planti_correspondencia', $this->PlantiCorrespon, PDO::PARAM_STR);
			} elseif ($this->Accion == 3) {
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Otras configuraciones, Gestionar, Acciones ' . $this->Accion . " - "  . $e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				$Sql = "SELECT * FROM config_otras";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}

	public static function Buscar()
	{
		$conexion = new Conexion();

		try {
			$Sql = "SELECT * FROM config_otras";
			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id'],
					$Result['corres_recibida_titulo'],
					$Result['corres_recibida_subtitulo'],
					$Result['corres_recibida_codigo'],
					$Result['corres_recibida_version'],
					$Result['corres_enviada_titulo'],
					$Result['corres_enviada_subtitulo'],
					$Result['corres_enviada_codigo'],
					$Result['corres_enviada_version'],
					$Result['corres_interna_titulo'],
					$Result['corres_interna_subtitulo'],
					$Result['corres_interna_codigo'],
					$Result['corres_interna_version'],
					$Result['planti_correspondencia'],
					$Result['tipo_radica_recibida'],
					$Result['tipo_radica_enviado'],
					$Result['tipo_radica_interno'],
					$Result['tipo_impre_torulo'],
					$Result['incluir_trd'],
					$Result['incluir_oficina_trd'],
					$Result['email_ventanilla_usuario'],
					$Result['email_ventanilla_contra'],
					$Result['mail_ventanilla_servidor'],
					$Result['email_ventanilla_puerto'],
					$Result['email_ventanilla_autenti'],
					$Result['tipo_cargue_archivos'],
				);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
