<section id="my_trips">
    <h3>My Trips</h3>
<?php
$me = new Guide($_SESSION['usermail'], $pdo);
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
    
### UPDATE TRIP ######################################
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
    $form_miss = '';
    $submit = "add near miss";
    if (isset($_POST['nm_datetime'], $_POST['nm_place'], $_POST['nm_description'])) {
        $nearmissId = (isset($_GET['miss']) ? $_GET['miss'] : insertInto('nearmiss', 'user_id', $me->id, $pdo));
        $nearmissId = (is_array($nearmissId) ? $nearmissId['id'] : $nearmissId);
        updateTableItemWhere('nearmiss', 'trip_id', $_GET['tid'], 'id', $nearmissId, $pdo);
        updateTableItemWhere('nearmiss', 'nm_datetime', $_POST['nm_datetime'], 'id', $nearmissId, $pdo);
        updateTableItemWhere('nearmiss', 'nm_place', $_POST['nm_place'], 'id', $nearmissId, $pdo);
        updateTableItemWhere('nearmiss', 'nm_description', $_POST['nm_description'], 'id', $nearmissId, $pdo);
        (isset($_POST['guide']) ? updateTableItemWhere('nearmiss', 'guide', 1, 'id', $nearmissId, $pdo) : updateTableItemWhere('nearmiss', 'guide', 0, 'id', $nearmissId, $pdo));
        (isset($_POST['customer']) ? updateTableItemWhere('nearmiss', 'customer', 1, 'id', $nearmissId, $pdo) : updateTableItemWhere('nearmiss', 'customer', 0, 'id', $nearmissId, $pdo));
        header( "refresh:0;url=./?tid=".$_GET['tid'] );
    }
    echo '  
        <div id="near_miss">
            <h5 id="nearmiss_report">Near Miss</h5>';
            
    ### UPDATE NEAR MISS ############################
    if (isset($_GET['tid'],$_GET['miss'])) {
        $miss = selectAllFromWhere('nearmiss', 'id', $_GET['miss'], $pdo);
        foreach ($miss[0] as $k => $v) {
            $_SESSION[$k] = $v;
        }
        $form_miss = '?tid='.$_GET['tid'].'&miss='.$_GET['miss'];
        $submit = "update near miss";
        $customer = ($_SESSION['customer'] ? 'checked' : '');
        $guide = ($_SESSION['guide'] ? 'checked' : '');
        $myunixdate = strtotime($miss[0]['nm_datetime']);
        echo '  Date: '.date("D M j, Y", $myunixdate).'<br>';
    }
    
    echo '  <form action="'.$form_miss.'" method="POST">
                <select name="nm_datetime" required>
                    <option value="" selected disabled hidden>Time</option>';
        for ($i = 0; $i < ($safari[0]['length']/15)+6; $i++){
            $sel = (((value('nm_datetime') == $mytime->format("Y-m-d H:i:s"))) ? 'selected' : '');
            echo '  <option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
            $mytime->add($diff15Min);
        }
    echo '      </select>
                <input type="text" id="nm_place" name="nm_place" required maxlength="150" placeholder="place" value="'.value('nm_place').'">
                <textarea id="nm_description" name="nm_description" required maxlength="270" placeholder="description">'.value('nm_description').'</textarea><br>
                <input type="checkbox" id="guide" name="guide" '.$guide.'> guide<br>
                <input type="checkbox" id="customer" name="customer" '.$customer.'> customer<br>
                <input type="submit" class="button" value="'.$submit.'"><br>
            </form> ';
    if (isset($miss)){
        foreach ($miss[0] as $k => $v) {
            unset($_SESSION[$k]);
        }
    }

    if (count($nearmiss) > 0) {
        echo '<ul>';
        foreach ($nearmiss as $n){
            #$saf = selectAllFromWhere('safari', 'id', $trip['safari_id'], $pdo);
            $involved = ($n['guide'] && $n['customer'] ? 'guide and customer' : ($n['guide'] ? 'guide' : 'customer'));
            echo '  <li><a href="?tid='.$_GET['tid'].'&miss='.$n['id'].'#nearmiss_report">'.date("G:i", strtotime($n['nm_datetime'])).' - '.$n['nm_place'].' - '.$n['nm_description'].' - '.$involved.'</a></li>';
        }
        echo '</ul>';
    }
    else {
        echo "<p>You don't have any near miss in this trip. Yay!</p>";
    }
    echo '</div>';        
    
