<?php
function wayout() {
    session_unset();
    session_destroy();
    header('location:'.'kiitos.php');
    die();
}


?>
