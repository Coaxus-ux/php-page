<?php
require_once "../connection.php";
$categoria = $_POST['categoria'];
$query_subLinea = mysqli_query($connection, "SELECT * FROM sublinea WHERE categoria_id = '$categoria'");
$result_subLinea = mysqli_num_rows($query_subLinea);
$res = "<select id='select2' name='sublinea' class='select select-bordered w-full mt-1'>";
if ($result_subLinea > 0) {
    while ($subLinea = mysqli_fetch_array($query_subLinea)) {
        $res = $res. '<option value='. $subLinea['id'] . '>' . $subLinea['descripcion'] .'</option>';
    }
   
}
echo $res.'</select>';
?>
<!-- <select name="sublinea" class="select select-bordered w-full mt-1">
    <option disabled="disabled" selected="selected">Subcategoria</option>
    <?php

    if ($result_subLinea > 0) {
        while ($subLinea = mysqli_fetch_array($query_subLinea)) {
    ?>
            <option value="<?php echo $subLinea['id'] ?>"><?php echo $subLinea['descripcion'] ?></option>
    <?php
        }
    }
    ?>
</select> -->
