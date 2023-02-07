<?php
session_start();
include('inc.function.php');
if (isset($_GET['exit']))
    wayout();
if ( isset($_POST['newpass']) && isset($_POST['newpass1']) && !empty($_POST['newpass']) && ($_POST['newpass'] == $_POST['newpass1']) ){
    $conn = new mysqli('127.0.0.1', 'lsn', 'L1pl1nd', 'lsn');
    $conn-> set_charset('utf8');

    $newpass = hash('sha256', htmlspecialchars(stripslashes(trim($_POST['newpass']))));
    $stmt = $conn->prepare('update user set password = ?  where mail = ?;');
    $stmt-> bind_param('ss', $newpass, $_SESSION['mail']);
    $stmt-> execute();
    $stmt-> close();
    $conn-> close();
    wayout();
}
include('inc.header.php');
include('inc.chpass.php');
include('inc.footer.php');
?>
