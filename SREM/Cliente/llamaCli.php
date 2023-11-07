<?php
require_once '../conexSql.php';
if (isset($_POST['res'])) {
	$query = "SELECT e.RUT, e.nom_ficticio, e.razon_social, e.lista_negra, ed.calle, ed.n_puerta, ed.esquina, et.tel, e.baja
	FROM empresa e
	JOIN empresa_direccion ed ON ed.RUT = e.RUT
	JOIN empresa_tel et ON et.RUT = e.RUT
	order by e.lista_negra desc";
	$result = mysqli_query($conn, $query);
	$json = array();
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$json[] = array(
				'RUT' => $row['RUT'],
				'nom_ficticio' => $row['nom_ficticio'],
				'razon_social' => $row['razon_social'],
				'lista_negra' => $row['lista_negra'],
				'calle' => $row['calle'],
				'n_puerta' => $row['n_puerta'],
				'esquina' => $row['esquina'],
				'tel' => $row['tel'],
				'baja' => $row['baja'],
			);
		}
		echo json_encode($json);

	} else {
		echo "No devuelve nadaaaa";
	}

}
?>