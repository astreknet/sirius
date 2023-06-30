<?php
ini_set('session.gc_maxlifetime', 180);  #  
ini_set('session.gc_probability', 1);    #
ini_set('session.gc_divisor', 1);        # Kicks you out in 5 min if inactive
session_start();
date_default_timezone_set('Europe/Helsinki');

### MYSQL ################################################
$pdo = new PDO('mysql:host=127.0.0.1;dbname=sirius;charset=utf8mb4', 'sirius', 'S3r355');
$sql = '
        CREATE TABLE IF NOT EXISTS safari (
            id INT2 unsigned NOT NULL AUTO_INCREMENT,
            name varchar(60) NOT NULL unique,
            length INT2 unsigned DEFAULT 60,
            weekday INT3 DEFAULT 1111111,
            description LONG,
            time time DEFAULT "09:00:00",
            price decimal(8,2) DEFAULT 0.00,
            active bool DEFAULT TRUE,
            PRIMARY KEY (id)
        ); 

        INSERT IGNORE INTO safari (id, name, description) VALUES
            (1, "snowmobiling intro", "Easy experience. Including one stop for pictures"),
            (2, "forest ski", "Off piste. Hot berry juice and snack"),
            (3, "other optional", "taylor made safari");

        CREATE TABLE IF NOT EXISTS user (
            id INT2 unsigned NOT NULL AUTO_INCREMENT,
            email varchar(45) NOT NULL unique,
            password char(64),
            fname varchar(18),
            lname varchar(18),
            tel varchar(18),
            userlevel INT1 unsigned DEFAULT 1,
            activation char(32), 
            updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (id)
        );

        INSERT IGNORE INTO user (id, email, userlevel) VALUES (1, "hugo@astrek.net", 3);

        CREATE TABLE IF NOT EXISTS trip (
            id INT2 unsigned NOT NULL AUTO_INCREMENT,
            user_id INT2 unsigned NOT NULL,
            safari_id INT2 unsigned DEFAULT 1,
            erp_link varchar(150),
            datetime datetime DEFAULT current_timestamp(),
            route varchar(150),
            remarks varchar(300),
            updated datetime ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            KEY fk_trip_user (user_id),
            KEY fk_trip_safari (safari_id),
            CONSTRAINT fk_trip_safari FOREIGN KEY (safari_id) REFERENCES safari (id) ON DELETE CASCADE,
            CONSTRAINT fk_trip_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS accident (
            id INT2 unsigned NOT NULL AUTO_INCREMENT,
            user_id INT2 unsigned NOT NULL,
            trip_id INT2 unsigned DEFAULT 1,
            datetime datetime DEFAULT current_timestamp(),
            place varchar(150),
            point point,
            description varchar(300),
            customer_erp_link varchar(150),
            customer_name varchar(150),
            customer_address varchar(150),
            customer_email varchar(45),
            sm_reg_n varchar(27),
            sm_model varchar(30),
            waiver bool DEFAULT FALSE,
            total_euro decimal(8,2) DEFAULT 0.00,
            total_paid decimal(8,2) DEFAULT 0.00,
            injury varchar(300),
            first_aid bool DEFAULT FALSE,
            hospital_offer bool DEFAULT FALSE,
            hospital_visit bool DEFAULT FALSE,
            updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            KEY fk_accident_user (user_id),
            KEY fk_accident_trip (trip_id),
            CONSTRAINT fk_accident_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
            CONSTRAINT fk_accident_trip FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS nearmiss (
            id INT2 unsigned NOT NULL AUTO_INCREMENT,
            user_id INT2 unsigned NOT NULL,
            trip_id INT2 unsigned DEFAULT 1,
            nm_datetime datetime DEFAULT current_timestamp(),
            nm_place varchar(150),
            point point,
            nm_description varchar(300),
            guide bool DEFAULT FALSE,
            customer bool DEFAULT FALSE,
            updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            KEY fk_nearmiss_user (user_id),
            KEY fk_nearmiss_trip (trip_id),
            CONSTRAINT fk_nearmiss_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
            CONSTRAINT fk_nearmiss_trip FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE
        );
        
        CREATE TABLE IF NOT EXISTS issue (
            id INT2 unsigned NOT NULL AUTO_INCREMENT,
            user_id INT2 unsigned NOT NULL,
            datetime datetime DEFAULT current_timestamp(),
            place varchar(150),
            point point,
            description varchar(300),
            injury varchar(300),
            first_aid bool DEFAULT FALSE,
            hospital_visit bool DEFAULT FALSE,
            updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            KEY fk_issue_user (user_id),
            CONSTRAINT fk_issue_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        );
    ';
    
$stmt = $pdo->prepare($sql);
$stmt->execute();
$stmt->closeCursor();

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
    include  __DIR__ . '/../views/output.php';
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
class User{
    public $id, $email, $password, $fname, $lname, $tel, $userlevel, $activation, $updated; 

    public function __construct($pMail, $pdo){
        if ($row = selectAllFromWhere('user', 'email', filter_var($pMail, FILTER_VALIDATE_EMAIL), $pdo)) {
            foreach ($row[0] as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    public function validate($pPassword){
        return ($pPassword === $this->password ? true : false);
    }

    public function resetPassword($pdo){
        if ($this->userlevel){
            $activation = bin2hex(random_bytes(16));
            $url = 'https://'.$_SERVER['HTTP_HOST'].'?account&username='.$this->email.'&activation='.$activation;
            updateTableItemWhere('user', 'activation', $activation, 'email', $this->email, $pdo);
            mail($this->email, 'sirius recover', $url);
        }
    }

    public function createUser($userMail, $pdo){
        if (filter_var($userMail, FILTER_VALIDATE_EMAIL)  && !(selectAllFromWhere('user', 'email', $userMail, $pdo)) && ($this->userlevel > 1)) {
            insertInto('user', 'email', $userMail, $pdo);
            $activation = bin2hex(random_bytes(16));
            $url = 'https://'.$_SERVER['HTTP_HOST'].'?account&username='.$userMail.'&activation='.$activation;
            updateTableItemWhere('user', 'activation', $activation, 'email', $userMail, $pdo);
            #$headers = array('From' => 'hugo@astrek.net', 'Reply-To' => 'sirius@astrek.net');
            mail($userMail, 'sirius acivation', $url); 
        }    
    }

    public function updateUserlevel($userId, $userLevel, $pdo){
        if (($row = selectAllFromWhere('user', 'id', $userId, $pdo)) &&  $this->userlevel > 1 && $row[0]['userlevel'] < $this->userlevel && $userLevel < $this->userlevel)
            updateTableItemWhere('user', 'userlevel', $userLevel, 'id', $userId, $pdo);
    }
}

class Guide extends User{
    public $trip, $nearmiss, $accident, $issue;

    public function __construct($pMail, $pdo){
        parent::__construct($pMail, $pdo);
        $this->trip = selectAllFromWhere('trip', 'user_id', $this->id, $pdo);
        $this->nearmiss = selectAllFromWhere('nearmiss', 'user_id', $this->id, $pdo);
        $this->accident = selectAllFromWhere('accident', 'user_id', $this->id, $pdo);
        $this->issue = selectAllFromWhere('issue', 'user_id', $this->id, $pdo);
    }

    public function updateTable($table, $tableId, $inputs, $checks, $pdo){
        foreach ($inputs as $in) {
            (!isset($_POST[$in]) && empty($_POST[$in]) ?: updateTableItemWhere($table, $in, $_POST[$in], 'id', $tableId, $pdo));
        }
        foreach($checks as $c) {
            (isset($_POST[$c]) ? updateTableItemWhere($table, $c, 1, 'id', $tableId, $pdo) : updateTableItemWhere($table, $c, 0, 'id', $tableId, $pdo));
        }
    }
}

class Safari{
    public $id, $name, $length, $weekday, $description, $time, $active;

    public function __construct($id, $name, $length, $weekday, $description, $time, $active){
        $this->id = $id;        
        $this->name = $name;        
        $this->length = $length;        
        $this->weekday = $weekday;        
        $this->description = $description;        
        $this->time = $time;        
        $this->active = $active;        
    }
}

class Trip{
    public $id, $user_id, $safari_id, $erp_link, $datetime, $route, $remarks, $done;

    public function __construct($pId, $pUser_id, $pSafari_id, $pErp_link, $pDatetime, $pRoute, $pRemarks, $pDone){
        $this->id = $pId;
        $this->user_id = $pUser_id;
        $this->safari_id = $pSafari_id;
        $this->erp_link = $pErp_link;
        $this->datetime = $pDatetime;
        $this->route = $pRoute;
        $this->remarks = $pRemarks;
        $this->done = $pDone;
    }
}

### VALIDATION ############################################
if (isset($_POST['username'], $_POST['lpassword']) && ($me = new User($_POST['username'], $pdo)) && ($me->userlevel) && ($me->validate(hash('sha256', $_POST['lpassword'])))) { 
    $_SESSION = array('usermail' => $me->email, 'validated' => TRUE);
}

if (isset($_GET['username'], $_GET['activation'], $_GET['account']) && ($me = new User($_GET['username'], $pdo)) && ($me->userlevel) && ($me->activation === $_GET['activation'])){
    $_SESSION = array('usermail' => $me->email, 'validated' => TRUE, 'register' => TRUE);
} 

(!isset($_GET['exit']) ?: getout());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8" >
    <meta http-equiv="refresh" content="183" >
    <meta name="description" content="a work manager for a small or medium safari company" >
    <meta name="Keywords" content="work manager, aurora, lapland, guide, finland, safari" >
    <meta name="Author" content="hugo@astrek.net" >
    <link rel="icon" href="favicon.ico" >
    <link rel="stylesheet" href="./sirius.css">
    <title id="title">sirius</title>
</head>
<body>
<header>
    <h1>sirius</h1>
    <h2>safari class</h2>
</header>

<?php
### ROUTING ###############################################
#require_once 'views/header.php';
if (isset($_SESSION['usermail'], $_SESSION['validated']) && ($me = new User($_SESSION['usermail'], $pdo)) && ($me->userlevel) && ($_SESSION['validated'])) {
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
        include_once 'views/trip.php';
    }
}
else {
    include_once 'views/login.php';
}
?>
<footer>
    <a href="mailto:sirius@astrek.net">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
    </a>

    <a href="https://github.com/astreknet/sirius">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg>
    </a>

    <a href="https://www.websitecarbon.com/website/sirius-astrek-net/">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M57.7 193l9.4 16.4c8.3 14.5 21.9 25.2 38 29.8L163 255.7c17.2 4.9 29 20.6 29 38.5v39.9c0 11 6.2 21 16 25.9s16 14.9 16 25.9v39c0 15.6 14.9 26.9 29.9 22.6c16.1-4.6 28.6-17.5 32.7-33.8l2.8-11.2c4.2-16.9 15.2-31.4 30.3-40l8.1-4.6c15-8.5 24.2-24.5 24.2-41.7v-8.3c0-12.7-5.1-24.9-14.1-33.9l-3.9-3.9c-9-9-21.2-14.1-33.9-14.1H257c-11.1 0-22.1-2.9-31.8-8.4l-34.5-19.7c-4.3-2.5-7.6-6.5-9.2-11.2c-3.2-9.6 1.1-20 10.2-24.5l5.9-3c6.6-3.3 14.3-3.9 21.3-1.5l23.2 7.7c8.2 2.7 17.2-.4 21.9-7.5c4.7-7 4.2-16.3-1.2-22.8l-13.6-16.3c-10-12-9.9-29.5 .3-41.3l15.7-18.3c8.8-10.3 10.2-25 3.5-36.7l-2.4-4.2c-3.5-.2-6.9-.3-10.4-.3C163.1 48 84.4 108.9 57.7 193zM464 256c0-36.8-9.6-71.4-26.4-101.5L412 164.8c-15.7 6.3-23.8 23.8-18.5 39.8l16.9 50.7c3.5 10.4 12 18.3 22.6 20.9l29.1 7.3c1.2-9 1.8-18.2 1.8-27.5zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>
    </a>
</footer>
</body>
</html>
