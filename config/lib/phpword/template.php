<?php

require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';

\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;

$templateWord = new TemplateProcessor('plantilla.doc');
 
$nombre = "Sandra S.L.";
$direccion = "Mi direcci�n";
$municipio = "Mrd";
$provincia = "Bdj";
$cp = "02541";
$telefono = "24536784";


// --- Asignamos valores a la plantilla
$templateWord->setValue('nombre_empresa',$nombre);
$templateWord->setValue('direccion_empresa',$direccion);
$templateWord->setValue('municipio_empresa',$municipio);
$templateWord->setValue('provincia_empresa',$provincia);
$templateWord->setValue('cp_empresa',$cp);
$templateWord->setValue('telefono_empresa',$telefono);

// --- Guardamos el documento
$templateWord->saveAs('Documento02.doc');

header("Content-Disposition: attachment; filename=Documento02.doc; charset=iso-8859-1");
echo file_get_contents('Documento02.doc');
        
?>