<?php
    $pdo = new PDO('mysql:host=localhost;dbname=lsn;charset=utf8mb4', 'lsn', 'L1pl1nd');

/* FUTURE DATABASE: CUSTOMERS MAYBE ALSO USERS
    $pdo = new PDO('mysql:host=localhost;dbname=sirius;charset=utf8mb4', 'sirius', 'S3r355');
    $sql = '
            CREATE TABLE IF NOT EXISTS safari (
                id int unsigned NOT NULL AUTO_INCREMENT,
                name varchar(60) NOT NULL,
                length smallint(6) NOT NULL,
                weekday char(7) NOT NULL,
                description mediumtext NOT NULL,
                time time NOT NULL,
                active bool NOT NULL DEFAULT TRUE,
                PRIMARY KEY (id)
            ); 

            CREATE TABLE IF NOT EXISTS user (
                id int unsigned NOT NULL AUTO_INCREMENT,
                mail varchar(45) NOT NULL unique,
                password char(64),
                name varchar(18),
                surname varchar(18),
                admin bool DEFAULT FALSE,
                active bool DEFAULT FALSE,
                PRIMARY KEY (id)
            );

            CREATE TABLE IF NOT EXISTS trip (
                id int unsigned NOT NULL AUTO_INCREMENT,
                user_id int unsigned NOT NULL,
                safari_id int unsigned NOT NULL,
                erp_link varchar(9) NOT NULL,
                date datetime,
                route varchar(150),
                remarks varchar(300),
                done bool DEFAULT FALSE,
                PRIMARY KEY (id),
                KEY fk_trip_user (user_id),
                KEY fk_trip_safari (safari_id),
                CONSTRAINT fk_trip_safari FOREIGN KEY (safari_id) REFERENCES safari (id) ON DELETE CASCADE,
                CONSTRAINT fk_trip_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS accident (
                id int unsigned NOT NULL AUTO_INCREMENT,
                user_id int unsigned NOT NULL,
                trip_id int unsigned NOT NULL,
                datetime datetime NOT NULL,
                place varchar(150) NOT NULL,
                description varchar(300) NOT NULL,
                customer_erp_link varchar(9) NOT NULL,
                customer_name varchar(150) NOT NULL,
                customer_address varchar(150) NOT NULL,
                customer_email varchar(150) NOT NULL,
                sm_reg_n varchar(27) DEFAULT NULL,
                sm_model varchar(30) DEFAULT NULL,
                waiver bool DEFAULT FALSE,
                total_euro decimal(8,2) DEFAULT NULL,
                total_paid decimal(8,2) DEFAULT NULL,
                injury varchar(300) DEFAULT NULL,
                first_aid_by_staff bool DEFAULT FALSE,
                hospital_offer bool DEFAULT FALSE,
                hospital_visit bool DEFAULT FALSE,
                PRIMARY KEY (id),
                KEY fk_accident_user (user_id),
                KEY fk_accident_trip (trip_id),
                CONSTRAINT fk_accident_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
                CONSTRAINT fk_accident_trip FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS nearmiss (
                id int unsigned NOT NULL AUTO_INCREMENT,
                user_id int unsigned NOT NULL,
                trip_id int unsigned NOT NULL,
                datetime datetime NOT NULL,
                place varchar(150) NOT NULL,
                description varchar(300) DEFAULT NULL,
                guide_involved bool DEFAULT FALSE,
                customer_involved bool DEFAULT FALSE,
                PRIMARY KEY (id),
                KEY fk_nearmiss_user (user_id),
                KEY fk_nearmiss_trip (trip_id),
                CONSTRAINT fk_nearmiss_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
                CONSTRAINT fk_nearmiss_trip FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS customer (
                id int unsigned NOT NULL AUTO_INCREMENT,
                mail varchar(45) unique,
                name varchar(18) NOT NULL,
                surname varchar(18) NOT NULL,
                PRIMARY KEY (id)
            );
        ';
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
 */
function getUserByMail($mail, $pdo){
    try {
        $sql = 'SELECT * FROM user WHERE mail = :mail';
        $stmt = $pdo->prepare($sql); 
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function validateUser($mail, $password, $pdo){
    $mail = htmlspecialchars(stripslashes(trim($mail)));
    $password = hash('sha256', htmlspecialchars(stripslashes(trim($password))));
    if( ($r = getUserByMail($mail, $pdo)) && ($r['password'] === $password) ){
        $_SESSION['umail'] = $mail;    
        $_SESSION['upass'] = $password;    
    }
    if( ($r = getUserByMail($mail, $pdo)) && (is_null($r['password'])) && (hash('sha256', $mail) === $password) && ($r['active'])){
        $_SESSION['chpass'] = TRUE;
    }
}

function getTripsByUser($userId, $pdo){
    try {
        $sql = 'SELECT * FROM trip WHERE user_id = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function getAccidentsByUser($userId, $pdo){
    try {
        $sql = 'SELECT * FROM accident WHERE user_id = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function getNearMissByUser($userId, $pdo){
    try {
        $sql = 'SELECT * FROM nearmiss WHERE user_id = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function getSafariByID($safariId, $pdo){
    try {
        $sql = 'SELECT * FROM safari WHERE id = :safariId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':safariId', $safariId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}
?>
