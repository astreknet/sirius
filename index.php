<?php
session_start();
date_default_timezone_set('Europe/Helsinki');
include_once 'includes/function.php';
require_once 'includes/myconn.php';
include_once 'class/User.php';

(!isset($_GET['out']) ?: getout());

(!isset($_POST['username'], $_POST['lpassword']) || !($me = new User($_POST['username'], $pdo)) || !($me->userlevel && $me->validate(hash('sha256', $_POST['lpassword']))) ?: $_SESSION = array('id' => $me->id, 'usermail' => $me->email, 'validated' => TRUE));
(!isset($_POST['username'], $_POST['lpassword']) || !is_null($me->password) || (hash('sha256', $_POST['lpassword']) !== hash('sha256', $me->email)) ?: $_SESSION = array('registered' => FALSE, 'usermail' => $me->email));

#echo var_dump($_SESSION).'<br>';
require_once 'views/header.php';


if (isset($_SESSION['validated'])){
    (isset($me) ?: $me = new User($_SESSION['usermail'], $pdo));
    #echo var_dump($me);
#    include 'views/navbar.php';
    
    if(isset($_GET['users']) && $me->userlevel > 1){
        include 'views/user.php';    
    }
    elseif(isset($_GET['account'])){
        include 'views/account.php';    
    }
    elseif(isset($_GET['safaris']) && $me->userlevel > 1){
        include 'views/safaris.php';
    }
    else{
        include 'views/trip.php';    
    }
}
else {
    #echo var_dump($me).'<br>';
    include (isset($_SESSION['registered']) && !($_SESSION['registered']) ? 'views/account.php' : 'views/astrek.php');
}
//echo count($user->trip).'<br>';
//echo var_dump(getAccidentsByTripID(11, $pdo)).'<br>';
//echo var_dump($user->trip).'<br>';


require_once 'views/footer.php';
?>
