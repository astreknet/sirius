<?php
session_start();
date_default_timezone_set('Europe/Helsinki');
require_once 'templates/html.header.php';
include_once 'includes/function.php';
require_once 'includes/myconn.php';
include_once 'class/User.php';

(!isset($_GET['out']) ?: include 'templates/html.getout.php');
((empty($_POST['email']) || empty($_POST['password'])) ?: validateUser(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL), $_POST['password'], $pdo));
(!isset($_SESSION['email']) || !isset($_SESSION['password']) ?: $user = new User($_SESSION['email'], $_SESSION['password'], $pdo));
((!isset($user->active) || ( !$user->active ))  ?: include 'templates/html.navbar.php');
//include ((!isset($user->active) || ( !$user->active ))  ? 'templates/html.login.php' : 'templates/html.trip.php');
if (isset($user->active) && ( $user->active )){
    if(isset($_GET['users'])){
        include 'templates/html.user.php';    
    }
    elseif(isset($_GET['chpass'])){
        include 'templates/html.chpass.php';    
    }
    else{
        include 'templates/html.trip.php';    
    }
}
else {
    include (isset($_SESSION['register']) ? 'templates/html.register.php' : 'templates/html.login.php');
}
echo var_dump($_SESSION).'<br>';
//echo var_dump($_SERVER).'<br>';
echo var_dump($user).'<br>';
//echo count($user->trip).'<br>';
//echo var_dump(getAccidentsByTripID(11, $pdo)).'<br>';
//echo var_dump($user->trip).'<br>';


require_once 'templates/html.footer.php';
?>
