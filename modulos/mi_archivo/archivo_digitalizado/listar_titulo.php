<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/oficina_archivo/class.OficinaArchivoDigitalizacion.php';
require_once '../../clases/general/class.GeneralFuncionarioAccesoDigitalizados.php';

$Titulo = Digitalizacion::Listar(8, $_REQUEST['id_expediente'], "", "", "", "", "", "", "", "");

foreach($Titulo as $ItemTitulo){
	?>
	<span class="semi-bold">
		<span class="text-success">
			<?php echo $ItemTitulo['nom_depen'].", </span></span>".$ItemTitulo['cod_serie'].".".$ItemTitulo['nom_serie']." - ".$ItemTitulo['cod_subserie'].".".$ItemTitulo['nom_subserie']." - ".$ItemTitulo['titulo']; ?>.
			

			<?php
		}
		?>