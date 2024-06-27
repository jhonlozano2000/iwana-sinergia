<div class="header-seperation"> 
    <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">	
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" > <div class="iconset top-menu-toggle-white"></div> </a> </li>		 
    </ul>
    <!-- BEGIN LOGO -->	
    <a href="<?php echo MI_ROOT.'/panel.php'; ?>">
        <img src="<?php echo MI_LOGO; ?>" class="logo" alt=""  data-src="<?php echo MI_LOGO; ?>" data-src-retina="<?php echo MI_LOGO_2X; ?>" width="106" height="21"/>
    </a>
    <!-- END LOGO --> 
    <ul class="nav pull-right notifcation-center">	
        <li class="dropdown" id="header_task_bar"> 
            <a href="<?php echo MI_ROOT.'/panel.php'; ?>" class="dropdown-toggle active" data-toggle=""> 
                <div class="iconset top-home"></div> 
            </a> 
        </li>
        <li class="dropdown" id="header_inbox_bar" > 
            <a href="" class="dropdown-toggle" > 
                <div class="iconset top-messages"></div>  
                <span class="badge" id="msgs-badge">2</span> 
            </a>
        </li>
        <li class="dropdown" id="portrait-chat-toggler" style="display:none"> 
            <a href="#sidr" class="chat-menu-toggle"> 
                <div class="iconset top-chat-white "></div> 
            </a> 
        </li>        
    </ul>
</div>
<!-- END RESPONSIVE MENU TOGGLER --> 
<div class="header-quick-nav" > 
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="pull-left"> 
        <ul class="nav quick-section">
            <li class="quicklinks"> 
                <a href="#" class="" id="layout-condensed-toggle" >
                    <div class="iconset top-menu-toggle-dark"></div>
                </a> 
            </li>
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
    <!-- BEGIN CHAT TOGGLER -->
    <div class="pull-right"> 
        <div class="chat-toggler">	
            <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom"  data-content='' data-toggle="dropdown" data-original-title="Notifications">
                <div class="user-details"> 
                    <div class="username">
                       <span class="badge badge-important">3</span> 
                       <?php echo htmlspecialchars($_SESSION['SesionFuncioNom'], ENT_QUOTES); ?> 
                       <span class="bold"><?php echo htmlspecialchars($_SESSION['SesionFuncioApe'], ENT_QUOTES); ?></span> 							
                   </div>						
               </div> 
               <div class="iconset top-down-arrow"></div>
           </a>	
           <div id="notification-list" style="display:none">
            <div style="width:300px">
                <div class="notification-messages info">
                    <div class="user-profile">

                    </div>
                    <div class="message-wrapper">

                    </div>
                    <div class="clearfix"></div>									
                </div>	
            </div>				
        </div>
        <div class="profile-pic">
            
            <?php
            if($_SESSION['SesionFuncioImagenPerfil'] != ""){
                $ImagenDePerfil = $RutaMiServidor."/archivos/fotos_perfil/".$_SESSION['SesionFuncioImagenPerfil'];
                ?>
                <img src="<?php echo $ImagenDePerfil; ?>"  alt="" data-src="<?php echo $ImagenDePerfil; ?>" data-src-retina="<?php echo $ImagenDePerfil; ?>" width="35" height="35" /> 
                <?php
            }else{
                if($_SESSION['SesionFuncioSexo'] == 'M'){
                    ?>
                    <img src="<?php echo AVATAR_M; ?>"  alt="" data-src="<?php echo AVATAR_M; ?>" data-src-retina="<?php echo AVATAR_SMALL_2X_M; ?>" width="35" height="35" /> 

                    <?php
                }else{
                    ?>
                    <img src="<?php echo AVATAR_F; ?>"  alt="" data-src="<?php echo AVATAR_F; ?>" data-src-retina="<?php echo AVATAR_SMALL_2X_F; ?>" width="35" height="35" /> 
                    <?php
                }
            }
            ?>
        </div>       			
    </div>
    <ul class="nav quick-section ">
        <li class="quicklinks"> 
            <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">						
                <div class="iconset top-settings-dark "></div> 	
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                <li> <a href="<?php echo MI_ROOT; ?>/modulos/seguridad/mi_cuenta/index.php">
                    <i class="fa fa-user"></i>
                    Mi Cuenta
                </a>
            </li>
            <li><a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/externa/recibidas//index.php"> Mi bandeja de entrada&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a> </li>
            <li class="divider"></li>
            <li><a href="<?php echo LOG_OUT; ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Salir</a></li>
            <li class="divider"></li>
            <li>
                <a href="" data-toggle="modal" data-target="#myModalAyuda">
                    <i class="fa fa-help"></i>&nbsp;&nbsp;Ayuda
                </a>
            </li>
        </ul>
    </li> 
    <li class="quicklinks"> <span class="h-seperate"></span></li> 
    <li class="quicklinks"> 	
        <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" ><div class="iconset top-chat-dark "><span class="badge badge-important hide" id="chat-message-count">1</span></div>
        </a> 
        <div class="simple-chat-popup chat-menu-toggle hide" >
            <div class="simple-chat-popup-arrow"></div><div class="simple-chat-popup-inner">
                <div style="width:100px">
                    <div class="semi-bold">David Nester</div>
                    <div class="message">Hey you there </div>
                </div>
            </div>
        </div>
    </li> 
</ul>
</div>
<!-- END CHAT TOGGLER -->
</div> 
<!-- END TOP NAVIGATION MENU --> 


<div class="modal fade" id="myModalAyuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-credit-card fa-2x text-info"></i>
                <h4 id="myModalLabel" class="semi-bold text-info">Ayuda.</h4>
                <div id="ojo"></div>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <th width="95%">Manual</th>
                                        <th width="5%"></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="v-align-middle">
                                                Ventanilla Unica
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="<?php echo MI_ROOT; ?>/archivos/ayuda/Maual de usuario modulo Ventanilla Unica-convertido.pdf" target="_blank">
                                                    <i class="fa fa-cloud-download text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle">
                                                Oficina de Archivo
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="<?php echo MI_ROOT; ?>/archivos/ayuda/Maual de usuario modulo Ofic archivo-convertido.pdf" target="_blank">
                                                    <i class="fa fa-cloud-download text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle">
                                                Configuracion
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="<?php echo MI_ROOT; ?>/archivos/ayuda/Maual de usuario modulo Configuracion-convertido.pdf" target="_blank">
                                                    <i class="fa fa-cloud-download text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>