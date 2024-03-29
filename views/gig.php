<section id="my_gigs">
    <h3>My Trips</h3>
<?php
$me = new Guide($_SESSION['usermail'], $pdo);
if (isset($_GET['tid']) && $me->userlevel > 0 ) {
    $gig = selectAllFromWhere('gig', 'id', $_GET['tid'], $pdo);
    $safari = selectAllFromWhere('safari', 'id', $gig[0]['safari_id'], $pdo);
    $mytime = new DateTime($gig[0]['datetime']);
    $diff15Min = new DateInterval('PT15M');
    $nearmiss = selectAllFromWhere('nearmiss', 'gig_id', $_GET['tid'], $pdo);
    $accident = selectAllFromWhere('accident', 'gig_id', $_GET['tid'], $pdo);
    $h4class = (count($accident) > 0 ? 'class_red' : (count($nearmiss) > 0 ? 'class_orange' : (is_null($gig[0]['remarks']) ? 'class_pale' : 'class_green')));
    
    if (!empty($gig[0]['erp_link'])) { 
        echo '<h4 class="'.$h4class.'"><a href="'.$gig[0]['erp_link'].'" target="_blank">'.$safari[0]['name'].', '.date("j M Y G:i", strtotime($gig[0]['datetime'])).'</a></h4>';
    }
    else {
        echo '<h4 class="'.$h4class.'">'.$safari[0]['name'].', '.date("j M Y G:i", strtotime($gig[0]['datetime'])).'</h4>';
    }

    #echo var_dump($accident).'<br>';
    #echo var_dump($acc).'<br>';
    #echo var_dump($me->accident).'<br>';


### UPDATE TRIP ######################################
    if (isset($_POST['erp_link'], $_POST['route'], $_POST['remarks']) && $me->userlevel > 0) {
        updateTableItemWhere('gig', 'erp_link', $_POST['erp_link'], 'id', $_GET['tid'], $pdo);
        updateTableItemWhere('gig', 'route', $_POST['route'], 'id', $_GET['tid'], $pdo);
        updateTableItemWhere('gig', 'remarks', $_POST['remarks'], 'id', $_GET['tid'], $pdo);
        header( "refresh:0;url=./" );
    }
    echo '
        <div id="update_gig"> 
        <form action="" method="POST">
            <input type="url" id="erp_link" name="erp_link" maxlength="150" placeholder="https://erp_link" pattern="https://.*" value="'.$gig[0]['erp_link'].'">
            <input type="text" id="route" name="route" required maxlength="150" placeholder="route" value="'.$gig[0]['route'].'">
            <textarea id="remarks" name="remarks" maxlength="270" placeholder="Anything remarkable?">'.$gig[0]['remarks'].'</textarea>
            <input type="submit" class="button" value="update gig">
        </form>
        </div>';
    
### NEAR MISS ########################################        
    $form_miss = '';
    $submit = "add near miss";
    if (isset($_POST['nm_datetime'], $_POST['nm_place'], $_POST['nm_description'])) {
        $nearmissId = (isset($_GET['miss']) ? $_GET['miss'] : insertInto('nearmiss', 'user_id', $me->id, $pdo));
        $nearmissId = (is_array($nearmissId) ? $nearmissId['id'] : $nearmissId);
        updateTableItemWhere('nearmiss', 'gig_id', $_GET['tid'], 'id', $nearmissId, $pdo);
        $inputs = array('nm_datetime', 'nm_place', 'nm_description');
        $checks = array('guide', 'customer');
        $me->updateTable('nearmiss', $nearmissId, $inputs, $checks, $pdo);
        header( "refresh:0;url=./?tid=".$_GET['tid'] );
    }
    echo '  
        <div id="near_miss">
            <h5 id="nearmiss_report">Near Miss</h5>';
            
    ### UPDATE NEAR MISS ############################
    if (isset($_GET['tid'],$_GET['miss'])) {
        $miss = selectAllFromWhere('nearmiss', 'id', $_GET['miss'], $pdo);
        sessionForm($miss[0], TRUE);
        $form_miss = '?tid='.$_GET['tid'].'&miss='.$_GET['miss'];
        $submit = "update near miss";
        $customer = ($_SESSION['customer'] ? 'checked' : '');
        $guide = ($_SESSION['guide'] ? 'checked' : '');
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
        sessionForm($miss[0], FALSE);
    }

    if (count($nearmiss) > 0) {
        echo '<ul>';
        foreach ($nearmiss as $n){
            #$saf = selectAllFromWhere('safari', 'id', $gig['safari_id'], $pdo);
            $involved = ($n['guide'] && $n['customer'] ? 'guide and customer' : ($n['guide'] ? 'guide' : 'customer'));
            echo '  <li><a href="?tid='.$_GET['tid'].'&miss='.$n['id'].'#nearmiss_report">'.date("G:i", strtotime($n['nm_datetime'])).' - '.$n['nm_place'].' - '.$n['nm_description'].' - '.$involved.'</a></li>';
        }
        echo '</ul>';
    }
    else {
        echo "<p>You don't have any near miss in this gig. Yay!</p>";
    }
    echo '</div>';        
    
### ACCIDENT #########################################
    $mytime = new DateTime($gig[0]['datetime']);
    $form_action = '';
    $submit = "add accident";
    if (isset($_POST['datetime'], $_POST['place'], $_POST['description'], $_POST['customer_name'], $_POST['customer_address'], $_POST['customer_email']) && 
        !empty($_POST['place']) && !empty($_POST['description']) && !empty($_POST['customer_name']) && !empty($_POST['customer_address']) && !empty($_POST['customer_email'])) {
        $accidentId = (isset($_GET['acc']) ? $_GET['acc'] : insertInto('accident', 'user_id', $me->id, $pdo));
        $accidentId = (is_array($accidentId) ? $accidentId['id'] : $accidentId);
        updateTableItemWhere('accident', 'gig_id', $_GET['tid'], 'id', $accidentId, $pdo);
        $inputs = array('datetime', 'place', 'description', 'customer_name', 'customer_address', 'customer_email', 'customer_erp_link', 'sm_reg_n', 'total_euro', 'total_paid', 'sm_model', 'injury');
        $checks = array('waiver', 'first_aid', 'hospital_offer', 'hospital_visit');
        $me->updateTable('accident', $accidentId, $inputs, $checks, $pdo);
        header( "refresh:0;url=./?tid=".$_GET['tid'] );
    }
    echo '<div id="accident">
            <h5 id="accident_report">Accident</h5>';
    
    ### UPDATE ACCIDENT #############################
    if (isset($_GET['tid'],$_GET['acc'])) {
        $acc = selectAllFromWhere('accident', 'id', $_GET['acc'], $pdo);
        sessionForm($acc[0], TRUE);
        $form_action = '?tid='.$_GET['tid'].'&acc='.$_GET['acc'];
        $submit = "update accident";
        $waiver = ($_SESSION['waiver'] ? 'checked' : '');
        $first_aid = ($_SESSION['first_aid'] ? 'checked' : '');
        $hospital_offer = ($_SESSION['hospital_offer'] ? 'checked' : '');
        $hospital_visit = ($_SESSION['hospital_visit'] ? 'checked' : '');
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
                <input type="file" id="image0" name="image0" accept="image/png, image/jpeg">
                <input type="file" id="image1" name="image1" accept="image/png, image/jpeg">
                <input type="file" id="image2" name="image2" accept="image/png, image/jpeg">
                <input type="submit" class="button" value="'.$submit.'"><br>
            </form>';
    if (isset($acc)){        
        sessionForm($acc[0], FALSE);
    }
    
    if (count($accident) > 0) {
        echo '  <ul>';
        foreach ($accident as $n){
            #$saf = selectAllFromWhere('safari', 'id', $gig['safari_id'], $pdo);
            echo '  <li><a href="?tid='.$_GET['tid'].'&acc='.$n['id'].'#accident_report">'.date("G:i", strtotime($n['datetime'])).' - '.$n['place'].' - '.$n['description'].' - '.$n['customer_name'].'</a></li>';
        }
        echo '</ul>';
    }
    else {
        echo "<p>You don't have any accident in this gig. Yay!</p>";
    }
    echo '</div>
            <div class="button_svg"><a href="./">'.file_get_contents('img/back.svg').'</a></div>';
}
######################################################

else {
    $nowtime = new DateTime('NOW');
    $maxtime = new DateTime('NOW');
    $min = (($nowtime->format("i") > 29) ? 60 : 30);
    $diffMin = new DateInterval('PT'.($min - $nowtime->format('i')).'M');
    $nowtime = $nowtime->add($diffMin);
    $maxtime = $maxtime->add($diffMin);
    $diff15Min = new DateInterval('PT15M');
    $diff30Min = new DateInterval('PT30M');
    $diff6H = new DateInterval('PT6H');
    $maxtime = $maxtime->add($diff6H);

    if (isset($_POST['safari_id'], $_POST['datetime'], $_POST['route']) && $me->userlevel > 0 && !(selectAllFromWhere('gig', 'datetime', $_POST['datetime'], $pdo) && selectAllFromWhere('gig', 'user_id', $me->id, $pdo))) {
        $erp_link = (isset($_POST['erp_link']) ? $_POST['erp_link'] : NULL);
        $gigId = insertInto('gig', 'user_id', $me->id, $pdo);
        $inputs = array('safari_id', 'erp_link', 'datetime', 'route', 'remarks');
        $checks = array();  
        $me->updateTable('gig', $gigId['id'], $inputs, $checks, $pdo);
        header( "refresh:0;url=./" );
    }

    echo '
        <form method="POST">
            <input type="datetime-local" id="datetime" name="datetime" min="'.$nowtime->format("Y-m-d H:i").'" max="'.$maxtime->format("Y-m-d H:i").'" required value="'.$nowtime->format("Y-m-d H:i").'"><br>
            <select id="safari" name="safari_id" required>
                <option value="" selected disabled hidden>Choose a safari</option>
    ';
    $safari = selectAllFromWhere('safari', 'active', 1, $pdo);
    foreach($safari as $s){
        $sel = ((isset($_POST['safari_id']) && ($_POST['safari_id'] == $s['id'])) ? 'selected' : '');
        if ($s['active']) {
            echo '<option value="'.$s['id'].'" '.$sel.'>'.$s['name'].'</option>';
        }
    }
    echo '  </select>';

    if ($me->userlevel > 1) {
        echo '<a href="./?safaris">or... add a safari!</a><br>';
    }

    echo '  <input type="url" id="erp_link" name="erp_link" maxlength="150" placeholder="https://erp_link" pattern="https://.*" value="'.value('erp_link').'" ><br>
            <input type="text" id="route" name="route" required maxlength="150" placeholder="route" value="'.value('route').'" ><br>
            <input type="submit" class="button" value="add gig">
        </form>
    ';
    if ($me->gig) {
        echo '<ol>';
        #array_multisort(array_column( $gigs, 'datetime' ), SORT_DESC, $gigs); // reverse order
        foreach ($me->gig as $gig){
            $ac = in_array($gig['id'], array_column($me->accident, 'gig_id'));
            $nm = in_array($gig['id'], array_column($me->nearmiss, 'gig_id'));
            $saf = selectAllFromWhere('safari', 'id', $gig['safari_id'], $pdo);
            $gigclass = (($ac) ? 'class_red' : (($nm) ? 'class_orange' : (is_null($gig['remarks']) ? 'class_pale' : 'class_green')));
            echo '  <li class="'.$gigclass.'"><a href="?tid='.$gig['id'].'">'.date("d M Y H:i", strtotime($gig['datetime'])).' - '.$saf[0]['name'].'</a></li>';
        }
        echo '</ol>';
    }
    else {
        echo "<p>You don't have any gigs... yet</p>";
    }
}
?>
</section>
