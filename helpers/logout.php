<?php 

    session_start();

    setcookie("identificador", "", time() - 3600, "/");
    setcookie("token", "", time() - 3600, "/");

    header("Location: ../index.php");

    exit;

?>