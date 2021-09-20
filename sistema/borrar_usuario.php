<?php
include"../connection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "DELETE FROM usuarios WHERE id = '$id'");
    header("Location: usuarios.php");
}
?>
