<?php
require_once '../../../clases/general/class.GeneralFuncionario.php';
?>

<!-- BEGIN MODAL PARA LOS DESTINATARIOS-->
<div class="modal fade" id="myModalTodosLosFuncionarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-users fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                <p class="no-margin">Elige los funcionarios a los cuales les vas a enviar la correspondencia</p>
                <br>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <table class="table table-hover table-condensed" id="Tbl1">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">
                                                <div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
                                                    <input type="checkbox" value="1" id="checkbox0">
                                                    <label for="checkbox0"></label>
                                                </div>
                                            </th>
                                            <th style="width:1%">J</th>
                                            <th style="width:2%">F</th>
                                            <th style="width:30%">Funcionario</th>
                                            <th style="width:30%">Oficina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($Funcionario as $Item):
                                            ?>
                                            <tr>
                                                <td class="v-align-middle">
                                                    <div class="checkbox check-default">
                                                        <input type="checkbox"
                                                        value="<?php echo $Item['id_funcio_deta']; ?>"
                                                        name="ChkDestinatarios[]"
                                                        id="ChkDestinatarios<?php echo $Item['id_funcio_deta']; ?>"
                                                        data-nombre_destinatario="<?php echo $Item['nom_funcio']." ".$Item['ape_funcio']; ?>"
                                                        data-oficina_destinatario="<?php echo $Item['nom_oficina']; ?>" 
                                                        data-id_dependencia_destinatario="<?php echo $Item['id_depen']; ?>" 
                                                        data-id_oficina_destinatario="<?php echo $Item['id_oficina']; ?>">
                                                        <label for="ChkDestinatarios<?php echo $Item['id_funcio_deta']; ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="v-align-middle">
                                                    <?php
                                                    if($Item['jefe_dependencia'] == 1){
                                                        ?>
                                                        <span class="text-info">
                                                            <strong>
                                                                <i class="fa fa-check text-success"></i>
                                                            </strong>
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="v-align-middle">
                                                    <?php
                                                    if($Item['puede_firmar'] == 1){
                                                        ?>
                                                        <span class="text-info"><strong><i class="fa fa-check text-success"></i></strong></span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="v-align-middle">
                                                    <span class="muted">
                                                        <?php 
                                                        echo $Item['nom_funcio']." ".$Item['ape_funcio']; 
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="v-align-middle"><?php echo $Item['nom_depen']." - ".$Item['nom_oficina']; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarDestinatarios">Llevar</button>
            </div>
        </div>
    </div>
</div>
        <!-- END MODAL PARA DESTINATARIOS-->