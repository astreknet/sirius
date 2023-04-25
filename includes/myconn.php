<?php
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
                datetime datetime DEFAULT current_timestamp(),
                place varchar(150),
                point point,
                description varchar(300),
                guide bool DEFAULT FALSE,
                customer bool DEFAULT FALSE,
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
?>
