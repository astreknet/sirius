<?php

if (isset($_GET['trip'])) {
    $sql = "SELECT  trip.datetime,
                    safari.name,
                    concat(user.fname, ' ', user.lname),
                    trip.erp_link,
                    trip.route,
                    trip.remarks,
                    trip.updated 
            FROM trip LEFT JOIN safari ON trip.safari_id = safari.id LEFT JOIN user ON trip.user_id = user.id";
    $csvheader = array('date', 'safari', 'guide', 'erp link', 'route', 'remarks', 'updated');
    prepareReport('trip_report', $sql, $csvheader, $pdo);
}

if (isset($_GET['nearmiss'])) {
    $sql = "SELECT  nearmiss.nm_datetime,
                    trip.datetime,
                    safari.name,
                    concat(user.fname, ' ', user.lname),
                    trip.erp_link,
                    trip.route,
                    trip.remarks,
                    nearmiss.nm_place,
                    nearmiss.nm_description,
                    nearmiss.guide,
                    nearmiss.customer 
            FROM nearmiss LEFT JOIN trip ON nearmiss.trip_id = trip.id LEFT JOIN user ON nearmiss.user_id = user.id LEFT JOIN safari ON trip.safari_id = safari.id";
    $csvheader = array('date', 'safari started', 'safari', 'guide', 'erp link', 'route', 'trip remarks', 'place', 'description', 'guide involved', 'customer involved');
    prepareReport('nearmiss_report', $sql, $csvheader, $pdo);
}

if (isset($_GET['accident'])) {
    $sql = "SELECT  accident.datetime,
                    trip.datetime,
                    safari.name,
                    concat(user.fname, ' ', user.lname),
                    trip.erp_link,
                    trip.route,
                    trip.remarks,
                    accident.place,
                    accident.description,
                    accident.customer_erp_link,
                    accident.customer_name,
                    accident.customer_address,
                    accident.customer_email,
                    accident.sm_reg_n,
                    accident.sm_model,
                    accident.waiver,
                    accident.total_euro,
                    accident.total_paid,
                    accident.injury,
                    accident.first_aid,
                    accident.hospital_offer,
                    accident.hospital_visit 
            FROM accident LEFT JOIN trip ON accident.trip_id = trip.id LEFT JOIN user ON accident.user_id = user.id LEFT JOIN safari ON trip.safari_id = safari.id";
    $csvheader = array( 'date', 
                        'safari started', 
                        'safari', 
                        'guide', 
                        'erp link', 
                        'route', 
                        'trip remarks', 
                        'place', 
                        'description', 
                        'customer erp link', 
                        'customer name', 
                        'customer address', 
                        'customer email', 
                        'sm reg n', 
                        'sm model', 
                        'waiver', 
                        'total', 
                        'total paid', 
                        'injury', 
                        'first aid by staff', 
                        'hospital offer', 
                        'hospital visit');
    prepareReport('accident_report', $sql, $csvheader, $pdo);
}

if (isset($_GET['issue_nearmiss'])) {
    $sql = "SELECT  issue.datetime,
                    concat(user.fname, ' ', user.lname),
                    issue.place,
                    issue.description 
            FROM issue LEFT JOIN user ON issue.user_id = user.id WHERE injury IS NULL or injury = ''";
    $csvheader = array('date', 'guide', 'place', 'description');
    prepareReport('work_nearmiss_report', $sql, $csvheader, $pdo);
}

if (isset($_GET['issue_accident'])) {
    $sql = "SELECT  issue.datetime,
                    concat(user.fname, ' ', user.lname),
                    issue.place,
                    issue.description,
                    issue.injury,
                    issue.first_aid,
                    issue.hospital_visit 
            FROM issue LEFT JOIN user ON issue.user_id = user.id WHERE injury IS NOT NULL and injury != ''";
    $csvheader = array('date', 'guide', 'place', 'description', 'injury', 'first aid', 'hospital visit');
    prepareReport('work_accident_report', $sql, $csvheader, $pdo);
}

?>

<section id="reports">
    <h3>Reports</h3>
        <a href="./?reports&trip" ><div>trip</div></a>
        <a href="./?reports&nearmiss" ><div>near miss</div></a>
        <a href="./?reports&accident" ><div>accident</div></a>
        <a href="./?reports&issue_nearmiss" ><div>work near miss</div></a>
        <a href="./?reports&issue_accident" ><div>work accident</div></a>
</section>
