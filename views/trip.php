<?php
#$now = new DateTime('NOW');
#$time_min = $now->format('H:i');
#$diff4h = new DateInterval('PT4H');
#$now->add($diff4h);
#$time_max = $now->format('H:i');
$mytime = new DateTime('NOW');
$diffMin = new DateInterval('PT'.(60 - $mytime->format('i')).'M');
$diff15Min = new DateInterval('PT15M');
$diff30Min = new DateInterval('PT30M');
$mytime->add($diffMin);

if (isset($_POST['safari'], $_POST['time'], $_POST['route']) && $me->userlevel > 0) {
    $erp_link = (isset($_POST['erp_link']) ? $_POST['erp_link'] : NULL);
    addTrip($me->id, $_POST['safari'], $erp_link, $_POST['time'], $_POST['route'], $pdo);
}
#echo var_dump($_SESSION).'<br>';
#echo var_dump($me);
#echo ($trips = getTripsByUser($me->id, $pdo) ? "good" : "bad");   
#echo var_dump(getTripsByUser($me->id, $pdo)).'<br>';
//echo var_dump(getAccidentsByTripID(11, $pdo)).'<br>';
//echo var_dump($user->trip).'<br>';
?>
<section id="my_trips">
    <h3>My Trips</h3>
    <form action method="POST">
        <select id="safari" name="safari" required>
            <option value="" selected disabled hidden>Choose a safari</option>
<?php
            $row = getSafaris($pdo);
            foreach($row as $r){
                $sel = ((isset($_POST['safari']) && ($_POST['safari'] == $r['id'])) ? 'selected' : '');
                echo '<option value="'.$r['id'].'" '.$sel.'>'.$r['name'].'</option>';
            }
?>
        </select>
        <select name="time" required>
        <option value="" selected disabled hidden>Time</option>
<?php       for ($i = 0; $i < 9; $i++){
                $sel = ((isset($_POST['time']) && ($_POST['time'] == $mytime->format("Y-m-d H:i"))) ? 'selected' : '');
                echo '<option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
                $mytime->add($diff30Min);
            }
?>
        </select>
        <input type="url" id="erp_link" name="erp_link" maxlength="150" placeholder="https://erp_link" pattern="https://.*" value="<?php echo value('erp_link'); ?>">
        <input type="text" id="route" name="route" required maxlength="150" placeholder="route" value="<?php echo value('route'); ?>">
        <input type="submit" class="button" value="add trip">
    </form>
        
<?php
    if ($trips = getTripsByUser($me->id, $pdo)) {
        echo "<ul>";
        foreach ($trips as $trip){
            $safari = getSafariByID($trip['safari_id'], $pdo);
            echo "  <li>".$safari[0]["name"]."</li>";
        }
        echo "</ul>";
    }        
    else {
        echo "<p>You don't have any trip yet!</p>";
    }        
/*           
 *
        <input type="time" id="time" name="time" min="<?php echo $time_min; ?>" max="18:00" step="30min" required value="<?php echo value('time'); ?>">
        <select name="time">
<?php       for ($i = 0; $i < 9; $i++){
                $sel = ((isset($_POST['time']) && ($_POST['time'] == $mytime->format("Y-m-d H:i"))) ? 'selected' : '');
                echo '<option value="'.$mytime->format("Y-m-d H:i").'" '.$sel.'>'.$mytime->format('H:i').'</option>';
                $mytime->add($diff30Min);
            }
?>
    </select>


    <ul>
    for($i=0; $i<count($user->trip); $i++){
        //echo var_dump(getAccidentsByTripID($row['id'], $pdo));
        $accidents = (is_array($user->trip[$i]['accident']) ? count($user->trip[$i]['accident']) : 0);
        $near_misses = (is_array($user->trip[$i]['near_miss']) ? count($user->trip[$i]['near_miss']) : 0);
        echo '  <li>'.formatdate($user->trip[$i]['date']).' <a href="https://www.explores.fi/ERP_Offer/DepartureDetail.aspx?DepartureId='.$user->trip[$i]['erp_link'].'" target="_blank" >'.$safari[0]["name"].'</a><br>
                Accidents: '.$accidents.'
                Near Misses: '.$near_misses.'
                </li>';
    }
 */
?>
</section>





