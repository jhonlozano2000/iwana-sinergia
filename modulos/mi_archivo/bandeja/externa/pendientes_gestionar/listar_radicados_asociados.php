 <!-- BEGIN PLUGIN CSS -->
 <link href="../../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
 <link href="../../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
 <!-- END PLUGIN CSS -->

 <!-- BEGIN CORE CSS FRAMEWORK -->
 <link href="../../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
 <link href="../../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
 <link href="../../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
 <link href="../../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
 <link href="../../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
 <!-- END CORE CSS FRAMEWORK -->

 <!-- BEGIN CSS TEMPLATE -->
 <link href="../../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
 <link href="../../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
 <link href="../../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
 <!-- END CSS TEMPLATE -->
 <script src="../../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
 <link href="../../../../../public/assets/css/botones_redondos.css" rel="stylesheet" type="text/css"/>
 <?php
 session_start();
 include "../../../../../config/class.Conexion.php";
 require_once '../../../../clases/radicar/class.RadicaEnviadoTemp.php';
 ?>
 <table class="table table-hover table-condensed" id="Tbl1">
    <thead>
        <tr>
            <th>Id. Radicado</th>
            <th>Asunto</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $RadicadoTemp = RadicadoEnviadoTemp::Listar_Varios('RADICADOS_ASOCIADOS', $_REQUEST['IdTemp'], "", "", "", "", "", "", "");
        foreach($RadicadoTemp as $Item):
            ?>
            <tr>
                <td class="v-align-middle">
                    <span class="muted">
                        <?php echo $Item['id_radica']; ?>
                    </span>
                </td>
                <td class="v-align-middle"><?php echo $Item['asunto']; ?></td>
                <td>
                    <button type="button" class="btn btn-success btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoEnviado" data-id_radicado="<?php echo $Item['id_radica']; ?>" id="BtnMostarInfoRadicadoRecibido" title="Info. Radicados">
                        <i class="fa fa-class text-white"></i>
                    </button>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>
<script src="../../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
<script src="../../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script> 
<script src="../../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="../../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<!-- END CORE JS FRAMEWORK --> 
<!-- BEGIN PAGE LEVEL JS -->    
<script src="../../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
<script src="../../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="../../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL PLUGINS -->     
<script src="../../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS --> 
<script src="../../../../../public/assets/js/core.js" type="text/javascript"></script> 
<script src="../../../../../public/assets/js/chat.js" type="text/javascript"></script> 
<script src="../../../../../public/assets/js/demo.js" type="text/javascript"></script> 
<!-- END CORE TEMPLATE JS --> 
<!-- END JAVASCRIPTS -->
<script src="../../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
<link href="../../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">