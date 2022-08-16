<?php
require "../database.php";

if (isset($_POST['value'])) {
    $id = $_POST['value'];

    $qry = "DELETE FROM inv_equipo WHERE id_inv = '$id'";
    mysqli_query($con, $qry);
}
