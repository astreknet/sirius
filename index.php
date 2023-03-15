<?php
session_start();
date_default_timezone_set('Europe/Helsinki');
require_once 'templates/html.header.php';
include_once 'includes/function.php';
require_once 'includes/myconn.php';
include_once 'class/User.php';

(!isset($_GET['out']) ?: include 'templates/html.getout.php');

(!isset($_POST['username'], $_POST['lpassword']) || !($me = new User($_POST['username'], $pdo)) || !($me->active && $me->validate(hash('sha256', $_POST['lpassword']))) ?: $_SESSION = array('id' => $me->id, 'usermail' => $me->email, 'validated' => TRUE));
(!isset($_POST['username'], $_POST['lpassword']) || !is_null($me->password) || (hash('sha256', $_POST['lpassword']) !== hash('sha256', $me->email)) ?: $_SESSION = array('registered' => FALSE, 'usermail' => $me->email));

echo var_dump($_SESSION).'<br>';

if (isset($_SESSION['validated'])){
    (isset($me) ?: $me = new User($_SESSION['usermail'], $pdo));
    echo var_dump($me);
    include 'templates/html.navbar.php';
    
    
    if($_GET['menu'] == "users"){
        include 'templates/html.user.php';    
    }
    elseif($_GET['menu'] == "account"){
        include 'templates/html.account.php';    
    }
    elseif($_GET['menu'] == "safaris"){
        include 'templates/html.safaris.php';
    }
    else{
        include 'templates/html.trip.php';    
    }
}
else {
    #echo var_dump($me).'<br>';
    #echo var_dump($_SESSION).'<br>';
    include (isset($_SESSION['registered']) ? 'templates/html.account.php' : 'templates/html.login.php');
}
#echo var_dump($_SERVER).'<br>';
//echo count($user->trip).'<br>';
//echo var_dump(getAccidentsByTripID(11, $pdo)).'<br>';
//echo var_dump($user->trip).'<br>';


require_once 'templates/html.footer.php';
?>
