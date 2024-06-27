<?php
require('../../../../config/class.Conexion.php');
require('../../../../config/funciones.php');
require_once("../../../clases/seguridad/class.SeguridadUsuario.php");
require_once '../../../clases/reportes/radica/class.ReportRadicacionRecibido.php';

$TotalFinal = array();
$Label = array();
$Total = ReportRadicacionRecibido::Listar_Totales(1, '2018-01-01', '2018-03-31', "", "", "", "", "", "", "");

$i=0;
foreach($Total as $Item){
	$TotalFinal[] = $Item;
}
?>

	<script src="../../../../public/assets/js/Chart.bundle.js"></script>
	<script src="../../../../public/assets/js/utils.js"></script>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>

	<div id="canvas-holder" style="width:40%">
		<canvas id="chart-area"></canvas>
	</div>
		
	<script>
		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var Dependencia = [];
		var Total = [];
		var TotalFinal = <?php echo json_encode($TotalFinal);?>;
		for(var i in TotalFinal) {
			Dependencia.push(TotalFinal[i].nom_depen);
			Total.push(TotalFinal[i].Total);
		}
		
		var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: Total,
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.orange,
						window.chartColors.yellow,
						window.chartColors.purple,
						window.chartColors.blue,
						window.chartColors.cornflowerblue,
						window.chartColors.grey,
						window.chartColors.navy
					],
					label: 'Dataset 1'
				}],
				labels: Dependencia
			},
			options: {
				responsive: true,
				legend: {
					position: 'left',
				},
				title: {
					display: true,
					text: 'Estadistica por dependencia'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myDoughnut = new Chart(ctx, config);
		};
		
		var colorNames = Object.keys(window.chartColors);
		
	</script>