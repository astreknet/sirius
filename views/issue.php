<section id="issues">
    <h3>Work Issues</h3>
<?php
$mytime = new DateTime('NOW');
$issues = selectAllFromWhere('issue', 'user_id', $me->id, $pdo);
$form_action = '?issues';
$submit = "add issue";
if (isset($_POST['datetime'], $_POST['place'], $_POST['description'])) {
    $issueId = insertInto('issue', 'user_id', $me->id, $pdo);
    updateTableItemWhere('issue', 'datetime', $_POST['datetime'], 'id', $issueId['id'], $pdo);
    updateTableItemWhere('issue', 'place', $_POST['place'], 'id', $issueId['id'], $pdo);
    updateTableItemWhere('issue', 'description', $_POST['description'], 'id', $issueId['id'], $pdo);
    (!isset($_POST['injury']) || empty($_POST['injury']) ?: updateTableItemWhere('issue', 'injury', $_POST['injury'], 'id', $issueId['id'], $pdo));
    (!isset($_POST['first_aid']) ?: updateTableItemWhere('issue', 'first_aid', 1, 'id', $issueId['id'], $pdo));
    (!isset($_POST['hospital_visit']) ?: updateTableItemWhere('issue', 'hospital_visit', 1, 'id', $issueId['id'], $pdo));
    header( "refresh:0;url=./?issues" );
}

if (isset($_GET['id'])) {
        $iss = selectAllFromWhere('issue', 'id', $_GET['id'], $pdo);
        foreach ($iss[0] as $k => $v) {
            $_SESSION[$k] = $v;
        }
        $form_action = '?issues&id='.$_GET['id'];
        $submit = "update issue";
        $first_aid = ($_SESSION['first_aid'] ? 'checked' : '');
        $hospital_visit = ($_SESSION['hospital_visit'] ? 'checked' : '');
    }

echo '  
        <form action="'.$form_action.'" method="POST">
            <input type="datetime-local" id="datetime" name="datetime" required max="'.$mytime->format("Y-m-d H:i").'">
            <input type="text" id="place" name="place" required maxlength="150" placeholder="place">
            <textarea id="description" name="description" required maxlength="270" placeholder="description"></textarea><br>
            <textarea id="injury" name="injury" maxlength="270" placeholder="injury"></textarea><br>
            <input type="checkbox" id="first_aid" name="first_aid"> first aid<br>
            <input type="checkbox" id="hospital_visit" name="hospital visit"> hospital visit<br>
            <input type="submit" class="button" value="'.$submit.'"><br>
        </form> ';
if (count($issues) > 0) {
    echo '<ol>';
    foreach ($issues as $i){
        $issueclass = (empty($i['injury']) ? 'class_orange' : 'class_red'); 
        echo '  <li class="'.$issueclass.'"><a href="?issues&id='.$i['id'].'">'.date("d-m-Y G:i", strtotime($i['datetime'])).' - '.$i['place'].' - '.$i['description'].'</a>';
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
    echo "<p>You don't have any issues. Yay!</p>";
    }

?>
</section>
