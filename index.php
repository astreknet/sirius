<?php
session_start();
date_default_timezone_set('Europe/Helsinki');
include_once 'includes/function.php';
require_once 'includes/myconn.php';
include_once 'class/User.php';

(!isset($_GET['out']) ?: getout());

### VALIDATION ############################################
if (isset($_POST['username'], $_POST['lpassword']) && ($me = new User($_POST['username'], $pdo)) && ($me->userlevel)) {
    if (is_null($me->password) && hash('sha256', $_POST['lpassword']) === hash('sha256', $me->email)) { 
        $_SESSION = array('usermail' => $me->email, 'validated' => TRUE, 'register' => TRUE);
    }
    if ($me->validate(hash('sha256', $_POST['lpassword']))) { 
        $_SESSION = array('usermail' => $me->email, 'validated' => TRUE);
    }
}

require_once 'views/header.php';

### ROUTING ###############################################
if (isset($_SESSION['usermail'], $_SESSION['validated']) && ($me = new User($_SESSION['usermail'], $pdo)) && ($me->userlevel) && ($_SESSION['validated'])) {
    require_once 'views/navbar.php';
    if ((isset($_SESSION['register']) && $_SESSION['register']) || isset($_GET['account'])) {
        include_once 'views/account.php';
    }
    elseif (isset($_GET['reports']) && $me->userlevel > 1) {
        include_once 'views/report.php';
    }
    elseif (isset($_GET['safaris']) && $me->userlevel > 1) {
        include_once 'views/safari.php';
    }
    elseif (isset($_GET['users']) && $me->userlevel > 1) {
        include_once 'views/user.php';
    }
    else {
        include_once 'views/trip.php';
    }
}
else {
    include_once 'views/login.php';
}

require_once 'views/footer.php';
?>
