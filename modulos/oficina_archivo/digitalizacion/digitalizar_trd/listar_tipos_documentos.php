<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	include "../../../../config/class.Conexion.php";
	require_once '../../../clases/retencion/calss.TRD.php';
	require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRD.php';

	$id_depen     = $_REQUEST["id_depen"];
	$id_serie     = $_REQUEST["id_serie"];
	$id_sub_serie = $_REQUEST["id_sub_serie"];

	$TRD = TRD::Listar(7, 0, $id_depen, $id_serie, $id_sub_serie, "");
	?>
	
	<div class="tab-content">
		<div class="tab-pane active" id="tab2hellowWorld">
			<div class="row column-seperation">
				<div class="col-md-12">
					<table width="100%" class="table table-bordered no-more-tables">
						<thead>
							<tr>
								<th class="text-center" style="width:20%">Tipos Documentales</th>
								<th class="text-center" style="width:10%">Folios</th>
								<th class="text-center" style="width:40%">Detalle</th>
								<th class="text-center" style="width:20%">Fecha</th>
								<th class="text-center" style="width:10%">Archivo</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($TRD as $Item):
								?>
								<tr>
									<td>
										<input name="id_tipodoc[]" type="hidden" value="<?php echo $Item['id_tipodoc']; ?>">
										<?php echo $Item['nom_tipodoc']; ?>
									</td>
									<td><input name="folios_archi[]" type="number" class="form-control" id="" placeholder="Folios"></td>
									<td><input name="detalle_archi[]" type="text" class="form-control" id="" placeholder="Detalle"></td>
									<td>
										<div class="input-append success date col-md-10 col-lg-6 no-padding">
											<input type="text" name="fecha_archi[]" class="form-control" id="fecha_archi" placeholder="Fec. Inicial">
											<span class="add-on">
												<span class="arrow"></span>
												<i class="fa fa-th"></i>
											</span>
										</div>
									</td>
								</td>
								<td>
									<div id="divRecorrer">
										<input type="file" id="file" name="file[]">
									</div>
								</td>
							</tr>
							<?php
						endforeach;
						?>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center">Tipos Documentales</th>
							<th class="text-center">Folios</th>
							<th class="text-center">Detalle</th>
							<th class="text-center">Feche</th>
							<th class="text-center">Archivo</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="tab2FollowUs">
		<div class="row">
			<div class="col-md-12">
				<table width="100%" class="table table-bordered no-more-tables">
					<thead>
						<tr>
							<th class="text-center" style="width:10%">Folios</th>
							<th class="text-center" style="width:60%">Detalle</th>
							<th class="text-center" style="width:20%">Fecha</th>
							<th class="text-center" style="width:10%">Archivo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input name="folios_archi_como_un_todo" type="number" class="form-control input-sm" id="" placeholder="Folios"></td>
							<td><input name="detalle_archi_como_un_todo" type="text" class="form-control input-sm" id="" placeholder="Detalle"></td>
							<td>
								<div class="input-append success date col-md-10 col-lg-6 no-padding">
									<input type="text" name="fecha_archi_como_un_todo" class="form-control" id="fecha_archi_como_un_todo" placeholder="Fec. Inicial">
									<span class="add-on">
										<span class="arrow"></span>
										<i class="fa fa-th"></i>
									</span>
								</div>
							</td>
							<td>
								<div id="divRecorrer">
									<input type="file" id="file_como_un_todo" name="file_como_un_todo" data-id_tipo_docu="como_un_todo">
								</div>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center">Folios</th>
							<th class="text-center">Detalle</th>
							<th class="text-center">Feche</th>
							<th class="text-center">Archivo</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<!-- END CORE JS FRAMEWORK --> 
<!-- BEGIN PAGE LEVEL JS --> 
<script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS --> 
<!-- PAGE JS --> 
<script src="../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
<script type="text/javascript">

	$('.input-append').datepicker({
		autoclose: true,
		todayHighlight: false
	});
</script>