<?php
include"../connection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "UPDATE productos SET estado = 0");
    header("Location: productos.php");
}
?>