### ACCIDENT #########################################
    $mytime = new DateTime($trip[0]['date']);
    $form_action = '';
    $submit = "add accident";
    if (isset($_POST['datetime'], $_POST['place'], $_POST['description'], $_POST['customer_name'], $_POST['customer_address'], $_POST['customer_email']) && 
        !empty($_POST['place']) && !empty($_POST['description']) && !empty($_POST['customer_name']) && !empty($_POST['customer_address']) && !empty($_POST['customer_email'])) {
        $accidentId = (isset($_GET['acc']) ? $_GET['acc'] : insertInto('accident', 'user_id', $me->id, $pdo));
        $accidentId = (is_array($accidentId) ? $accidentId['id'] : $accidentId);
        updateTableItemWhere('accident', 'trip_id', $_GET['tid'], 'id', $accidentId, $pdo);
        $inputs = array('datetime', 'place', 'description', 'customer_name', 'customer_address', 'customer_email', 'customer_erp_link', 'sm_reg_n', 'total_euro', 'total_paid', 'sm_model', 'injury');
        foreach ($inputs as $in) {
            (!isset($_POST[$in]) && empty($_POST[$in]) ?: updateTableItemWhere('accident', $in, $_POST[$in], 'id', $accidentId, $pdo));
        }
        $checks = array('waiver', 'first_aid', 'hospital_offer', 'hospital_visit');
        foreach($checks as $c) {
            (isset($_POST[$c]) ? updateTableItemWhere('accident', $c, 1, 'id', $accidentId, $pdo) : updateTableItemWhere('accident', $c, 0, 'id', $accidentId, $pdo));
        }
        header( "refresh:0;url=./?tid=".$_GET['tid'] );
    }
    echo '<div id="accident">
            <h5 id="accident_report">Accident</h5>';
    
    ### UPDATE ACCIDENT #############################
    if (isset($_GET['tid'],$_GET['acc'])) {
        $acc = selectAllFromWhere('accident', 'id', $_GET['acc'], $pdo);
        foreach ($acc[0] as $k => $v) {
            $_SESSION[$k] = $v;
        }
        $form_action = '?tid='.$_GET['tid'].'&acc='.$_GET['acc'];
        $submit = "update accident";
        $waiver = ($_SESSION['waiver'] ? 'checked' : '');
        $first_aid = ($_SESSION['first_aid'] ? 'checked' : '');
        $hospital_offer = ($_SESSION['hospital_offer'] ? 'checked' : '');
        $hospital_visit = ($_SESSION['hospital_visit'] ? 'checked' : '');
        $myunixdate = strtotime($acc[0]['datetime']);
        echo '  Date: '.date("D M j, Y", $myunixdate).'<br>';
    }

    echo '  <form action="'.$form_action.'" method="POST">
                <select name="datetime" required>
                    <option value="" selected disabled hidden>Time</option>';
            for ($i = 0; $i < ($safari[0]['length']/15)+6; $i++){
                $sel = (((value('datetime') == $mytime->format("Y-m-d H:i:s"))) ? 'selected' : '');
                echo '  <option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
                $mytime->add($diff15Min);
            }
    echo '      </select>
                <input type="text" id="place" name="place" required maxlength="150" placeholder="place" value="'.value('place').'">
                <textarea id="description" name="description" required maxlength="270" placeholder="description">'.value('description').'</textarea>
                <input type="text" id="customer_erp_link" name="customer_erp_link" maxlength="150" placeholder="customer erp link" value="'.value('customer_erp_link').'">
                <input type="text" id="customer_name" name="customer_name" required maxlength="150" placeholder="customer name" value="'.value('customer_name').'">
                <input type="text" id="customer_address" name="customer_address" required maxlength="150" placeholder="customer address" value="'.value('customer_address').'">
                <input type="email" id="customer_email" name="customer_email" required maxlength="45" placeholder="customer email" value="'.value('customer_email').'">
                <input type="text" id="sm_reg_n" name="sm_reg_n" maxlength="27" placeholder="snowmobile register number" value="'.value('sm_reg_n').'">
                <input type="text" id="sm_model" name="sm_model" maxlength="30" placeholder="snowmobile model" value="'.value('sm_model').'"><br>
                <input type="checkbox" id="waiver" name="waiver" '.$waiver.'> waiver<br>
                <input type="number" id="total_euro" name="total_euro" min="0.00" max="10000.00" step="0.01" placeholder="total euro" value="'.value('total_euro').'">
                <input type="number" id="total_paid" name="total_paid" min="0.00" max="10000.00" step="0.01" placeholder="total paid" value="'.value('total_paid').'">
                <textarea id="injury" name="injury" maxlength="270" placeholder="injury">'.value('injury').'</textarea><br>
                <input type="checkbox" id="first_aid" name="first_aid" '.$first_aid.'> first aid<br>
                <input type="checkbox" id="hospital_offer" name="hospital offer" '.$hospital_offer.'> hospital offer<br>
                <input type="checkbox" id="hospital_visit" name="hospital visit" '.$hospital_visit.'> hospital visit<br>
                <input type="submit" class="button" value="'.$submit.'"><br>
            </form>';
    if (isset($acc)){        
        foreach ($acc[0] as $k => $v) {
            unset($_SESSION[$k]);
        }
    }
    
    if (count($accident) > 0) {
        echo '  <ul>';
        foreach ($accident as $n){
            #$saf = selectAllFromWhere('safari', 'id', $trip['safari_id'], $pdo);
            echo '  <li><a href="?tid='.$_GET['tid'].'&acc='.$n['id'].'#accident_report">'.date("G:i", strtotime($n['datetime'])).' - '.$n['place'].' - '.$n['description'].' - '.$n['customer_name'].'</a></li>';
        }
        echo '</ul>';
    }
    else {
        echo "<p>You don't have any accident in this trip. Yay!</p>";
    }
    echo '</div>
            <div class="button_svg"><a href="./">'.file_get_contents('img/back.svg').'</a></div>';
}
######################################################

