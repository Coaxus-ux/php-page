<?php
include"../connection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_prod = mysqli_query($connection, "DELETE FROM productos WHERE id_user = '$id'");
    if(!$query_prod){
        echo "fallo";
    }else{
        $query = mysqli_query($connection, "DELETE FROM usuarios WHERE id = '$id'");
        header("Location: usuarios.php");
    }
}
?>
