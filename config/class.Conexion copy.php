<?php
class Conexion extends PDO
{
	private $tipo_de_base   = 'mysql';
	private $host           = 'iwana_localhost';
	private $nombre_de_base = 'iwana_db';
	private $usuario        = 'iwana_user';
	private $contrasena     = 'iwana_password';

	private $tipo_de_base   = 'mysql';
	private $host           = 'localhost';
	private $nombre_de_base = 'iwana_sinergia';
	private $usuario        = 'root';
	private $contrasena     = '';

	public function __construct()
	{
		try {
			parent::__construct($this->tipo_de_base . ':host=' . $this->host . ';dbname=' . $this->nombre_de_base, $this->usuario, $this->contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'', PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
			exit;
		}
	}
}
