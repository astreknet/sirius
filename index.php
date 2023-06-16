<?php
ini_set('session.gc_maxlifetime', 300);  #  
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
            date datetime DEFAULT current_timestamp(),
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
#require_once 'includes/myconn.php';

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

function downloadCsv($name){
    $out = fopen('php://output', 'w');
    foreach ($_SESSION[$name] as $t){
        fputcsv($out, $t);
    }
    fclose($out);
    unset($_SESSION[$name]);
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$name.'-'.date('YmdHis').'.csv' );
}
#include_once 'includes/function.php';

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
    public $trip, $nearmiss, $accident;

    public function __construct($pMail, $pdo){
        parent::__construct($pMail, $pdo);
        $this->trip = selectAllFromWhere('trip', 'user_id', $this->id, $pdo);
        $this->nearmiss = selectAllFromWhere('nearmiss', 'user_id', $this->id, $pdo);
        $this->accident = selectAllFromWhere('accident', 'user_id', $this->id, $pdo);
    }

    public function updateTrip($table, $tableId, $inputs, $checks, $pdo){
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
    public $id, $user_id, $safari_id, $erp_link, $date, $route, $remarks, $done;

    public function __construct($pId, $pUser_id, $pSafari_id, $pErp_link, $pDate, $pRoute, $pRemarks, $pDone){
        $this->id = $pId;
        $this->user_id = $pUser_id;
        $this->safari_id = $pSafari_id;
        $this->erp_link = $pErp_link;
        $this->date = $pDate;
        $this->route = $pRoute;
        $this->remarks = $pRemarks;
        $this->done = $pDone;
    }
}
#include_once 'class/User.php';

#echo var_dump($_SERVER);

### VALIDATION ############################################
if (isset($_POST['username'], $_POST['lpassword']) && ($me = new User($_POST['username'], $pdo)) && ($me->userlevel) && ($me->validate(hash('sha256', $_POST['lpassword'])))) { 
    $_SESSION = array('usermail' => $me->email, 'validated' => TRUE);
}

if (isset($_GET['username'], $_GET['activation'], $_GET['account']) && ($me = new User($_GET['username'], $pdo)) && ($me->userlevel) && ($me->activation === $_GET['activation'])){
    $_SESSION = array('usermail' => $me->email, 'validated' => TRUE, 'register' => TRUE);
} 

### ROUTING ###############################################
(!isset($_GET['exit']) ?: getout());
require_once 'views/header.php';
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
require_once 'views/footer.php';
?>
