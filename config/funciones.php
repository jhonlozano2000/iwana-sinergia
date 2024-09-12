<?php
function Fecha_Actual()
{
    $conexion = new Conexion();
    $SqlBuscar = "SELECT DATE(NOW()) AS fecha";
    $InstrucBuscar = $conexion->prepare($SqlBuscar);
    $InstrucBuscar->execute() or die(print_r($InstrucBuscar->errorInfo() . " - " . $SqlBuscar, true));
    $Result = $InstrucBuscar->fetch();
    $conexion = null;
    return $Result['fecha'];
}

function Fecha_Hora_Actual()
{
    $conexion = new Conexion();
    $SqlBuscar = "SELECT NOW() AS fecha";
    $InstrucBuscar = $conexion->prepare($SqlBuscar);
    $InstrucBuscar->execute() or die(print_r($InstrucBuscar->errorInfo() . " - " . $SqlBuscar, true));
    $Result = $InstrucBuscar->fetch();
    $conexion = null;
    return $Result['fecha'];
}

function Fecha_Corta_Español($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    if ($anio = date('Y')) {
        return $numeroDia . " " . $nombreMes;
    } else {
        return $numeroDia . " " . $nombreMes . " de " . $anio;
    }
}

function Fecha_Larga_Español($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));

    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}

function Crear_Dir_Temp($Ruta)
{
    if (!is_dir($Ruta))
        @mkdir($Ruta, 0777);
}

function Convertir_Fecha_A_Mysql($fecha)
{
    if ($fecha != "") {
        list($mes, $dia, $ano) = explode("/", $fecha);
        $fecha = "$ano-$mes-$dia";
    } else {
        $fecha = "";
    }
    return $fecha;
}

function Convertir_Fecha_A_Mysql_DMY($fecha)
{
    if ($fecha != "") {
        list($dia, $mes, $ano) = explode("/", $fecha);
        $fecha = "$ano-$mes-$dia";
    } else {
        $fecha = "";
    }
    return $fecha;
}

function Convertir_Fecha_A_Mysql_MDY($fecha)
{
    echo $fecha;
    exit();
    if ($fecha != "") {
        list($dia, $mes, $ano) = explode("/", $fecha);
        $fecha = "$dia-$mes-$ano";
    } else {
        $fecha = "";
    }
    return $fecha;
}

function Elimina_Archivo($Ruta)
{
    if (file_exists($Ruta)) {
        if (unlink($Ruta)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Esta función devuelve el número de páginas de un archivo pdf
 * Tiene que recibir la ubicación y nombre del archivo
 */
function NumeroPaginasPdf($archivoPDF)
{
    $stream = fopen($archivoPDF, "r");
    $content = fread($stream, filesize($archivoPDF));

    if (!$stream || !$content)
        return 0;

    $count = 0;

    $regex  = "/\/Count\s+(\d+)/";
    $regex2 = "/\/Page\W*(\d+)/";
    $regex3 = "/\/N\s+(\d+)/";

    if (preg_match_all($regex, $content, $matches))
        $count = max($matches);

    return $count[0];
}

function deleteDirectory($dir)
{
    if (!$dh = @opendir($dir)) return;
    while (false !== ($current = readdir($dh))) {
        if ($current != '.' && $current != '..') {
            //echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
            if (!@unlink($dir . '/' . $current))
                deleteDirectory($dir . '/' . $current);
        }
    }
    closedir($dh);
    //echo 'Se ha borrado el directorio '.$dir.'<br/>';
    @rmdir($dir);
    return true;
}

function validar_clave($clave)
{
    if (strlen($clave) < 6) {
        echo "La clave debe tener al menos 6 caracteres";
        return false;
    }
    if (strlen($clave) > 16) {
        echo "La clave no puede tener más de 16 caracteres";
        return false;
    }
    if (!preg_match('`[a-z]`', $clave)) {
        echo "La clave debe tener al menos una letra minúscula";
        return false;
    }
    if (!preg_match('`[A-Z]`', $clave)) {
        echo "La clave debe tener al menos una letra mayúscula";
        return false;
    }
    if (!preg_match('`[0-9]`', $clave)) {
        echo "La clave debe tener al menos un caracter numérico";
        return false;
    }

    $error_clave = "";
    return true;
}

function Limpiar_Cadena($Cadena)
{
    if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])+$/", $Cadena)) {
        echo "Se encontraron caracteres no permitidos, por favor verifique la información suministrada. 1 - " . $Cadena;
        exit();
    } elseif (preg_match('/order|-|\s|,|@@version|user\(\)|tables|and|sleep|substr|substring|mid|(\|\|)|case/i', $Cadena)) {
        echo "Se encontraron caracteres no permitidos, por favor verifique la información suministrada. 2 - " . $Cadena;
        exit();
    } elseif (preg_match('/union|select|concat/', $Cadena)) {
        echo "Se encontraron caracteres no permitidos, por favor verifique la información suministrada. 3 - " . $Cadena;
        exit();
    }
}

function verificar_email($email)
{
    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
        return true;
    }
    return false;
}

