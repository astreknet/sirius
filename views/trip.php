<section id="my_trips">
    <h3>My Trips</h3>
<?php
if (isset($_GET['tid']) && $me->userlevel > 0 ) {
    $trip = selectAllFromWhere('trip', 'id', $_GET['tid'], $pdo);
    $safari = selectAllFromWhere('safari', 'id', $trip[0]['safari_id'], $pdo);
    $mytime = new DateTime($trip[0]['date']);
    $diff15Min = new DateInterval('PT15M');
    $nearmiss = selectAllFromWhere('nearmiss', 'trip_id', $_GET['tid'], $pdo);
    $accident = selectAllFromWhere('accident', 'trip_id', $_GET['tid'], $pdo);
    $h4class = (count($accident) > 0 ? 'class_red' : (count($nearmiss) > 0 ? 'class_orange' : (is_null($trip[0]['remarks']) ? 'class_pale' : 'class_green')));
    
    if (!empty($trip[0]['erp_link'])) { 
        echo '<h4 class="'.$h4class.'"><a href="'.$trip[0]['erp_link'].'" target="_blank">'.$safari[0]['name'].', '.date("j M Y G:i", strtotime($trip[0]['date'])).'</a></h4>';
    }
    else {
        echo '<h4 class="'.$h4class.'">'.$safari[0]['name'].', '.date("j M Y G:i", strtotime($trip[0]['date'])).'</h4>';
    }
        
### UPDATE TRIP #####################################
    if (isset($_POST['erp_link'], $_POST['route'], $_POST['remarks']) && $me->userlevel > 0) {
        updateTableItemWhere('trip', 'erp_link', $_POST['erp_link'], 'id', $_GET['tid'], $pdo);
        updateTableItemWhere('trip', 'route', $_POST['route'], 'id', $_GET['tid'], $pdo);
        updateTableItemWhere('trip', 'remarks', $_POST['remarks'], 'id', $_GET['tid'], $pdo);
        header( "refresh:0;url=./" );
    }
    echo '
        <div id="update_trip"> 
        <form action="" method="POST">
            <input type="url" id="erp_link" name="erp_link" maxlength="150" placeholder="https://erp_link" pattern="https://.*" value="'.$trip[0]['erp_link'].'">
            <input type="text" id="route" name="route" required maxlength="150" placeholder="route" value="'.$trip[0]['route'].'">
            <textarea id="remarks" name="remarks" maxlength="270" placeholder="Anything remarkable?"></textarea>
            <input type="submit" class="button" value="update trip">
        </form>
        </div>';
    
### NEAR MISS ########################################        
    if (isset($_POST['nm_datetime'], $_POST['nm_place'], $_POST['nm_description'])) {
        $nearmissId = insertInto('nearmiss', 'user_id', $me->id, $pdo);
        updateTableItemWhere('nearmiss', 'trip_id', $_GET['tid'], 'id', $nearmissId['id'], $pdo);
        updateTableItemWhere('nearmiss', 'datetime', $_POST['datetime'], 'id', $nearmissId['id'], $pdo);
        updateTableItemWhere('nearmiss', 'place', $_POST['place'], 'id', $nearmissId['id'], $pdo);
        updateTableItemWhere('nearmiss', 'description', $_POST['description'], 'id', $nearmissId['id'], $pdo);
        (!isset($_POST['guide']) ?: updateTableItemWhere('nearmiss', 'guide', 1, 'id', $nearmissId['id'], $pdo));
        (!isset($_POST['customer']) ?: updateTableItemWhere('nearmiss', 'customer', 1, 'id', $nearmissId['id'], $pdo));
        header( "refresh:0;url=./?tid=".$_GET['tid'] );
    }
    echo '  
        <div id="near_miss">
        <h5>Near Miss</h5>
            <form action="" method="POST">
                <select name="nm_datetime" required>
                    <option value="" selected disabled hidden>Time</option>';
        for ($i = 0; $i < ($safari[0]['length']/15)+6; $i++){
            $sel = ((isset($_POST['time']) && ($_POST['time'] == $mytime->format("Y-m-d H:i"))) ? 'selected' : '');
            echo '  <option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
            $mytime->add($diff15Min);
        }
    echo '      </select>
                <input type="text" id="nm_place" name="nm_place" required maxlength="150" placeholder="place">
                <textarea id="nm_description" name="nm_description" required maxlength="270" placeholder="description"></textarea><br>
                <input type="checkbox" id="guide" name="guide"> guide<br>
                <input type="checkbox" id="customer" name="customer" checked> customer<br>
                <input type="submit" class="button" value="add near miss"><br>
            </form> ';
    if (count($nearmiss) > 0) {
        echo '<ul>';
        foreach ($nearmiss as $n){
            #$saf = selectAllFromWhere('safari', 'id', $trip['safari_id'], $pdo);
            $involved = ($n['guide'] && $n['customer'] ? 'guide and customer' : ($n['guide'] ? 'guide' : 'customer'));
            echo '  <li>'.date("G:i", strtotime($n['datetime'])).' - '.$n['place'].' - '.$n['description'].' - '.$involved.'</li>';
        }
        echo '</ul>';
    }
    else {
        echo "<p>You don't have any near miss in this trip. Yay!</p>";
    }
    echo '</div>';        
### ACCIDENT ########################################
    if (isset($_POST['datetime'], $_POST['place'], $_POST['description'])) {
        $accidentId = insertInto('accident', 'user_id', $me->id, $pdo);
        updateTableItemWhere('accident', 'trip_id', $_GET['tid'], 'id', $nearmissId['id'], $pdo);
        updateTableItemWhere('accident', 'datetime', $_POST['datetime'], 'id', $nearmissId['id'], $pdo);
        updateTableItemWhere('accident', 'place', $_POST['place'], 'id', $nearmissId['id'], $pdo);
        updateTableItemWhere('accident', 'description', $_POST['description'], 'id', $nearmissId['id'], $pdo);
        (!isset($_POST['guide']) ?: updateTableItemWhere('nearmiss', 'guide', 1, 'id', $nearmissId['id'], $pdo));
        (!isset($_POST['customer']) ?: updateTableItemWhere('nearmiss', 'customer', 1, 'id', $nearmissId['id'], $pdo));
        header( "refresh:0;url=./?tid=".$_GET['tid'] );
    }
    echo '  
        <div id="accident">
        <h5>Accident</h5>
            <form action="" method="POST">
                <select name="datetime" required>
                    <option value="" selected disabled hidden>Time</option>';
        for ($i = 0; $i < ($safari[0]['length']/15)+6; $i++){
            $sel = ((isset($_POST['time']) && ($_POST['time'] == $mytime->format("Y-m-d H:i"))) ? 'selected' : '');
            echo '  <option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
            $mytime->add($diff15Min);
        }
    echo '      </select>
                <input type="text" id="place" name="place" required maxlength="150" placeholder="place">
                <textarea id="description" name="description" required maxlength="270" placeholder="description"></textarea>
                <input type="text" id="customer_erp_link" name="customer_erp_link" maxlength="150" placeholder="customer erp link">
                <input type="text" id="customer_name" name="customer_name" required maxlength="150" placeholder="customer name">
                <input type="text" id="customer_address" name="customer_address" required maxlength="150" placeholder="customer address">
                <input type="email" id="customer_email" name="customer_email" required maxlength="45" placeholder="customer email">
                <input type="text" id="sm_reg_n" name="sm_reg_n" maxlength="27" placeholder="snowmobile register number">
                <input type="text" id="sm_model" name="sm_model" maxlength="30" placeholder="snowmobile model"><br>
                <input type="checkbox" id="waiver" name="waiver"> waiver<br>
                <input type="number" id="total_euro" name="total_euro" min="0.00" max="10000.00" step="0.01" placeholder="total euro">
                <input type="number" id="total_paid" name="total_paid" min="0.00" max="10000.00" step="0.01" placeholder="total paid">
                <textarea id="injury" name="injury" maxlength="270" placeholder="injury"></textarea><br>
                <input type="checkbox" id="first_aid" name="first_aid"> first aid<br>
                <input type="checkbox" id="hospital_offer" name="hospital offer"> hospital offer<br>
                <input type="checkbox" id="hospital_visit" name="hospital visit"> hospital visit<br>
                <input type="submit" class="button" value="add accident"><br>
            </form>';
    if (count($accident) > 0) {
        echo '  <ul>';
        foreach ($accident as $n){
            #$saf = selectAllFromWhere('safari', 'id', $trip['safari_id'], $pdo);
            $involved = ($n['guide'] && $n['customer'] ? 'guide and customer' : ($n['guide'] ? 'guide' : 'customer'));
            echo '  <li>'.date("G:i", strtotime($n['datetime'])).' - '.$n['place'].' - '.$n['description'].' - '.$involved.'</li>';
            }
        echo '</ul>';
    }
    else {
        echo "<p>You don't have any accident in this trip. Yay!</p>";
    }
    echo '</div>';
    echo ' <div class="button"><a href="./">back</a></div>';
}

