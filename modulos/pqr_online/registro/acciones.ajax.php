<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    require_once "../../../config/class.Conexion.php";
    require_once "../../../config/funciones.php";
    require_once "../../../config/variable.php";
    require_once "../../clases/general/class.GeneralTercero.php";

    $Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
    $IdContac        = isset($_POST['id_contac']) ? $_POST['id_contac'] : null;
    $IdDeparContacto = isset($_POST['id_depar_contac']) ? $_POST['id_depar_contac'] : null;
    $IdMuniContacto  = isset($_POST['id_muni_contac']) ? $_POST['id_muni_contac'] : null;
    $IdTipoDocu      = isset($_POST['id_tipo_docu']) ? $_POST['id_tipo_docu'] : null;
    $NumDocumento    = isset($_POST['num_docu_contac']) ? $_POST['num_docu_contac'] : null;
    $NomContacto     = isset($_POST['nom_contac']) ? $_POST['nom_contac'] : null;
    $DirContacto     = isset($_POST['dir_contac']) ? $_POST['dir_contac'] : null;
    $TelContacto     = isset($_POST['tel_contac']) ? $_POST['tel_contac'] : null;
    $CelContacto     = isset($_POST['cel_contac']) ? $_POST['cel_contac'] : null;
    $EmailContacto   = isset($_POST['email_contac']) ? $_POST['email_contac'] : null;
    $Password   = isset($_POST['password']) ? $_POST['password'] : null;

    $existeTercero = Tercero::Buscar(4, "", "", "", "", $NumDocumento, "");
    if (!$existeTercero) {
        $Accion = "NUEVO_TERCERO_PQR";
    } else {
        $Accion = "EDITAR_TERCERO_PQR";
        $IdContac = $existeTercero->getId_Remite();
    }

    $existeEmail = Tercero::Buscar(15, "", "", "", $EmailContacto, "", "");
    if ($existeEmail) {
        echo "Ya se se encuentra registrado el email";
        exit();
    }

    $error_encontrado = "";

    if (!validar_clave($Password)) {
        echo $error_encontrado;
        exit();
    }

    $Password = Encriptar($Password);

    $Tercero = new Tercero();
    $Tercero->set_Accion($Accion);
    $Tercero->setId_Reite($IdContac);
    $Tercero->setId_Depar($IdDeparContacto);
    $Tercero->setId_Muni($IdMuniContacto);
    $Tercero->setId_TipoDocu($IdTipoDocu);
    $Tercero->setNum_Documetno($NumDocumento);
    $Tercero->setNom_Contacto($NomContacto);
    $Tercero->set_Dir(str_replace("#", "No.", $DirContacto));
    $Tercero->set_Tel($TelContacto);
    $Tercero->set_Cel($CelContacto);
    $Tercero->set_Email($EmailContacto);
    $Tercero->set_Password($Password);
    if ($Tercero->Gestionar() == true) {
        echo "1####" . $Tercero->getId_Remite();
        exit();
    }
}
