<!-- BEGIN PLUGIN CSS -->
<link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
<!-- END PLUGIN CSS -->
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->

<?php
if(! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    include "../../../../config/class.Conexion.php";
    require_once '../../../clases/radicar/class.RadicaRecibidoListarPorVencer.php';

    $Registro = new RadicadoRecibidoProntoAVence();
    $Registro->set_Accion(13);

    ?>
    <table class="table table-hover table-condensed" id="example">
        <thead>
            <tr>
                <th style="width:1%">
                    <div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
                        <input type="checkbox" value="1" id="checkbox0">
                        <label for="checkbox0"></label>
                    </div>
                </th>
                <th style="width:30%">Radicado</th>
                <th style="width:30%">Asunto</th>
                <th style="width:30%">Funcionario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($Registro->Listar() as $Item):
                ?>
                <tr>
                    <td class="v-align-middle">
                        <div class="checkbox check-default">
                            <input name="ChkNotifica[]" type="checkbox" id="ChkNotifica<?php echo $Item['id_radica']; ?>" value="<?php echo $Item['id_radica']; ?>" checked="checked">
                            <label for="ChkNotifica<?php echo $Item['id_radica']; ?>"></label>
                        </div>
                    </td>
                    <td class="v-align-middle"><?php echo $Item['id_radica']; ?></td>
                    <td class="v-align-middle"><?php echo $Item['asunto']; ?></td>
                    <td class="v-align-middle">
                        <span class="muted">
                            <?php echo $Item['nom_funcio']." ".$Item['ape_funcio']; ?>
                        </span>
                    </td>

                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <?php
}
?>
<!-- BEGIN CORE JS FRAMEWORK-->

<script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>    
<script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="../../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../../public/assets/js/datatables.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
<script src="../../../../public/assets/js/chat.js" type="text/javascript"></script>
<script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
<!-- END JAVASCRIPTS -->