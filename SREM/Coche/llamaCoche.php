<?php
require_once '../conexSql.php';

if (isset($_POST['res'])) {
    $query = "SELECT c.matricula, c.marca, c.modelo, c.c_pasajeros, ch.CI, ch.nombre, ch.apellido, ch.c_salud, ch.tipo, ch.fecha_de_vencimiento_libreta_conducir, ct.tel, c.baja
    FROM chofer ch
    JOIN coche c ON ch.matricula = c.matricula
    JOIN chofer_tel ct ON ch.CI = ct.CI
    ORDER BY c.matricula ASC;";


    $result = mysqli_query($conn, $query);
    $json = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'matricula' => $row['matricula'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'c_pasajeros' => $row['c_pasajeros'],
                'CI' => $row['CI'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
                'c_salud' => $row['c_salud'],
                'tipo' => $row['tipo'],
                'fecha_de_vencimiento_libreta_conducir' => $row['fecha_de_vencimiento_libreta_conducir'],
                'tel' => $row['tel'],
                'baja' => $row['baja']
            );
        }
        echo json_encode($json);
        

    } else {
        echo "No devuelve nada";
    }
}
?>
