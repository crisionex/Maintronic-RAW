<?php
require "../database.php";

if (isset($_POST['value']) && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $num_folio = $_POST['value'];

    $qry = "SELECT * FROM reportes WHERE num_folio = num_folio";
    $res = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($res);

    if ($accion == 'validar') {
        $query = "UPDATE reportes set estado = 'Validado' WHERE num_folio = $num_folio";
        mysqli_query($con, $query);

        $query = "UPDATE inv_equipo set condiciones = '0' WHERE numero_inv= ".$row['codigo_equipo']."";
        mysqli_query($con, $query);

    } elseif ($accion == 'rechazar') {
        $query = "UPDATE reportes set estado = 'Rechazado' WHERE num_folio= $num_folio";
        mysqli_query($con, $query);

        $query = "UPDATE inv_equipo set condiciones = 'M' WHERE numero_inv= ".$row['codigo_equipo']."";
        mysqli_query($con, $query);
    }
}
