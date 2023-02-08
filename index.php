<?php
session_start();
include_once 'includes/header.html';

if (!empty($_POST['mail']) && !empty($_POST['password'])){
        $conn = new mysqli('127.0.0.1', 'lsn', 'L1pl1nd', 'lsn');
        $conn-> set_charset('utf8');
        $log_mail = htmlspecialchars(stripslashes(trim($_POST['mail'])));
        $log_pass = hash('sha256', htmlspecialchars(stripslashes(trim($_POST['password']))));
        $stmt = $conn->prepare('SELECT id, name, surname, password, admin, active FROM user WHERE mail = ?');
        $stmt-> bind_param('s', $log_mail);
        $stmt-> execute();
        $stmt-> store_result();
        $stmt-> bind_result($can['user_id'], $can['name'], $can['surname'], $can['password'], $can['admin'], $can['active']);
        $stmt-> fetch();
        $stmt-> close();
       
        if ($can['active'] == 1) {
            if ((!is_null($can['password'])) && ($log_pass === $can['password'])) {
                $_SESSION = $can;
                unset($can);
                header('location:'.'trip.php');
            }
            if ((is_null($can['password'])) && (hash('sha256', $log_mail) === $log_pass)) {
                $_SESSION['mail'] = $log_mail;
                unset($can);
                header('location:'.'chpass.php');
            }
        }
}
    
include('includes/login.php');
include_once 'includes/footer.html';
?>
