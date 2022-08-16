<?php
include "../database.php";

$id = $_POST['id'];
$condicion = $_POST['condicion'];

$query = "UPDATE inv_equipo set condiciones = '$condicion' WHERE id_inv= $id";
mysqli_query($con, $query);

?>