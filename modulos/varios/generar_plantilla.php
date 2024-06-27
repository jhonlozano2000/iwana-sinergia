<?php
session_start();
require_once "../../config/class.Conexion.php";
require_once '../../config/variable.php';
require_once "../../config/funciones.php";
require_once "../../config/funciones_seguridad.php";
require_once '../clases/configuracion/class.ConfigOtras.php';

require_once MI_ROOT_RELATIVA . "/config/lib/phpword/PHPWord-master/src/PhpWord/Autoloader.php";

\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\Stringg as POString;

$ConfiguraOtras = ConfigOtras::Buscar();

$templateWord = new TemplateProcessor(MI_ROOT_RELATIVA . '/archivos/otros/' . $ConfiguraOtras->get_PlantiCorrespon());
$Extencion = Extencion_Archivo($ConfiguraOtras->get_PlantiCorrespon());

$templateWord->setValue('IDTEMP', POString::toUTF8($_REQUEST['id_temp']));
$templateWord->setValue('ASUNTO_ENCABEZADO', $_REQUEST['Asunto']);
$templateWord->setValue('CIUDAD', $_REQUEST['Ciudad']);
$templateWord->setValue('STATUS', $_REQUEST['Status']);
$templateWord->setValue('DESTINATARIO', $_REQUEST['DestinaContacto']);
$templateWord->setValue('CARGO_DESTINATARIO', $_REQUEST['DestinaCargo']);
$templateWord->setValue('RAZON_SOCIAL', $_REQUEST['DestinaRazonSocial']);
$templateWord->setValue('DIRECCION', str_replace("#", "No", $_REQUEST['DestinaDireccion']));
$templateWord->setValue('DOMICILIO', str_replace("#", "No", $_REQUEST['DestinaDomicilio']));
$templateWord->setValue('ASUNTO', $_REQUEST['Asunto']);
$templateWord->setValue('SALUDO', $_REQUEST['Saludo']);
$templateWord->setValue('DESPEDIDA', $_REQUEST['Despedida']);
$templateWord->setValue('QUIENES_FIRMAN', $_REQUEST['QuienesFirman']);
$templateWord->setValue('ANEXOS', $_REQUEST['Anexos']);
$templateWord->setValue('CON_COPIA', $_REQUEST['Con_Copia']);
$templateWord->setValue('APROBADO_POR', $_REQUEST['Aprobado_Por']);
$templateWord->setValue('PROYECTOR', $_REQUEST['Proyector']);
$templateWord->setValue('CLASIFICACION_DOCUMENTAL', $_REQUEST['Clasificacion_Documental']);

$NombreArchivo = $_REQUEST['id_temp'] . ' - ' . str_replace("Asunto: ", "", substr($_REQUEST['Asunto'], 0, 70)) . '.' . $Extencion;

$templateWord->saveAs($NombreArchivo);

header("Content-Disposition: attachment; filename=" . $NombreArchivo . "; charset=iso-8859-1");
echo file_get_contents($NombreArchivo);

unlink($NombreArchivo);
