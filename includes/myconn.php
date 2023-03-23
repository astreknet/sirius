<?php
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=sirius;charset=utf8mb4', 'sirius', 'S3r355');
    $sql = '
            CREATE TABLE IF NOT EXISTS safari (
                id INT2 unsigned NOT NULL AUTO_INCREMENT,
                name varchar(60) NOT NULL unique,
                length INT2 unsigned NOT NULL,
                weekday INT3 NOT NULL DEFAULT 1111111,
                description LONG,
                time time NOT NULL DEFAULT "09:00:00",
                price decimal(8,2) NOT NULL DEFAULT 0.00,
                active bool NOT NULL DEFAULT TRUE,
                PRIMARY KEY (id)
            ); 

            INSERT IGNORE INTO safari (id, name, length, description) VALUES
                (1, "snowmobiling intro", 60, "Easy experience. Including one stop for pictures"),
                (2, "scenic snowmobile", 150, "Average driving. Beautiful ride. Stops for pictures. Hot berry juice"),
                (3, "cross country ski", 120, "Easy tracks. Basic class. Hot berry juice and cookies"),
                (4, "snow bike", 180, "Average experience. Hot berry juice and snack"),
                (5, "forest ski", 180, "Off piste. Hot berry juice and snack"),
                (6, "other optional", 180, "taylor made safari");

            CREATE TABLE IF NOT EXISTS user (
                id INT2 unsigned NOT NULL AUTO_INCREMENT,
                email varchar(45) NOT NULL unique,
                password char(64),
                fname varchar(18),
                lname varchar(18),
                tel varchar(18),
                userlevel INT1 unsigned NOT NULL DEFAULT 1,
                created timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (id)
            );

            INSERT IGNORE INTO user (id, email, userlevel) VALUES (1, "hugo@dabug.go", 3);

            CREATE TABLE IF NOT EXISTS trip (
                id INT2 unsigned NOT NULL AUTO_INCREMENT,
                user_id INT2 unsigned NOT NULL,
                safari_id INT2 unsigned NOT NULL,
                erp_link varchar(150),
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
                id INT2 unsigned NOT NULL AUTO_INCREMENT,
                user_id INT2 unsigned NOT NULL,
                trip_id INT2 unsigned NOT NULL,
                datetime datetime NOT NULL,
                place varchar(150) NOT NULL,
                description varchar(300) NOT NULL,
                customer_erp_link varchar(150),
                customer_name varchar(150) NOT NULL,
                customer_address varchar(150) NOT NULL,
                customer_email varchar(45) NOT NULL,
                sm_reg_n varchar(27),
                sm_model varchar(30),
                waiver bool DEFAULT FALSE,
                total_euro decimal(8,2) DEFAULT 0.00,
                total_paid decimal(8,2) DEFAULT 0.00,
                injury varchar(300),
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
                id INT2 unsigned NOT NULL AUTO_INCREMENT,
                user_id INT2 unsigned NOT NULL,
                trip_id INT2 unsigned NOT NULL,
                datetime datetime NOT NULL,
                place varchar(150) NOT NULL,
                description varchar(300) NOT NULL,
                guide_involved bool DEFAULT FALSE,
                customer_involved bool DEFAULT FALSE,
                PRIMARY KEY (id),
                KEY fk_nearmiss_user (user_id),
                KEY fk_nearmiss_trip (trip_id),
                CONSTRAINT fk_nearmiss_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
                CONSTRAINT fk_nearmiss_trip FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS customer (
                id INT2 unsigned NOT NULL AUTO_INCREMENT,
                email varchar(45) unique,
                fname varchar(18) NOT NULL,
                lname varchar(18) NOT NULL,
                PRIMARY KEY (id)
            );
        ';
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();

function getUsers($pdo){
    try {
        $sql = 'SELECT * FROM user';
        $stmt = $pdo->prepare($sql);
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

function getUserByMail($email, $pdo){
    try {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $stmt = $pdo->prepare($sql); 
        $stmt->bindValue(':email', $email);
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

function getUserById($id, $pdo){
    try {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
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

function addUser($email, $pdo){
    $sql = 'INSERT INTO user (email) values (:email)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $stmt->closeCursor();
}

function updateUser($id, $email, $password, $fname, $lname, $tel, $pdo){
    $sql = 'UPDATE user SET email = :email, password = :password, fname = :fname, lname = :lname, tel = :tel WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':fname', $fname);
    $stmt->bindValue(':lname', $lname);
    $stmt->bindValue(':tel', $tel);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $stmt->closeCursor();
}

function updateUserLevel($id, $userlevel, $pdo){
    $sql = 'UPDATE user SET userlevel = :userlevel WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userlevel', $userlevel);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $stmt->closeCursor();
}

function deleteOneDayOldNonRegisteredUsers($pdo){
    $sql = 'DELETE FROM user where DATEDIFF(current_timestamp(), created) > 0 AND password is NULL AND fname is NULL AND lname is NULL AND tel is NULL AND userlevel = 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
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
        return (empty($result) ? FALSE : $result);
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function addTrip($user_id, $safari_id, $erp_link, $date, $route, $pdo){
    $sql = 'INSERT INTO trip (user_id, safari_id, erp_link, date, route) VALUES (:user_id, :safari_id, :erp_link, :date, :route)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':safari_id', $safari_id);
    $stmt->bindValue(':erp_link', $erp_link);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':route', $route);
    $stmt->execute();
    $stmt->closeCursor();
}

function getAccidentsByTripID($tripId, $pdo){
    try {
        $sql = 'SELECT * FROM accident WHERE trip_id = :tripId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tripId', $tripId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return (!isset($result) ?: $result);
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function getNear_missesByTripID($tripId, $pdo){
    try {
        $sql = 'SELECT * FROM nearmiss WHERE trip_id = :tripId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tripId', $tripId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        $stmt->closeCursor();
        return (!isset($result) ?: $result);
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

function getSafaris($pdo){
    try {
        $sql = 'SELECT * FROM safari';
        $stmt = $pdo->prepare($sql);
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

function getSafariById($safariId, $pdo){
    try {
        $sql = 'SELECT * FROM safari WHERE id = :safariId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':safariId', $safariId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = $row;
        }
        $stmt->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function getSafariByName($name, $pdo){
    try {
        $sql = 'SELECT * FROM safari WHERE name = :name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
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

function addSafari($name, $length, $pdo){
    $sql = 'INSERT INTO safari (name, length) values (:name, :length)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':length', $length);
    $stmt->execute();
    $stmt->closeCursor();
}

function updateSafari($id, $name, $length, $active, $pdo){
    $sql = 'UPDATE safari SET name = :name, length = :length, active = :active WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':length', $length);
    $stmt->bindValue(':active', $active);
    $stmt->execute();
    $stmt->closeCursor();
}

?>
