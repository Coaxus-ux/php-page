<?php
include"../connection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "DELETE FROM linea WHERE id = '$id'");
    header("Location: categoria.php");
}
?>