function Encriptar($password, $cost = 11)
{
    // Genera sal de forma aleatoria
    $salt = substr(base64_encode(openssl_random_pseudo_bytes(17)), 0, 22);
    // reemplaza caracteres no permitidos
    $salt = str_replace("+", ".", $salt);
    // genera una cadena con la configuración del algoritmo
    $param = '$' . implode('$', array(
        "2y", // versión más segura de blowfish (>=PHP 5.3.7)
        str_pad($cost, 2, "0", STR_PAD_LEFT), // costo del algoritmo
        $salt // añade la sal
    ));

    // obtiene el hash de la contraseña
    return crypt($password, $param);
}

function validate_pass($hash, $pass)
{
    // verifica la contraseña con el hash
    return crypt($pass, $hash) == $hash;
}

function tiempoTranscurridoFechas($fechaInicio, $fechaFin)
{
    $fecha1 = new DateTime($fechaInicio);
    $fecha2 = new DateTime($fechaFin);
    $fecha = $fecha1->diff($fecha2);
    $tiempo = "";

    //años
    if ($fecha->y > 0) {
        $tiempo .= $fecha->y;

        if ($fecha->y == 1)
            $tiempo .= " año, ";
        else
            $tiempo .= " años, ";
    }

    //meses
    if ($fecha->m > 0) {
        $tiempo .= $fecha->m;

        if ($fecha->m == 1)
            $tiempo .= " mes, ";
        else
            $tiempo .= " meses, ";
    }

    //dias
    if ($fecha->d > 0) {
        $tiempo .= $fecha->d;

        if ($fecha->d == 1)
            $tiempo .= " día, ";
        else
            $tiempo .= " días, ";
    }

    //horas
    if ($fecha->h > 0) {
        $tiempo .= $fecha->h;

        if ($fecha->h == 1)
            $tiempo .= " hora, ";
        else
            $tiempo .= " horas, ";
    }

    //minutos
    if ($fecha->i > 0) {
        $tiempo .= $fecha->i;

        if ($fecha->i == 1)
            $tiempo .= " minuto";
        else
            $tiempo .= " minutos";
    } else if ($fecha->i == 0) //segundos
        $tiempo .= $fecha->s . " segundos";

    return $tiempo;
}

function Dias_Habiles($from, $to)
{
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;

        $days++;
    }
    return $days;
}

function DiasParaRespuesta($FecRadica, $FecVenci)
{
    $workingDays = [1, 2, 3, 4, 5];
    $interval = new DateInterval('P1D');
    $FecRadica = new DateTime($FecRadica);
    $FecVenci = new DateTime($FecVenci . " 00:00");
    $FecVenci->modify('+1 day');
    $DodosLosDias = new DatePeriod($FecRadica, $interval, $FecVenci);

    $Total = 0;
    foreach ($DodosLosDias as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        $Total++;
    }

    return $Total - 1;
}

function DiasTrascurridos($FecRadica)
{
    $workingDays = [1, 2, 3, 4, 5];
    $interval = new DateInterval('P1D');

    $FecRadica = new DateTime($FecRadica);
    $FechaActual = new DateTime(Fecha_Actual());
    $FechaActual->modify('+1 day');
    $DodosLosDias = new DatePeriod($FecRadica, $interval, $FechaActual);

    $Total = 0;
    foreach ($DodosLosDias as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        $Total++;
    }

    return $Total;
}

function SumarDiasHabiles($fecha, $dias)
{
    $datestart = strtotime($fecha);
    $datesuma = 15 * 86400;
    $diasemana = date('N', $datestart);
    $totaldias = $diasemana + $dias;
    $findesemana = intval($totaldias / 5) * 2;
    $diasabado = $totaldias % 5;
    if ($diasabado == 6) $findesemana++;
    if ($diasabado == 0) $findesemana = $findesemana - 2;

    $total = (($dias + $findesemana) * 86400) + $datestart;
    return $fechafinal = date('Y-m-d', $total);
}

function Extencion_Archivo($Archivo)
{
    $info = new SplFileInfo($Archivo);
    return $info->getExtension();
}

function getRealIP()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function nombreAleatorioArchivo($archivo)
{
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(md5(rand(0, PHP_INT_MAX)), 10) . substr(str_shuffle($permitted_chars), 0, 30) . "." . $extension;
}

// Función para cifrar el ID de usuario
$key = 'a3f89b12c4d56e7f90a1b234c56d78e9a1b2c34d5e67f8a9b0c1234d5e67f890'; // Clave segura para el cifrado
function encrypt($dato, $key)
{
    return base64_encode(openssl_encrypt($dato, 'aes-256-cbc', $key, 0, substr(hash('sha256', $key), 0, 16)));
}

// Función para descifrar el ID de usuario
function decrypt($dato, $key)
{
    return openssl_decrypt(base64_decode($dato), 'aes-256-cbc', $key, 0, substr(hash('sha256', $key), 0, 16));
}


function encodeBase64($file)
{
    // Lee el contenido del archivo
    $file_content = file_get_contents($file);

    // Codifica el contenido en Base64
    $base64_encoded = base64_encode($file_content);

    // Muestra el resultado o lo guarda en un archivo
    return $base64_encoded;
}

function decodeBase64($file)
{
    // Decodifica el contenido Base64
    $decoded_content = base64_decode($file);

    return $decoded_content;
}

function donwloadBase64($file_decoded_content, $file_name)
{
    // Establecer cabeceras para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file_name . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($file_decoded_content));

    // Enviar el archivo decodificado al navegador para su descarga
    echo $file_decoded_content;
}
