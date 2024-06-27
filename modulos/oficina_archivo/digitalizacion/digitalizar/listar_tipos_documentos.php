<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	include "../../../../config/class.Conexion.php";
	require_once '../../../clases/retencion/calss.TRD.php';
	require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacion.php';

	$id_depen     = $_REQUEST["id_depen"];
	$id_serie     = $_REQUEST["id_serie"];
	$id_sub_serie = $_REQUEST["id_sub_serie"];

	$TRD = TRD::Listar(7, 0, $id_depen, $id_serie, $id_sub_serie, "");
	?>
	<div class="tab-content">
		<div class="tab-pane active" id="tabListaChekeo">
			<div class="row column-seperation">
				<div class="col-md-12">
					<table width="100%" class="table table-bordered no-more-tables">
						<thead>
							<tr>
								<th class="text-center" style="width:20%">Tipos Documentales</th>
								<th class="text-center" style="width:10%">Folios</th>
								<th class="text-center" style="width:30%">Detalle</th>
								<th class="text-center" style="width:10%">Fecha</th>
								<th class="text-center" style="width:10%">Archivo</th>
								<th class="text-center" style="width:20%">Digitales</th>
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
									<td><input name="folios_archi[]" type="number" class="form-control input-sm" id="" placeholder="Folios"></td>
									<td><input name="detalle_archi[]" type="text" class="form-control input-sm" id="" placeholder="Detalle"></td>
									<td><input name="fecha_archi[]" type="text" class="form-control input-sm" id="" placeholder="Fecha"></td>
									<td>
										<div id="divRecorrer">
											<input type="file" id="file" name="file[]">
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-success btn-xs btn-mini" id="BtnVerListaCheck" data-toggle="modal" data-target="#myModalDigitalizados" data-id_tipodoc="<?php echo $Item['id_tipodoc']; ?>" data-tipo_documental="<?php echo $Item['nom_tipodoc']; ?>">
											<i class="fa fa-eye"></i>
										</button>
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
								<th class="text-center">Digitales</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tabComoUnTodo">
			<div class="row">
				<div class="col-md-12">
					<table width="100%" class="table table-bordered no-more-tables">
						<thead>
							<tr>
								<th class="text-center" style="width:10%">Folios</th>
								<th class="text-center" style="width:30%">Detalle</th>
								<th class="text-center" style="width:10%">Fecha</th>
								<th class="text-center" style="width:10%">Archivo</th>
								<th class="text-center" style="width:30%">Digitales</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input name="folios_archi_como_un_todo" type="text" class="form-control input-sm" id="" placeholder="Folios"></td>
								<td><input name="detalle_archi_como_un_todo" type="text" class="form-control input-sm" id="" placeholder="Detalle"></td>
								<td><input name="fecha_archi_como_un_todo" type="text" class="form-control input-sm" id="" placeholder="Fecha"></td>
								<td>
									<div id="divRecorrer">
										<input type="file" id="file_como_un_todo" name="file_como_un_todo" data-id_tipo_docu="como_un_todo">
									</div>
								</td>
								<td>
									<?php
									if(isset($_REQUEST["id_digital"])){
										$Archivos = Digitalizacion::Listar_Archivos(2, $_REQUEST["id_digital"], "");
										$Combo_Archivos = "";

										foreach($Archivos as $ItemArchivo):
											$Combo_Archivos.= "<option value='".$ItemArchivo['id_archivo']."'>".$ItemArchivo['archivo']."</option>";
										endforeach;
										?>
										<div class="row">
											<div class="col-md-8">
												<select name="id_tipo_docu_como_un_todo" id="id_tipo_docu_como_un_todo" class="select2 form-control"  >
													<option value="0">...::: Archivos Digitales :::...</option>
													<?php echo $Combo_Archivos; ?>
												</select>
											</div>
											<div class="col-md-4">
												<button type="button" class="btn btn-success btn-xs btn-mini" id="BtnVerComoUnTodo" data-archivo="<?php echo $ItemArchivo['archivo']; ?>">
													<i class="fa fa-eye"></i>
												</button>
												<button type="button" class="btn btn-warning btn-xs btn-mini" id="BtnEliminarComoUnTodo" data-archivo="<?php echo $ItemArchivo['archivo']; ?>">
													<i class="fa fa-trash"></i>
												</button>
											</div>
										</div>
										<?php
									}
									?>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th class="text-center">Folios</th>
								<th class="text-center">Detalle</th>
								<th class="text-center">Feche</th>
								<th class="text-center">Archivo</th>
								<th class="text-center">Digitales</th>
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