else {
    $mytime = new DateTime('NOW');
    $min = (($mytime->format("i") > 29) ? 60 : 30);
    $diffMin = new DateInterval('PT'.($min - $mytime->format('i')).'M');
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
            <input type="url" id="erp_link" name="erp_link" maxlength="150" placeholder="https://erp_link" pattern="https://.*" value="'.value('erp_link').'" >
            <input type="text" id="route" name="route" required maxlength="150" placeholder="route" value="'.value('route').'" >
            <input type="submit" class="button" value="add trip">
        </form>
    ';
    if ($me->trip) {
        echo '<ol>';
        #array_multisort(array_column( $trips, 'date' ), SORT_DESC, $trips); // reverse order
        foreach ($me->trip as $trip){
            $ac = in_array($trip['id'], array_column($me->accident, 'trip_id'));
            $nm = in_array($trip['id'], array_column($me->nearmiss, 'trip_id'));
            $saf = selectAllFromWhere('safari', 'id', $trip['safari_id'], $pdo);
            $tripclass = (($ac) ? 'class_red' : (($nm) ? 'class_orange' : (is_null($trip['remarks']) ? 'class_pale' : 'class_green')));
            echo '  <li class="'.$tripclass.'"><a href="?tid='.$trip['id'].'">'.date("d M Y H:i", strtotime($trip['date'])).' - '.$saf[0]['name'].'</a></li>';
        }
        echo '</ol>';
    }
    else {
        echo "<p>You don't have any trips... yet</p>";
    }
}
?>
</section>
