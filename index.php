<?php
session_start();
date_default_timezone_set('Europe/Helsinki');
require_once 'templates/html.header.php';
require_once 'includes/myconn.php';
include_once 'class/User.php';
include_once 'includes/function.php';

(!isset($_GET['out']) ?: wayout());
((empty($_POST['mail']) || empty($_POST['password'])) ?: validateUser($_POST['mail'], $_POST['password'], $pdo));
(!isset($_SESSION['umail']) && !isset($_SESSION['upass']) ?: $user = new User($_SESSION['umail'], $_SESSION['upass'], $pdo));
((!isset($user->active) || ( !$user->active ))  ?: ( $user->admin ? include 'templates/html.adnavbar.php' : include 'templates/html.navbar.php'));
//include ((!isset($user->active) || ( !$user->active ))  ? 'templates/html.login.php' : 'templates/html.trip.php');
//echo var_dump($_SESSION);
if (isset($user->active) && ( $user->active )){
    include 'templates/html.trip.php';    
    include 'templates/html.chpass.php';    
    include 'templates/html.user.php';    
}
else {
    include (isset($_SESSION['chpass']) ? 'templates/html.chpass.php' : 'templates/html.login.php');
}

require_once 'templates/html.footer.php';
session_destroy();
?>
