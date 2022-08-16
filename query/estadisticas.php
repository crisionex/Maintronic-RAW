<?php
require "../database.php";
//get rejected and accepted reports for a specific year and month from the database
$array = array();
$qry = "SELECT * FROM reportes";
$res = mysqli_query($con, $qry);
while ($row = mysqli_fetch_assoc($res)) {
    $fecha_r = explode('-', $row['fecha_realizacion']);
    if ($fecha_r[0] == $_POST['Y']){
        if ($row['estado'] == 'Validado' && $_POST['tipo'] == '1') {
            
        } else if ($row['estado'] == 'Rechazado' && $_POST['tipo'] == '2') {
            
        } else if (($row['estado'] == 'Pendiente' || $row['estado'] == 'Validado' || $row['estado'] == 'Rechazado') && $_POST['tipo'] == '3') {
            
        }
    }
}