<?php
require_once '../conexSql.php';

if (isset($_POST['res'])) {
    $query = "SELECT c.matricula, ch.CI, ch.nombre, ch.apellido, ct.tel, ch.baja
    FROM chofer ch
    JOIN coche c ON ch.matricula = c.matricula
    JOIN chofer_tel ct ON ch.CI = ct.CI
    order by c.matricula asc";
;

    $result = mysqli_query($conn, $query);
    $json = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'matricula' => $row['matricula'],
                'CI' => $row['CI'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
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
