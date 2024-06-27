<?php
include "../../../../config/class.Conexion.php";
require_once '../../../clases/oficina_archivo/tvd/calss.TVD.php';

$id_oficina = isset($_POST['id_oficina']) ? $_POST['id_oficina'] : null;

if($id_oficina == ""){
    $TablaRetencion = TVD::Listar(5, 0, $_POST['id_depen'], "", "", "");
}else{
    $TablaRetencion = TVD::Listar(12, 0, $_POST['id_depen'], $id_oficina, "", "");
}

foreach($TablaRetencion as $Item):

    if($Item['acti'] == 1){
        $checked = "checked";
    }else{
        $checked = "";
    }

    $CheckCT = "";
    if($Item['ct'] == 1){
        $CheckCT = "checked";
    }

    $CheckE = "";
    if($Item['e'] == 1){
        $CheckE = "checked";
    }

    $CheckDM = "";
    if($Item['dm'] == 1){
        $CheckDM = "checked";
    }

    $CheckS = "";
    if($Item['s'] == 1){
        $CheckS = "checked";
    }
    ?>
    <tr>
        <td>
            <div class="checkbox check-success">
                <?php
                if($Item['acti'] == 1){
                    $checked = "checked";
                }else{
                    $checked = "";
                }
                ?>
                <input id="actiTVD<?php echo $Item['id_tvd']; ?>" class="actiTVD" type="checkbox" <?php echo $checked; ?> data-id_tvd="<?php echo $Item['id_tvd']; ?>">
                <label for="actiTVD<?php echo $Item['id_tvd']; ?>"></label>
            </div>
        </td>
        <td>
            <?php 
            if($id_oficina == ""){
                echo $Item['cod_depen'].".".$Item['cod_serie'].".".$Item['cod_subserie']; 
            }else{
                echo $Item['cod_oficina'].".".$Item['cod_serie'].".".$Item['cod_subserie']; 
            }
            ?>
        </td>
        <td><?php echo $Item['nom_serie']; ?></td>
        <td><button type="button" class="btn btn-warning btn-xs btn-mini" data-toggle="modal" data-target="#myModalSubseries" id="BtnBuscarSubserie" data-id_subserie="<?php echo $Item['id_subserie']; ?>"  data-nom_subserie="<?php echo $Item['nom_subserie']; ?>"><i class="fa fa-eye"></i> </button> <?php echo $Item['nom_subserie']; ?></td>
        <td>
            <input name="Txtag" type="text" class="form-control input-sm" id="Txtag" placeholder="A.G" value="<?php echo $Item['ag']; ?>" data-id_tvd="<?php echo $Item['id_tvd']; ?>">
        </td>
        <td>
            <input name="Txtac<?php echo $Item['id_tvd']; ?>" type="text" class="form-control input-sm" id="Txtac<?php echo $Item['id_tvd']; ?>" placeholder="A.C" value="<?php echo $Item['ac']; ?>">
        </td>
        <td>
            <div class="checkbox check-success">
                <input name="Chkct<?php echo $Item['id_tvd']; ?>" id="Chkct<?php echo $Item['id_tvd']; ?>" class="DispoFinal_ct" type="checkbox" value="<?php echo $Item['id_tvd']; ?>" <?php echo $CheckCT; ?> data-id_tvd="<?php echo $Item['id_tvd']; ?>">
                <label for="Chkct<?php echo $Item['id_tvd']; ?>" ></label>
            </div>
        </td>
        <td>
            <div class="checkbox check-success">
                <input name="Chke<?php echo $Item['id_tvd']; ?>" id="Chke<?php echo $Item['id_tvd']; ?>" class="DispoFinal_e" type="checkbox" value="<?php echo $Item['id_tvd']; ?>" <?php echo $CheckE; ?> data-id_tvd="<?php echo $Item['id_tvd']; ?>">
                <label for="Chke<?php echo $Item['id_tvd']; ?>"></label>
            </div>
        </td>
        <td>
            <div class="checkbox check-success">
                <input name="Chkdm<?php echo $Item['id_tvd']; ?>" id="Chkdm<?php echo $Item['id_tvd']; ?>" class="DispoFinal_dm" type="checkbox" value="<?php echo $Item['id_tvd']; ?>" <?php echo $CheckDM; ?> data-id_tvd="<?php echo $Item['id_tvd']; ?>">
                <label for="Chkdm<?php echo $Item['id_tvd']; ?>"></label>
            </div>
        </td>
        <td>
            <div class="checkbox check-success">
                <input name="Chks<?php echo $Item['id_tvd']; ?>" id="Chks<?php echo $Item['id_tvd']; ?>" class="DispoFinal_s" type="checkbox" value="<?php echo $Item['id_tvd']; ?>" <?php echo $CheckS; ?> data-id_tvd="<?php echo $Item['id_tvd']; ?>">
                <label for="Chks<?php echo $Item['id_tvd']; ?>"></label>
            </div>
        </td>
    </tr>
    <?php
endforeach;
?>

