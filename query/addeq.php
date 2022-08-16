<?php
require "../database.php";

if(isset($_POST['num_inv'])&&isset($_POST['nom_eq'])){
$num_inv = $_POST['num_inv'];
$nom_eq = $_POST['nom_eq'];

$qry = "INSERT INTO inv_equipo (numero_inv,nom_eq) VALUES ('$num_inv', '$nom_eq')";
$res=mysqli_query($con,$qry);
}

echo"";