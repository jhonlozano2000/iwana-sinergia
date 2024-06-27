<?php
/*
 * @Author: Anuj Kumar Gupta
 */
class FTPClient
{

	// *** Class variables
	private $connectionId;
	private $loginOk = false;
	private $messageArray = array();
	private $_ftpUser = '';
	private $_ftpPassword = '';
	private $_ftpHost = '';

	public function __construct()
	{
	}

	//Set log message
	private function logMessage($message)
	{
		$this->messageArray[] = $message;
	}

	//retrieve the message
	public function getMessages()
	{
		return $this->messageArray;
	}

	//connect to an FTP server
	public function connect($server, $ftpUser, $ftpPassword, $isPassive = false)
	{
		$this->_ftpHost     = $server;
		$this->_ftpUser     = $ftpUser;
		$this->_ftpPassword = $ftpPassword;

		// *** Set up basic connection
		$this->connectionId = ftp_connect($server);

		// *** Login with username and password
		if (!$this->connectionId) {
			$this->logMessage('false');
			$this->logMessage('FTP connection has failed!');
			$this->logMessage('Attempted to connect to ' . $server . ' for user ' . $ftpUser, true);
			return false;
		} else {

			$loginResult = ftp_login($this->connectionId, $ftpUser, $ftpPassword);

			// *** Sets passive mode on/off (default off)
			ftp_pasv($this->connectionId, $isPassive);

			// *** Check connection
			if ((!$this->connectionId) || (!$loginResult)) {
				$this->logMessage('false');
				$this->logMessage('FTP connection has failed!');
				$this->logMessage('Attempted to connect to ' . $server . ' for user ' . $ftpUser, true);
				return false;
			} else {
				$this->logMessage('true');
				$this->loginOk = true;
				return true;
			}
		}
	}

	//Create a directory
	public function makeDir($directory)
	{

		//Check directory is available in ftp or not
		if ($this->_ftp_is_dir($directory)) {
			//$this->logMessage('Directory "' . $directory . '" already present in ftp');
			//return false;
			$this->logMessage('true');
			return true;
		} else {
			// *** If creating a directory is successful...

			if (ftp_mkdir($this->connectionId, $directory)) {

				$this->logMessage('true');
				return true;
			} else {

				// *** ...Else, FAIL.
				$this->logMessage('false');
				return false;
			}
		}
	}

	//Comprobar el directorio presente en ftp o no
	private function _ftp_is_dir($directory)
	{
		$pushd = ftp_pwd($this->connectionId);

		if ($pushd !== false && @ftp_chdir($this->connectionId, $directory)) {
			ftp_chdir($this->connectionId, $pushd);
			return true;
		}
		return false;
	}

	//Upload file
	public function uploadFile($archivo_local, $archivo_servidor)
	{
		$fileTo = '';

		// *** Set the transfer mode
		$asciiArray = array('txt', 'csv');
		$exp = explode(".", $archivo_local);
		$extension = end($exp);

		if (in_array($extension, $asciiArray)) {
			$mode = FTP_ASCII;
		} else {
			$mode = FTP_BINARY;
		}

		// *** Upload the file
		$upload = ftp_put($this->connectionId, $archivo_servidor, $archivo_local, $mode);

		// *** Check upload status
		if (!$upload) {
			$this->logMessage('false');
			return false;
		} else {
			$this->logMessage('true');
			return true;
		}
	}

	public function downloadFile($archivo_local, $archivo_servidor)
	{

		$Download = ftp_get($this->connectionId, $archivo_local, $archivo_servidor, FTP_BINARY);

		if (!$Download) {
			$this->logMessage('No fue posible descargar el archivo.');
			return false;
		} else {
			$this->logMessage('true');
			return true;
		}
	}

	//Move file
	public function moveFile($archivo_origen, $archivo_destina)
	{

		// *** Upload the file
		$move = ftp_rename($this->connectionId, $archivo_origen, $archivo_destina);

		// *** Check move status
		if (!$move) {
			$this->logMessage('false');
			return false;
		} else {
			$this->logMessage('true');
			return true;
		}
	}

	public function deleteFile($archivo_servidor)
	{
		if (ftp_delete($this->connectionId, $archivo_servidor)) {
			$this->logMessage('true');
			return true;
		} else {
			$this->logMessage('false');
			return false;
		}
	}

	public function pr($arrData)
	{
		//print_r($arrData);
		return $arrData;
	}

	public function __deconstruct()
	{
		if ($this->connectionId) {
			ftp_close($this->connectionId);
		}
	}
}