else {
    $mytime = new DateTime('NOW');
    $diffMin = new DateInterval('PT'.(60 - $mytime->format('i')).'M');
    $diff15Min = new DateInterval('PT15M');
    $diff30Min = new DateInterval('PT30M');
    $mytime->add($diffMin);

    if (isset($_POST['safari'], $_POST['time'], $_POST['route']) && $me->userlevel > 0 && !(selectAllFromWhere('trip', 'date', $_POST['time'], $pdo) && selectAllFromWhere('trip', 'user_id', $me->id, $pdo))) {
        $erp_link = (isset($_POST['erp_link']) ? $_POST['erp_link'] : NULL);
        $tripId = insertInto('trip', 'user_id', $me->id, $pdo); 
        updateTableItemWhere('trip', 'safari_id', $_POST['safari'], 'id', $tripId['id'], $pdo);
        updateTableItemWhere('trip', 'erp_link', $erp_link, 'id', $tripId['id'], $pdo);
        updateTableItemWhere('trip', 'date', $_POST['time'], 'id', $tripId['id'], $pdo);
        updateTableItemWhere('trip', 'route', $_POST['route'], 'id', $tripId['id'], $pdo);
        header( "refresh:0;url=./" );
    }

    echo '
        <form method="POST">
            <select id="safari" name="safari" required>
                <option value="" selected disabled hidden>Choose a safari</option>
    ';
    $safari = selectAllFromWhere('safari', 'active', 1, $pdo);
    foreach($safari as $s){
        $sel = ((isset($_POST['safari']) && ($_POST['safari'] == $s['id'])) ? 'selected' : '');
        if ($s['active']) {
            echo '<option value="'.$s['id'].'" '.$sel.'>'.$s['name'].'</option>';
        }
    }
    echo '
            </select>
            <select name="time" required>
                <option value="" selected disabled hidden>Time</option>
    ';
    for ($i = 0; $i < 9; $i++){
        $sel = ((isset($_POST['time']) && ($_POST['time'] == $mytime->format("Y-m-d H:i"))) ? 'selected' : '');
        echo '  <option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
        $mytime->add($diff30Min);
    }
    echo '
            </select>
            <input type="url" id="erp_link" name="erp_link" maxlength="150" placeholder="https://erp_link" pattern="https://.*" value="'.value('erp_link').'">
            <input type="text" id="route" name="route" required maxlength="150" placeholder="route" value="'.value('route').'">
            <input type="submit" class="button" value="add trip">
        </form>
    ';
    if ($trips = selectAllFromWhere('trip', 'user_id', $me->id, $pdo)) {
        echo '<ol>';
        #array_multisort(array_column( $trips, 'date' ), SORT_DESC, $trips); // reverse order
        foreach ($trips as $trip){
            $nm = selectAllFromWhere('nearmiss', 'trip_id', $trip['id'], $pdo);
            $ac = selectAllFromWhere('accident', 'trip_id', $trip['id'], $pdo);
            $saf = selectAllFromWhere('safari', 'id', $trip['safari_id'], $pdo);
            $tripclass = (count($ac) > 0 ? 'class_red' : (count($nm) > 0 ? 'class_orange' : (is_null($trip['remarks']) ? 'class_pale' : 'class_green')));
            echo '  <li class="'.$tripclass.'"><a href="?tid='.$trip['id'].'">'.date("d M Y H:i", strtotime($trip['date'])).' - '.$saf[0]['name'].'</a></li>';
        }
        echo '</ol>';
    }
    else {
        echo "<p>You don't have any trip yet!</p>";
    }
}
?>
</section>
