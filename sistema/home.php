<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
</head>
<?php include "includes/nav.php" ?>

<body>

    <h1>Hola mundo</h1>

</body>

</html>