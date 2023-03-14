<?php
    //$pdo = new PDO('mysql:host=localhost;dbname=lsn;charset=utf8mb4', 'lsn', 'L1pl1nd');

    $pdo = new PDO('mysql:host=localhost;dbname=sirius;charset=utf8mb4', 'sirius', 'S3r355');
    $sql = '
            CREATE TABLE IF NOT EXISTS safari (
                id int unsigned NOT NULL AUTO_INCREMENT,
                name varchar(60) NOT NULL,
                length smallint(6) NOT NULL,
                weekday char(7) NOT NULL,
                description mediumtext NOT NULL,
                time time NOT NULL,
                price decimal(8,2) NOT NULL DEFAULT 0.00,
                active bool NOT NULL DEFAULT TRUE,
                PRIMARY KEY (id)
            ); 

            INSERT IGNORE INTO safari (id, name, length, weekday, description, time) VALUES
                (1, "introduction to snowmobiling", 60, "1010100", "Would you like to try snowmobiling for the first time, but are not sure if you are up to it? Then this is the safari for you! Lapland Safaris guide will teach you how to handle the snowmobile and you will make a short drive to get used to the machine. We use specially adjusted snowmobiles making the driving easier and safer for first timers. And after this, you are ready for longer safaris!", "09:00:00"),
                (2, "scenic safari", 150, "0101010", "This snowmobile safari is to enjoy the beautiful nature of Fell Lapland and having no rush with driving. Route climbs up the fells all the way to the top, where opens a beautiful landscape. Remember your camera as we will have plenty of pauses to take pictures! Warm berry juice served", "09:30:00"),
                (3, "rider\'s dream", 180, "1010100", "Snowmobile safari for you who would like to find the real touch for driving. This safari lets you to discover varying route profiles, giving you a good sense on how to handle the machine. You will manage the snowmobile without a passenger, which gives you extra feeling of freedom. Along the way, you will experience some stunning sceneries over vast wilderness. Hot berry juice offered during the safari. NOTE: suitable only for people over 18 years with a valid driving license, as all participants will be driving an own snowmobile.", "11:30:00"),
                (4, "cross country skiing trip", 120, "0101010", "Fasten the skis, lean on the ski poles and glide along the tracks through the pure whiteness. If you are a first timer on skis, there will be an introduction on the basic techniques of skiing. A stop is made to have a cup of warm berry juice. The price includes the equipment rental until 17:00, so you can go skiing on your own time and pace afterwards. NOTE: This safari is suitable for children of 12 years or older.", "10:00:00"),
                (5, "snow biking adventure", 180, "0101010", "Come and join us on a guided snow adventure with fatbikes! After receiving your helmet, bike, and instructions on how to handle the bike, the adventure is ready to start and take you through snowy landscapes of Saariselkä. During the adventure you will enjoy the silence of the tranquil forests and nature around you. A break will be held for you to stop for a rest, fry sausages, and to enjoy some hot berry juice around an open fire. NOTE:  This excursion is suitable for children of 12 years or older and requires basic knowledge of riding a bike.", "13:00:00"),
                (6, "forest skiing experience", 180, "1010100", "Join for short ski trip through the snow-covered forests and windswept fell areas! Short skis, also called short skis are easy-to-use, off-track forest skis that combine the best features of snowshoes and skis and do not require previous experience in skiing. You will be provided with all the equipment required for skiing. After a short (5 -10 min) transportation by car the journey will start into the white silence by short skis. The guide leads you to nearby creek where it’s time to enjoy a snack by the campfire and admire the pure nature that surrounds you. Returning back to Saariselkä by short skis. NOTE: This safari is suitable for children of 12 years or older.", "13:00:00"),
                (7, "white silence on snowshoes", 120, "1010100", "Let’s go wandering to the fells. This showshoe adventure will take you through the picturesque snowy wilderness. During the trip, you will get to walk both on marked tracks and in the deep snow. You might even find some tracks made by rabbits, foxes and willow grouses if you are lucky! There will be breaks to take photos and enjoy warm berry juice on the way. NOTE: This safari is suitable for children of 12 years or older.", "10:00:00"),
                (8, "snowmobile safari to a reindeer farm", 180, "1001010", "Visit a local reindeer farm by snowmobile. At the farm, the Sámi host will welcome you and introduce you to the reindeer husbandry and Lapland’s indigenous culture that evolves around the reindeer. During the visit, you will learn how to throw ‘suopunki’, the Lappish lasso used to catch a reindeer, and to ride the reindeer sleigh. Before returning, you will have a coffee break and learn more about Lappish culture and reindeer.", "13:00:00"),
                (9, "snowmobile safari to a husky farm", 300, "1010010", "This safari will take for a husky sledding experience by snowmobiles. At the husky farm, located North to Saariselkä, you will meet the husky dogs, get the instructions on how to handle the dogs, and enjoy a lovely (approx.) 25 min ride on a sledge pulled by huskies. Two people share a sledge and the drivers can be swapped during the ride. After the safari, you will have a warm juice in a kota and hear more about the life at the farm. During the safari lunch is served on a route. Driving back to Saariselkä by snowmobile.", "08:30:00"),
                (10, "fishing experience by snowmobile", 240, "0100100","The trail on this snowmobile safari takes you to north of Saariselkä to a remote lake. Drill a hole through the ice and try your fishing skills. The catch may even be the jewel of Lapland\'s crystal waters, the Arctic char. You will enjoy a snack by the campfire and have the opportunity to fry the fresh fish you just caught.", "09:00:00"),
                (11, "snowmobile safari in the heart of the nature", 360, "0010000", "Enjoy the great outdoors on this wilderness snowmobile safari to the heart of nature. The trail traverses rugged fells and narrow valleys before coming to the first stop, where you have the chance to try ice fishing and snowshoe walking. You will then continue onwards through the forest – perhaps coming across a herd of reindeer searching for their favourite food, moss and lichen, buried under as much as one metre of snow. Keep your eyes open also for other forest animals searching for food! The weather in Lapland can change quickly – ranging from cold, blizzard conditions to sunshine over crisp and fresh snow – the snowmobile trail we follow may change accordingly. A delicious Lappish style lunch will be served during the day. NOTE: This safari is suitable only for adults and children 15 years and over and requires good physical condition.", "09:00:00"),
                (12, "reindeer safari", 120, "1111111", "This safari introduces you to the Northern transport – reindeer sleigh. In the old days the only means of winter transportation for the people of Lapland was on sleighs pulled by reindeer. Often, there could be as many as 25 - 30 reindeer in a long raito caravan. You will experience this traditional, peaceful way of moving through snowscapes where the only sound you will hear is the light ringing of reindeer bells. Warm drink will be served by the fire.", "10:00:00"),
                (13, "husky safari 10Km", 180, "1111111","Wintertime safari with a team of huskies. The barking of enthusiastic dogs will welcome you to the farm. Before departing on your journey, you will be given instructions on how to control the sleds, which you will ride in pairs. You may swap places at the halfway point. The head musher will talk about the life and training of these Arctic animals and you will also have the chance to take some great photos. Warm drink will be served by a campfire. Transfers to the husky farm by bus.","12:30:00"),
                (14, "husky safari 20Km", 300, "1010010", "Wintertime safari with a team of huskies. The barking of enthusiastic dogs will welcome you to the farm. Before departing on your journey, you will be given instructions on how to control the sleds, which you will ride in pairs. You may swap places at the halfway point. The head musher will talk about the life and training of these Arctic animals and you will also have the chance to take some great photos. Warm drink will be served by a campfire. Transfers to the husky farm by bus.", "10:30:00"),
                (15, "evening safari by reindeer", 120, "0110100", "Sit back in a sleigh pulled by a reindeer and start your journey into the quiet night forest. With some luck you might even see the Northern Lights dancing in the sky! Enjoy the warmth of campfire while sipping warm drink, listen to the sound of the forest and fire, and realise how silent and light Arctic darkness is.", "19:00:00"),
                (16, "aurora hunting on snowshoes", 120, "0100101", "Capture the true feeling of a winter night in the northern woods. Your guide will take you to learn the wintry way of travelling with snowshoes. While walking on the snow, you will experience how the milky light of the moon and stars cast enchanting shadows through the snowfields. Have a break and enjoy some warm berry juice while the only sound you hear is the sough of the forest and fells. If you are lucky, you may even see the Northern Lights. NOTE: This safari is suitable for children of 12 years or older.", "20:00:00"),
                (17, "aurora borealis snowmobile sleigh ride", 180, "1000100", "During this leisurely safari you can just sit back and enjoy the view and ride! Your guide will take you to the fell district to see the beautiful fell scenery with open view to the northern sky. Your journey will head towards a beautiful wilderness cabin where you can enjoy warm berry juice while admiring the nature. If we are lucky and the sky is clear, the moon, stars and even the Northern lights may appear!", "20:00:00"),
                (18, "excursion to aurora borealis camp by bus", 180, "1000010", "This excursion takes you into the northern evening app. 20 km away from the city lights with good view to the northern sky. At the camp you will find the Aurora Borealis theatre build inside a snow igloo presenting a film about the myths and facts of this natural phenomenon along with spectacular photos of the Northern lights. Learn about the Lappish way of living from the stories on an illuminated path outside. Enjoy the delicious traditional reindeer burgers in the wooden Kammi cabin by the open fire. You will also have time to roam around the camp and take pictures. With a little luck the sky is clear and the moon, stars and even the Northern Lights may show up. After the evening, you will be provided with a diploma for Searching the Northern Lights.", "20:00:00"),
                (19, "search of the northern lights by snowmobile", 180, "1001010", "This evening safari takes you in the search of the Northern Lights and to experience the exoticism of an Arctic night. Leaving illuminated city behind, the dark wilderness soon envelopes you. The snow, glittering under the moonlight, paints the scenery with magical shine. Your guide leads the snowmobiles towards the best spots to admire the Northern skies and seek for Northern Lights. With a little luck you are able to witness the sky dancing in the green shades of the Northern Lights. In the lightness of the Arctic night a stop is made to enjoy hot sausages and drinks by the open fire and share stories on the Arctic way of life.", "20:00:00"),
                (20, "search of the northern lights by coach", 180, "0011001", "This safari will take you chasing Aurora Borealis by minibus. The guide will lead you to the best possible spots to observe the phenomena of Arctic sky. With a little luck, if the sky is clear, the moon, the stars and even the Northern lights will show up. On the way the guide will tell you stories about life in Lapland and the Northern lights.", "20:00:00"),
                (21, "tui optional", 180, "1111111", "any optional for TUI", "20:00:00"),
                (22, "travelkids optional", 180,"1111111","any optional for travelkids", "00:00:00"),
                (23, "santas lapland optinal",180,"1111111", "any optional for santas lapland", "00:00:00"),
                (24, "other optional", 180, "1111111", "taylor made safari", "00:00:00");

            CREATE TABLE IF NOT EXISTS user (
                id int unsigned NOT NULL AUTO_INCREMENT,
                email varchar(45) NOT NULL unique,
                password char(64),
                name varchar(18),
                surname varchar(18),
                phone varchar(18),
                admin bool DEFAULT FALSE,
                active bool DEFAULT TRUE,
                PRIMARY KEY (id)
            );

            INSERT IGNORE INTO user (id, email, admin, active) VALUES (1, "hugo@dabug.go", TRUE, TRUE);

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
                email varchar(45) unique,
                name varchar(18) NOT NULL,
                surname varchar(18) NOT NULL,
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

function updateUser($id, $email, $password, $name, $surname, $phone, $pdo){
    $sql = 'UPDATE user SET email = :email, password = :password, name = :name, surname = :surname, phone = :phone WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':surname', $surname);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $stmt->closeCursor();
}

function validateUser($email, $password, $pdo){
    if( ($r = getUserByMail($email, $pdo)) && ($r['password'] === $password) ){
        $_SESSION['email'] = $email;    
        $_SESSION['password'] = $password;    
    }
    if( ($r = getUserByMail($email, $pdo)) && (is_null($r['password'])) && (hash('sha256', $email) === $password) && ($r['active'])){
        $_SESSION['email'] = $email;    
        $_SESSION['register'] = TRUE;
        $_SESSION['id'] = $r['id'];
        $_SESSION['name'] = $r['name'];
        $_SESSION['surname'] = $r['surname'];
        $_SESSION['phone'] = $r['phone'];
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

function getSafarisName($pdo){
    try {
        $sql = 'SELECT id, name FROM safari';
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
?>