<?php
                            
                            
/*                            
//$sql = $conn->query('SELECT t.id, s.name as s_name, erp_link, date, route FROM trip t Left JOIN safari s on s.id = t.safari_id where user_id = '.$_SESSION['user_id'].' and done = false');
//$undone = $sql->fetch_array(MYSQLI_ASSOC);


if (isset($undone)) {
    if (isset($_POST['u_route']) && !empty($_POST['u_route'])){
        if (isset($_POST['u_remarks']) && !empty($_POST['u_remarks'])) {
            $u_remarks = trim($_POST['u_remarks']);
        }
        else {
            $u_remarks = null;
        }
        $u_route = trim($_POST['u_route']);
        $date = $_POST['time'].':00';
        $stmt = $conn->prepare('update trip set route = ?, remarks = ?, done = 1 where id = '.$undone['id']);
        $stmt-> bind_param('ss', $u_route, $u_remarks);
        $stmt-> execute();
        $stmt-> close();
        $conn-> close();
        wayout();
    }
    
        echo '  <section id="close_trip">
                    <h3>close your last trip</h3>
                    <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                    <ul>
                        <li>'.formatdate($undone['date']).'</li>
                        <li><a href="https://www.explores.fi/ERP_Offer/DepartureDetail.aspx?DepartureId='.$undone['erp_link'].'" target="_blank" >'.$undone['s_name'].'</a></li>
                        <li>route: <input type="text" name="u_route" maxlength="150" value="'.$undone['route'].'"></li>
                        <li>remarks: <textarea maxlength="300" name="u_remarks"></textarea></li>
                        <li><input type="submit" class="button" value="send"></li>
                    </ul>
                    </form>
                </section>';
}
else {
//    $result = $conn->query('SELECT t.id, s.name as s_name, erp_link, date, route, remarks, done FROM trip t Left JOIN safari s on s.id = t.safari_id where t.user_id = '.$_SESSION['user_id'].' order by id desc');
    while($row = $result-> fetch_array(MYSQLI_ASSOC)){
        $my_safaris[] = $row;
    }

    $mytime = new DateTime('NOW');
    $i =  $mytime->format('i');
    while ($i < 60){
        $i = $i + 15;
    }
    $i = 75 - $i;
    $diffMin = new DateInterval('PT'.$i.'M');
    $diff15Min = new DateInterval('PT15M');
    $mytime->add($diffMin);

    if (isset($_POST['safari']) && !empty($_POST['erp_link'])  && !empty($_POST['time']) && !empty($_POST['route'])){
        $erp_link = explode('=', trim($_POST['erp_link']));
        $route = trim($_POST['route']);
        $date = $_POST['time'].':00';
        $stmt = $conn->prepare("INSERT INTO trip (user_id, safari_id, erp_link, date, route) VALUES (?, ?, ?, ?, ?);");
        $stmt-> bind_param('iisss', $_SESSION['user_id'], $_POST['safari'], $erp_link[1], $date, $route);
        $stmt-> execute();
        $stmt-> close();
        $conn-> close();
        wayout();
    }
    
    if (isset($_POST['a_time']) && !empty($_POST['a_place']) && !empty($_POST['a_description']) && !empty($_POST['a_customer_erp_link']) && !empty($_POST['a_customer_name'])
        && !empty($_POST['a_customer_adress']) && !empty($_POST['a_customer_email'])){
        $date = $_POST['a_time'].':00';
        $place = trim($_POST['a_place']);
        $description = trim($_POST['a_description']);
        $erp_link = explode('=', trim($_POST['a_customer_erp_link']));
        $name = trim($_POST['a_customer_name']);
        $address = trim($_POST['a_customer_adress']);
        $email = trim($_POST['a_customer_email']);
        $sm_reg_n = trim($_POST['a_sm_reg_n']);
        $sm_model = trim($_POST['a_sm_model']);
        $total_euro = trim($_POST['a_total_euro']);
        $total_paid = trim($_POST['a_total_paid']);
        $injury = trim($_POST['a_injury']);
        $stmt = $conn->prepare("INSERT INTO accident (trip_id, datetime, place, description, customer_erp_link, customer_name, customer_address, customer_email, sm_reg_n, sm_model, waiver, total_euro, total_paid, injury, first_aid_by_staff, hospital_offer, hospital_visit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt-> bind_param('isssssssssiiisiii', $_GET['acc'], $date, $place, $description, $erp_link[1], $name, $address, $email, $sm_reg_n, $sm_model, $_POST['a_waiver'], $total_euro, $total_paid, $injury, $_POST['a_first_aid_by_staff'], $_POST['a_hospital_offer'], $_POST['a_hospital_visit']);
        $stmt-> execute();
        $stmt-> close();
        $conn-> close();
        wayout();
    }

    if (isset($_POST['n_time']) && !empty($_POST['n_place']) && !empty($_POST['n_description'])){
        $date = $_POST['n_time'].':00';
        $place = trim($_POST['n_place']);
        $description = trim($_POST['n_description']);
        $stmt = $conn->prepare("INSERT INTO near_miss (trip_id, datetime, place, description, guide_involved, customer_involved) VALUES (?, ?, ?, ?, ?, ?);");
        $stmt-> bind_param('isssii', $_GET['near'], $date, $place, $description, $_POST['customer_involved'], $_POST['guide_involved']);
        $stmt-> execute();
        $stmt-> close();
        $conn-> close();
        wayout();
    }



    if (isset($_GET['acc'])) {
        $sql = $conn->query('SELECT t.id, s.name as s_name, erp_link, date, route, remarks FROM trip t Left JOIN safari s on s.id = t.safari_id where t.id = '.$_GET['acc'].' and t.user_id = '.$_SESSION['user_id'].' and done = true');
        $add = $sql->fetch_array(MYSQLI_ASSOC);
        $issues = $conn->query('SELECT t.id, s.name as s_name, erp_link, date, route, remarks, done FROM trip t Left JOIN safari s on s.id = t.safari_id where t.user_id = '.$_SESSION['user_id'].' order by id desc'); 
    while($row = $issues-> fetch_array(MYSQLI_ASSOC)){
        $my_issues[] = $row;
    }
    $t = new DateTime($add['date']);
        echo '  <section id="accident" class="clearfix">
                    <h3>accident</h3>
                    <ul>
                        <li><a href="https://www.explores.fi/ERP_Offer/DepartureDetail.aspx?DepartureId='.$add['erp_link'].'" target="_blank" >'.$add['s_name'].'</a></li>
                        <li>'.formatdate($add['date']).'</li>
                        <li>'.$add['route'].'</li>';
                        if (!is_null($add['remarks']))
                            echo '<li>remarks: '.$add['remarks'].'</li>';
        echo '      
                    </ul>
                    <div>
                    <form action="'.$_SERVER['PHP_SELF'].'?acc='.$_GET['acc'].'" method="POST">
                    <ul>
                        <fieldset>
                        <legend>when-where-what:</legend>
                            <li>time: <select name="a_time">';
                    for ($i=0; $i<21; $i++){
                        $h = $t->format('H:i');
                        $a = $t->format("Y-m-d H:i");
                        $sel = '';
                        if ($_POST['time'] == $a)
                            $sel = 'selected';
                            echo '<option value="'.$a.'" '.$sel.'>'.$h.'</option>';
                        $t->add($diff15Min);
                    }

        echo '              </select></li>
                            <li>place: <input type="text" name="a_place" maxlength="150"></li>
                            <li>description: <textarea maxlength="300" name="a_description"></textarea></li>
                            </fieldset>
                            <fieldset>
                            <legend>customer:</legend>
                            <li>erp link: <input type="text" name="a_customer_erp_link" maxlength="150"></li>
                            <li>name: <input type="text" name="a_customer_name" maxlength="150"></li>
                            <li>address: <input type="text" name="a_customer_adress" maxlength="150"></li>
                            <li>email: <input type="text" name="a_customer_email" maxlength="150"></li>
                            </fieldset>
                            <fieldset>
                            <legend>injury:</legend>
                            <li>description: <textarea maxlength="300" name="a_injury"></textarea></li>
                            <li>first aid by staff: yes<input type="radio" class="button" name="a_first_aid_by_staff" value="1"> no<input type="radio" class="button" name="a_first_aid_by_staff" value="0" checked></li>
                            <li>hospital offered: yes<input type="radio" class="button" name="a_hospital_offer" value="1"> no<input type="radio" class="button" name="a_hospital_offer" value="0" checked></li>
                            <li>hospital visit: yes<input type="radio" class="button" name="a_hospital_visit" value="1"> no<input type="radio" class="button" name="a_hospital_visit" value="0"    checked></li>
                            </fieldset>
                            <fieldset>
                            <legend>damage:</legend>
                            <li>snowmobile reg n: <input type="text" name="a_sm_reg_n" maxlength="27"></li>
                            <li>snowmobile model: <input type="text" name="a_sm_model" maxlength="30"></li>
                            <li>waiver: yes<input type="radio" class="button" name="a_waiver" value="1"> no<input type="radio" class="button" name="a_waiver" value="0" checked></li>
                            <li>total euro: <input type="text" class="button" name="a_total_euro" maxlength="8">€</li>
                            <li>total paid: <input type="text" class="button" name="a_total_paid" maxlength="8">€</li>
                            </fieldset>
                            <li><input type="submit" class="button" value="send"></li>
                        </ul>
                        </form>
                        </div>';
    }
    elseif (isset($_GET['near'])) {
        $sql = $conn->query('SELECT t.id, s.name as s_name, erp_link, date, route, remarks FROM trip t Left JOIN safari s on s.id = t.safari_id where t.id = '.$_GET['near'].' and t.user_id = '.           $_SESSION['user_id'].' and done = true');
        $add = $sql->fetch_array(MYSQLI_ASSOC);
        $issues = $conn->query('SELECT t.id, s.name as s_name, erp_link, date, route, remarks, done FROM trip t Left JOIN safari s on s.id = t.safari_id where t.user_id = '.$_SESSION['user_id'].' order   by id desc');
    while($row = $issues-> fetch_array(MYSQLI_ASSOC)){
        $my_issues[] = $row;
    }
    $t = new DateTime($add['date']);
        echo '
                <section id="near_miss">
                    <h3>near miss</h3>
                    <ul>
                        <li><a href="https://www.explores.fi/ERP_Offer/DepartureDetail.aspx?DepartureId='.$add['erp_link'].'" target="_blank" >'.$add['s_name'].'</a></li>
                        <li>'.formatdate($add['date']).'</li>
                        <li>'.$add['route'].'</li>';
                        if (!is_null($add['remarks']))
                            echo '<li>remarks: '.$add['remarks'].'</li>';
        echo '      </ul>
                    <form action="'.$_SERVER['PHP_SELF'].'?near='.$_GET['near'].'" method="POST">
                        <ul>
                            <li>time: <select name="n_time">';
                    for ($i=0; $i<21; $i++){
                        $h = $t->format('H:i');
                        $a = $t->format("Y-m-d H:i");
                        $sel = '';
                        if ($_POST['time'] == $a)
                            $sel = 'selected';
                            echo '<option value="'.$a.'" '.$sel.'>'.$h.'</option>';
                        $t->add($diff15Min);
                    }
        
        echo '              </select></li>
                            <li>place: <input type="text" name="n_place" maxlength="150"></li>
                            <li>description: <textarea maxlength="300" name="n_description"></textarea></li>
                            <li>customer: <input type="checkbox" class="button" id="customer_involved" name="customer_involved" value="1"></li>
                            <li>guide: <input type="checkbox" class="button" id="guide_involved" name="guide_involved" value="1"></li>
                            <li><input type="submit" class="button" value="send"></li>
                        </ul>
                    </form>
                </section>';

    }
    
    else {
    echo '  <section id="my_trips">
                <h3>my trips</h3>
                <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                <fieldset>
                <legend>add a trip</legend>
                <ul>
                    <li><label for="erp_link">erp link:</label> <input type="text" name="erp_link" value="';
                    if (isset($_POST['erp_link']))
                        echo $_POST['erp_link'];                                                                                           
            echo '  "></li>
                    <li><label for="time">time:</label> <select name="time">';
                    for ($i=0; $i<18; $i++){
                        $h = $mytime->format('H:i');
                        $a = $mytime->format("Y-m-d H:i");
                        $sel = '';
                        if ($_POST['time'] == $a)
                            $sel = 'selected';
                            echo '<option value="'.$a.'" '.$sel.'>'.$h.'</option>';
                        $mytime->add($diff15Min);
                    }   
            echo '  </select></li>
                    <li><label for="safari">safari:</label> <select name="safari">
                        <option value="" selected disabled hidden>Choose a safari:</option>';
                    $result = $conn->query('SELECT id, name FROM safari');
                    while($row = $result->fetch_assoc()){
                        $sel = '';
                        if ($row['id'] == $_POST['safari'])
                        $sel = 'selected';
                    echo '<option value="'.$row['id'].'" '.$sel.'>'.$row['name'].'</option>';
                    }
            echo '  </select></li>
                    <li><label for="route">route:</label> <input type="text" name="route" maxlength="150" value="';
                    if (isset($_POST['route']))
                        echo $_POST['route']; 
            echo '  "></li>
                    <li><input type="submit" class="button" value="send"></li>
                </ul>
                </fieldset>
                </form>';

        if (isset($my_safaris)) {
            echo '  <table>';
            foreach($my_safaris as $row){
                echo '  <tr><td td class="left_align">'.formatdate($row['date']).'</td><td><a href="https://www.explores.fi/ERP_Offer/DepartureDetail.aspx?DepartureId='.$row['erp_link'].'" target="_blank" >'.$row['s_name'].'</a></td><td>[<a href="'.$_SERVER['PHP_SELF'].'?near='.$row['id'].'">near miss</a>][<a href="'.$_SERVER['PHP_SELF'].'?acc='.$row['id'].'">accident</a>]</td></tr>';
            }
        echo '          </table>
                </section>';
        }
    }
    }
 */
?>
