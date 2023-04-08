<?php
#$safaris = selectAllFrom('safari', $pdo);

if (isset($_GET['trip'])) {
    $sql = "select trip.date, safari.name, concat(user.fname, ' ', user.lname), trip.erp_link, trip.route, trip.remarks, trip.updated from trip LEFT JOIN safari on trip.safari_id = safari.id LEFT JOIN user on trip.user_id = user.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION['trip_report'] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['trip_report'][] = $row;
    }
    array_unshift($_SESSION['trip_report'], array('date', 'safari', 'guide', 'erp link', 'route', 'remarks', 'updated'));
    header( "refresh:0;url=views/downloads.php" );

}

if (isset($_GET['nearmiss'])) {
    $sql = "select nearmiss.datetime, trip.date, safari.name, concat(user.fname, ' ', user.lname), trip.erp_link, trip.route, trip.remarks, nearmiss.place, nearmiss.description, nearmiss.guide, nearmiss.customer from nearmiss LEFT JOIN trip on nearmiss.trip_id = trip.id LEFT JOIN user on nearmiss.user_id = user.id LEFT JOIN safari on trip.safari_id = safari.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION['nearmiss_report'] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['nearmiss_report'][] = $row;
    }
    array_unshift($_SESSION['nearmiss_report'], array('date', 'safari started', 'safari', 'guide', 'erp link', 'route', 'trip remarks', 'place', 'description', 'guide involved', 'customer involved'));
    header( "refresh:0;url=views/downloads.php" );
}

if (isset($_GET['accident'])) {
    $sql = "select accident.datetime, trip.date, safari.name, concat(user.fname, ' ', user.lname), trip.erp_link, trip.route, trip.remarks, accident.place, accident.description, accident.customer_erp_link, accident.customer_name, accident.customer_address, accident.customer_email, accident.sm_reg_n, accident.sm_model, accident.waiver, accident.total_euro, accident.total_paid, accident.injury, accident.first_aid, accident.hospital_offer, accident.hospital_visit from accident LEFT JOIN trip on accident.trip_id = trip.id LEFT JOIN user on accident.user_id = user.id LEFT JOIN safari on trip.safari_id = safari.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION['accident_report'] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['accident_report'][] = $row;
    }
    array_unshift($_SESSION['accident_report'], array('date', 'safari started', 'safari', 'guide', 'erp link', 'route', 'trip remarks', 'place', 'description', 'customer erp link', 'customer name', 'customer address', 'customer email', 'sm reg n', 'sm model', 'waiver', 'total', 'total paid', 'injury', 'fist aid by staff', 'hospital offer', 'hospital visit'));
    header( "refresh:0;url=views/downloads.php" );
}


?>
<section id="reports">
    <h3>Reports</h3>
        <a href="./?reports&trip" ><div>trip</div></a>
        <a href="./?reports&nearmiss" ><div>near miss</div></a>
        <a href="./?reports&accident" ><div>accident</div></a>
</section>
