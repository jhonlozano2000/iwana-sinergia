<ul>
	<?php
	$res = arboldeCategoriasLista();
	foreach ($res as $r) {
		echo $r;
	}
	?>
</ul>
<?php

function arboldeCategoriasLista($parent = 0, $user_tree_array = '')
{
	$conexion = new Conexion();
	if (!is_array($user_tree_array))
		$user_tree_array = array();

	$sql = "SELECT `id_modu`, `nom_modu`, `modu_padre`
			FROM `segu_modu`
			WHERE 1 AND `modu_padre` = $parent
			ORDER BY id_modu ASC";

	$query = $conexion->prepare($sql);
	$query->execute();
	$total = $query->rowCount();

	if ($total > 0) {
		$user_tree_array[] = "<ul>";
		while ($row = $query->fetch(PDO::FETCH_OBJ)) {
			$user_tree_array[] = '<li><input type="checkbox" name="Modulos[]" value="' . $row->id_modu . '" id="' . $row->id_modu . '" parent-id="" class="jtree_parent_checkbox"> <label for="' . $row->id_modu . '">' . $row->nom_modu . '</label></li>';
			$user_tree_array = arboldeCategoriasLista($row->id_modu, $user_tree_array);
		}
		$user_tree_array[] = "</ul>";
	}
	return $user_tree_array;
}
?>