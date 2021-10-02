<?php
include "../connection.php";

if (isset($_GET)) {
    if ($_GET['action'] == 0) {
        $id = $_GET['id'];
        $query_prod = mysqli_query($connection, "UPDATE productos SET estado = 0 WHERE id_user = '$id'");
        if (!$query_prod) {
            echo "fallo";
        } else {
            $query = mysqli_query($connection, "UPDATE usuarios SET estado= 0 WHERE id = '$id'");
        }
    }
    if ($_GET['action'] == 1) {
        $id = $_GET['id'];
        $query_prod = mysqli_query($connection, "UPDATE productos SET estado = 1 WHERE id_user = '$id' AND stock > 0");
        if (!$query_prod) {
            echo "fallo";
        } else {
            $query = mysqli_query($connection, "UPDATE usuarios SET estado= 1 WHERE id = '$id'");
        }
    }
    header("Location: usuarios.php");
}
