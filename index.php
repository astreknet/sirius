<?php
### SESSION ###############################################
ini_set('session.gc_maxlifetime', 180);  # out in 3 min 
ini_set('session.gc_probability', 1);    #
ini_set('session.gc_divisor', 1);        #
session_start();

### CONFIG ################################################
date_default_timezone_set('Europe/Helsinki');
define("COMPANY_NAME",  "sirius");
define("COMPANY_WEB",   "https://astrek.net");
define("ADMIN_MAIL",    "hugo@astrek.net");
define("DB_NAME",       "mysql:host=127.0.0.1;dbname=sirius;charset=utf8mb4");
define("DB_USER",       "sirius");
define("DB_PASS",       "S3r355");

### MYSQL #################################################
$pdo = new PDO(DB_NAME, DB_USER, DB_PASS);
$stmt = $pdo->prepare(file_get_contents("sirius.sql")); 
$stmt->execute();
$stmt->closeCursor();

$stmt = $pdo->prepare(file_get_contents("sirius.local.sql"));   # insert constants 
$stmt->execute();                                               #
$stmt->closeCursor();                                           #

function selectAllFrom($table, $pdo){
    try {
        $sql = 'SELECT * FROM '.$table;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../views/output.php';
}

function selectAllFromWhere($table, $item, $i, $pdo){
    try {
        $sql = 'SELECT * FROM '.$table.' WHERE '.$item.' = :'.$item;
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':'.$item, $i);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  './views/output.php';
}

function updateTableItemWhere($table, $item, $i, $where, $w, $pdo){
    $sql = 'UPDATE '.$table.' SET '.$item.' = :'.$item.' WHERE '.$where.' = :'.$where;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':'.$item, $i);
    $stmt->bindValue(':'.$where, $w);
    $stmt->execute();
    $stmt->closeCursor();
}

function insertInto($table, $item, $i, $pdo){
    $sql = 'INSERT INTO '.$table.' ('.$item.') values (:'.$item.')';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':'.$item, $i);
    $stmt->execute();
    $sql = 'SELECT LAST_INSERT_ID() as id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

function deleteOneDayOldNonRegisteredUsers($pdo){
    $sql = 'DELETE FROM user where DATEDIFF(current_timestamp(), updated) > 0 AND password is NULL AND fname is NULL AND lname is NULL AND tel is NULL AND userlevel = 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
}

### FUNCTIONS #############################################
function value($post){
    if (isset($_POST[$post]))
        return $_POST[$post];
    else
        if (isset($_SESSION[$post]))
            return $_SESSION[$post];
}

function getout(){
    header( "refresh:0;url=index.php" ); 
    session_unset();
    session_destroy();
    die();
}

function formatdate($date) {
    $myunixdate = strtotime($date);
    if (date("Y-m-d") == date("Y-m-d", $myunixdate))
        return "today ".date("G:i", $myunixdate);
    else
        return date("D M j G:i", $myunixdate);
}

function sessionForm($val, $bool) {
    foreach ($val as $k => $v) {
        if ($bool == TRUE) {
            $_SESSION[$k] = $v;
        } 
        else {
            unset($_SESSION[$k]);
        }
    }
}

function prepareReport($name, $sql, $csvheader, $pdo) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION[$name] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION[$name][] = $row;
    }
    array_unshift($_SESSION[$name], $csvheader);
    header( "refresh:0;url=views/downloads.php" );
}

### CLASS #################################################
require_once "./class.user.php";


### VALIDATION ############################################
if (
    isset($_POST['username'], $_POST['password']) &&
    filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) &&
    ($me = new User($_POST['username'], $pdo)) && 
    ($me->userlevel) && 
    ($me->validate_pass(hash('sha256', $_POST['password'])))
    ){ 
    $_SESSION['usermail'] = $me->email;
}

if (
    isset($_GET['username'], $_GET['activation'], $_GET['account']) && 
    ($me = new User($_GET['username'], $pdo)) && 
    ($me->userlevel) && 
    ($me->activation === $_GET['activation'])
    ){
    $_SESSION = array('usermail' => $me->email, 'register' => TRUE);
} 

(!isset($_GET['exit']) ?: getout());

### ROUTING ###############################################
require_once 'views/header.php';
if (isset($_SESSION['usermail']) && ($me = new User($_SESSION['usermail'], $pdo)) && ($me->userlevel)) {
    require_once 'views/navbar.php';
    if (isset($_GET['reports']) && $me->userlevel > 1) {
        include_once 'views/report.php';
    }
    elseif (isset($_GET['safaris']) && $me->userlevel > 1) {
        include_once 'views/safari.php';
    }
    elseif (isset($_GET['users']) && $me->userlevel > 1) {
        include_once 'views/user.php';
    }
    elseif (isset($_GET['account'])) {
        include_once 'views/account.php';
    }
    elseif (isset($_GET['issues'])) {
        include_once 'views/issue.php';
    }
    else {
        include_once 'views/gig.php';
    }
}
else {
    include_once 'views/login.php';
}

require_once 'views/footer.php';
?>
