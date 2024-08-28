<section id="incidents">
    <h3>Work Incidents</h3>
<?php
$me = new Guide($_SESSION['usermail'], $pdo);
$mytime = new DateTime('NOW');
$form_action = '?incidents';
$submit = "add incident";
$first_aid = $hospital_visit = '';
if (isset($_POST['datetime'], $_POST['place'], $_POST['description'])) {
    $incidentId = (isset($_GET['id']) ? $_GET['id'] : insertInto('incident', 'user_id', $me->id, $pdo));
    $incidentId = (is_array($incidentId) ? $incidentId['id'] : $incidentId);
    $inputs = array('datetime', 'place', 'description', 'injury');
    $checks = array('first_aid', 'hospital_visit');
    $me->updateTable('incident', $incidentId, $inputs, $checks, $pdo);
    header( "refresh:0;url=./?incidents" );
}

if (isset($_GET['id'])) {
    $iss = selectAllFromWhere('incident', 'id', $_GET['id'], $pdo);
    sessionForm($iss[0], TRUE);
    $form_action = '?incidents&id='.$_GET['id'];
    $submit = "update incident";
    $first_aid = ($_SESSION['first_aid'] ? 'checked' : '');
    $hospital_visit = ($_SESSION['hospital_visit'] ? 'checked' : '');
}

echo '  
    <form action="'.$form_action.'" method="POST">
        <input type="datetime-local" id="datetime" name="datetime" required max="'.$mytime->format("Y-m-d H:i").'" value="'.value('datetime').'">
        <input type="text" id="place" name="place" required maxlength="150" placeholder="place" value="'.value('place').'">
        <textarea id="description" name="description" required maxlength="270" placeholder="description">'.value('description').'</textarea><br>
        <textarea id="injury" name="injury" maxlength="270" placeholder="injury">'.value('injury').'</textarea><br>
        <input type="checkbox" id="first_aid" name="first_aid" '.$first_aid.'> first aid<br>
        <input type="checkbox" id="hospital_visit" name="hospital visit" '.$hospital_visit.'> hospital visit<br>
        <input type="submit" class="button" value="'.$submit.'"><br>
    </form> ';

if (isset($iss)){
    sessionForm($iss[0], FALSE);
}

if (count($me->incident) > 0) {
    echo '<ol>';
    foreach ($me->incident as $i){
        $incidentclass = (empty($i['injury']) ? 'class_orange' : 'class_red'); 
        echo '  <li class="'.$incidentclass.'"><a href="?incidents&id='.$i['id'].'">'.date("d-m-Y G:i", strtotime($i['datetime'])).' - '.$i['place'].' - '.$i['description'].'</a>';
        if (!empty($i['injury']))
            echo ' - '.$i['injury'];
        if ($i['first_aid'])
            echo ' -  first aid';
        if ($i['hospital_visit'])
            echo ' -  hospital visit';
        echo '</li>';
    }
    echo '</ol>';
}
else {
    echo "<p>You don't have any incidents. Yay!</p>";
    }

?>
</section>
