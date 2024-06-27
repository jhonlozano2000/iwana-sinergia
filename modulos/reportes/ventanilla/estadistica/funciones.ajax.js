$(document).ready(function(){

	$('#sandbox-advance').focus();

	$('#BtnConsultar').click(function(e){
		
		$.ajax({
			url: 'acciones.ajax.php',
			method: "GET",
			//data: 'accion=TOTAL_POR_DEPENDENCIAS&fecha_ini='+$('#sandbox-advance').val()+'&fecha_fin='+$('#sandbox-advance1').val(),
			beforeSend: function(){
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Generando backup’s del repositorio de archivo de la correspondencia recibida, por favor espere. </div>');
			},
			success:function(msj){
				console.log(msj);
				var randomScalingFactor = function() {
					return Math.round(Math.random() * 100);
				};

				var Dependencia = [];
				var Total = [];
				
				for(var i in msj) {
					Dependencia.push(msj[i].nom_depen);
					alert(msj[i].nom_depen)
					Total.push(msj[i].Total);

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
			},
			error:function(msj){
				$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});
});