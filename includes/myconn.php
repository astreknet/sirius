<?php
try {
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
}
catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
}
include  __DIR__ . '/../templates/html.output.php';

function getUserByMail($mail, $pdo){
    try {
        $sql = 'SELECT * FROM user WHERE mail = :mail';
        $stmt = $pdo->prepare($sql); 
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
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
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

function getAccidentsByUser($tripId, $pdo){
    try {
        $sql = 'SELECT * FROM accident WHERE trip_id = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
        return $result;
    }
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() ;
    }
    include  __DIR__ . '/../templates/html.output.php';
}

?>
