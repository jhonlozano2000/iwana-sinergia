<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
session_start();
require_once '../../config/class.Conexion.php';
require_once '../../config/variable.php';
require_once '../../modulos/clases/configuracion/class.ConfigOtras.php';

require_once "../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ConfiguracionOtras = ConfigOtras::Buscar();

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;
//Set the hostname of the mail server
$mail->Host = $ConfiguracionOtras->get_EmailVentanillaServidor();
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = $ConfiguracionOtras->get_EmailVentanillaPuerto();
//Whether to use SMTP authentication
$mail->SMTPAuth = $ConfiguracionOtras->get_EmailVentanillaAutenti();
//Username to use for SMTP authentication
$mail->Username = $ConfiguracionOtras->get_EmailVentanillaUsuario();
//Password to use for SMTP authentication
$mail->Password = $ConfiguracionOtras->get_EmailVentanillaContra();

$Accion     = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadicado = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;

if (isset($_POST['IdRadicadoMasivo'])) $IdRadicadoMasivo = explode(",", $_POST['IdRadicadoMasivo']);

switch ($Accion) {
	case 'CORRESPONDENCIA_RECIVIDA':

		if (!$ConfiguracionOtras->get_EmailVentanillaUsuario()) {
			echo "No se encontró el email para el envió de las notificaciones, por favor consulte con el administrador del sistema";
			exit();
		}

		require_once '../clases/radicar/class.RadicaRecibido.php';
		require_once '../clases/radicar/class.RadicaRecibidoResponsable.php';
		require_once '../clases/general/class.GeneralFuncionario.php';

		$Radicado    = RadicadoRecibido::Buscar(1, $IdRadicado, "", "", "", "");
		$Responsable = RadicadoRecibidoResponsable::Buscar(3, $IdRadicado, "");
		$Funcionario = Funcionario::Buscar(2, $Responsable->get_IdFuncio(), "", "", "", "", "", "");

		//Establecer de quién se enviará el mensaje
		$mail->setFrom($ConfiguracionOtras->get_EmailVentanillaUsuario(), 'Ventanilla Unica');
		//Establecer una dirección de respuesta alternativa
		$mail->addReplyTo($ConfiguracionOtras->get_EmailVentanillaUsuario(), 'Ventanilla Unica');
		//Establecer a quién se enviará el mensaje
		$mail->addAddress($Funcionario->getEmail(), $Funcionario->getNom_Funcio());
		//Establecer la línea de asunto
		$mail->Subject = 'El radicado ' . $IdRadicado . " Esta pronto a vence";
		//Leer el cuerpo de un mensaje HTML desde un archivo externo, convertir imágenes referenciadas en incrustadas,
		//convertir HTML en un cuerpo alternativo básico de texto plano
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'base64';
		$mail->isHTML(true);

		//Extraigo la informacion del radicado para armar el cuerpo de un mensaje de la notificacion
		$InfoRadicado = "";
		$RegisRadicado = RadicadoRecibido::Listar_Vario(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");

		$Responsable = "";
		$Destinatarios = "";

		$RegisResponsable = RadicadoRecibidoResponsable::Listar(1, $RegisRadicado[0]['id_radica'], "");
		foreach ($RegisResponsable as $ItemResponsa) {
			if ($ItemResponsa['respon'] == 1) {
				$Responsable .= "Funcio.: " . $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'] . "<br>Depen.: " . $ItemResponsa['nom_depen'];
			}

			$Destinatarios .= "[" . $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'] . " - " . $ItemResponsa['nom_depen'] . "]";
		}

		$InfoRadicado = "<strong><h3>Info.</h3></strong>
					<strong>Radicado:</strong> " . $RegisRadicado[0]['id_radica'] . "<br>
					<strong>Asunto:</strong> " . $RegisRadicado[0]['asunto'] . "<br>
					<strong>Fec. Doc.:</strong> " . $RegisRadicado[0]['fec_docu'] . "<br>
					<strong>Fec. Veni.:</strong> " . $RegisRadicado[0]['fec_venci'] . "<br>
					<strong>Fec. Rad.:</strong> " . $RegisRadicado[0]['fechor_radica'] . "<br>
					<strong># Anexos:</strong> " . $RegisRadicado[0]['num_anexos'] . "<br>
					<strong>Observa. Anexos:</strong> " . $RegisRadicado[0]['observa_anexo'] . "<br>
					<strong># Folios:</strong> " . $RegisRadicado[0]['num_folio'] . "<br>
					<strong>Radicado Por:</strong> " . $RegisRadicado[0]['nom_funcio_regis'] . " " . $RegisRadicado[0]['ape_funcio_regis'] . "<br>
					<strong>Tipo Llegada :</strong> " . $RegisRadicado[0]['nom_forma_llega'] . "<br>

					<strong><h3>Remitente.</h3></strong>
					<strong>Nit.:</strong> " . $RegisRadicado[0]['num_docu_remite'] . "<br>
					<strong>Tercero:</strong> " . $RegisRadicado[0]['nom_remite'] . "<br>
					<strong>Dirección:</strong> " . $RegisRadicado[0]['dir_remite'] . "<br>
					<strong>Teléfono:</strong> " . $RegisRadicado[0]['tel_remite'] . "<br>
					<strong>Fax:</strong> " . $RegisRadicado[0]['fax_remite'] . "<br>
					<strong>E - Mail:</strong> " . $RegisRadicado[0]['email_remite'] . "<br>
					<strong>Cargo :</strong> " . $RegisRadicado[0]['cargo'] . "<br>

					<strong><h3>Destinatarios.</h3></strong>
					<strong>Responsable: " . $Responsable . "<br>
					<strong>Destinaratios: " . $Destinatarios . "<br>
					";

		$Mensaje = "<body>
		            <p><strong>" . $Funcionario->getNom_Funcio() . "</strong>,</p>
		            <p>El radicado <strong>" . $IdRadicado . "</strong>, con el asunto <strong>'" . $Radicado->get_Asunto() . "'</strong>, Esta pronto a vence.</p>
		            <p>" . $InfoRadicado . "</p>
		            <p>Cordialmente, <br><br><br>Ventanilla unica.</p>
		            </body>";

		$mail->msgHTML($Mensaje);
		//Reemplace el cuerpo del texto sin formato con uno creado manualmente
		$mail->AltBody = 'Notificacion de radicado pronto a vencer';
		//Adjuntar un archivo de imagen
		//$mail->addAttachment('aqui archivo adjunto');

		//envía el mensaje, comprueba si hay errores
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 1;
		}
		break;
	case 'CORRESPONDENCIA_RECIBIDA_MASIVA':

		require_once '../clases/radicar/class.RadicaRecibido.php';
		require_once '../clases/radicar/class.RadicaRecibidoResponsable.php';
		require_once '../clases/general/class.GeneralFuncionario.php';
		require_once '../clases/notificaciones/class.NotificacionesExternaEmail.php';

		for ($i = 0; $i < count($IdRadicadoMasivo); $i++) {

			$Radicado    = RadicadoRecibido::Buscar(1, $IdRadicadoMasivo[$i], "", "", "", "");
			$Responsable = RadicadoRecibidoResponsable::Buscar(3, $IdRadicadoMasivo[$i], "");
			$Funcionario = Funcionario::Buscar(2, $Responsable->get_IdFuncio(), "", "", "", "", "", "");

			//Establecer de quién se enviará el mensaje
			$mail->setFrom($ConfiguracionOtras->get_EmailVentanillaUsuario(), 'Ventanilla Unica');
			//Establecer una dirección de respuesta alternativa
			$mail->addReplyTo($ConfiguracionOtras->get_EmailVentanillaUsuario(), 'Ventanilla Unica');
			//Establecer a quién se enviará el mensaje
			$mail->addAddress($Funcionario->getEmail(), $Funcionario->getNom_Funcio());
			//Establecer la línea de asunto
			$mail->Subject = 'El radicado ' . $IdRadicadoMasivo[$i] . " Esta pronto a vence";
			//Leer el cuerpo de un mensaje HTML desde un archivo externo, convertir imágenes referenciadas en incrustadas,
			//convertir HTML en un cuerpo alternativo básico de texto plano

			$InfoRadicado = "";
			$RegisRadicado = RadicadoRecibido::Listar_Vario(1, $IdRadicadoMasivo[$i], "", "", 0, 0, 0, "", "", "");
			foreach ($RegisRadicado as $ItemRadicado) :

				$ResponsableRadicado = "";
				$Destinatarios = "";

				$RegisResponsable = RadicadoRecibidoResponsable::Listar(1, $IdRadicadoMasivo[$i], "");
				foreach ($RegisResponsable as $ItemResponsa) {
					if ($ItemResponsa['respon'] == 1) {
						$ResponsableRadicado .= "Funcio.: " . $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'] . "<br>Depen.: " . $ItemResponsa['nom_depen'];
					}

					$Destinatarios .= "[" . $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'] . " - " . $ItemResponsa['nom_depen'] . "]";
				}

				$InfoRadicado = "<strong><h3>Info.</h3></strong>
						<strong>Radicado:</strong> " . $ItemRadicado['id_radica'] . "<br>
						<strong>Asunto:</strong> " . $ItemRadicado['asunto'] . "<br>
						<strong>Fec. Doc.:</strong> " . $ItemRadicado['fec_docu'] . "<br>
						<strong>Fec. Veni.:</strong> " . $ItemRadicado['fec_venci'] . "<br>
						<strong>Fec. Rad.:</strong> " . $ItemRadicado['fechor_radica'] . "<br>
						<strong># Anexos:</strong> " . $ItemRadicado['num_anexos'] . "<br>
						<strong>Observa. Anexos:</strong> " . $ItemRadicado['observa_anexo'] . "<br>
						<strong># Folios:</strong> " . $ItemRadicado['num_folio'] . "<br>
						<strong>Radicado Por:</strong> " . $ItemRadicado['nom_funcio_regis'] . " " . $ItemRadicado['ape_funcio_regis'] . "<br>
						<strong>Tipo Llegada :</strong> " . $ItemRadicado['nom_forma_llega'] . "<br>

						<strong><h3>Remitente.</h3></strong>
						<strong>Nit.:</strong> " . $ItemRadicado['num_docu_remite'] . "<br>
						<strong>Tercero:</strong> " . $ItemRadicado['nom_remite'] . "<br>
						<strong>Dirección:</strong> " . $ItemRadicado['dir_remite'] . "<br>
						<strong>Teléfono:</strong> " . $ItemRadicado['tel_remite'] . "<br>
						<strong>Fax:</strong> " . $ItemRadicado['fax_remite'] . "<br>
						<strong>E - Mail:</strong> " . $ItemRadicado['email_remite'] . "<br>
						<strong>Cargo :</strong> " . $ItemRadicado['cargo'] . "<br>

						<strong><h3>Destinatarios.</h3></strong>
						<strong>Responsable: " . $ResponsableRadicado . "<br>
						<strong>Destinaratios: " . $Destinatarios . "<br>
						";
			endforeach;

			$Mensaje = "<body>
			            <p><strong>" . $Funcionario->getNom_Funcio() . "</strong>,</p>
			            <p>El radicado <strong>" . $IdRadicadoMasivo[$i] . "</strong>, con el asunto <strong>'" . $Radicado->get_Asunto() . "'</strong>, Esta pronto a vence.</p>
			            <p>" . $InfoRadicado . "</p>
			            <p>Cordialmente, <br><br><br>Ventanilla unica.</p>
			            </body>";

			$mail->msgHTML($Mensaje);
			//Reemplace el cuerpo del texto sin formato con uno creado manualmente
			$mail->AltBody = 'Notificacion de radicado pronto a vencer';
			//Adjuntar un archivo de imagen
			//$mail->addAttachment('aqui archivo adjunto');

			//envía el mensaje, comprueba si hay errores
			if ($mail->send()) {
				$Notificacion = new NotificacionExternaEmail();
				$Notificacion->setAccion('INSERTAR_NOTIFICACION');
				$Notificacion->set_IdFuncioRegistra($_SESSION['SesionUsuaId']);
				$Notificacion->setId_FuncioDeta($Responsable->get_IdFuncio());
				$Notificacion->set_Titulo("El radicado " . $IdRadicadoMasivo[$i] . ", con el asunto '" . $Radicado->get_Asunto() . ", Esta pronto a vence");
				$Notificacion->set_Notificacion('');
				$Notificacion->set_IdRadica($IdRadicadoMasivo[$i]);
				$Notificacion->set_Email($Funcionario->getEmail());
				$Notificacion->Gestionar();
			}
		}

		echo 1;
		exit();
		break;

	default:
		echo "No hay accion para realizar";
		break;
}
