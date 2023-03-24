<section id="users">
<?php
if (isset($_GET['users'], $_GET['id']) && $me->userlevel > 1 && $_GET['id'] != 1 ) {
    $user = selectAllFromWhere('user', 'id', $_GET['id'], $pdo); 
    $userlevels = array('inactive', 'guide', 'admin');
    if (is_null($user[0]['password']) && is_null($user[0]['fname']) && is_null($user[0]['lname']) && is_null($user[0]['tel'])) {
        echo "
            <h3>".$user[0]['email']."</h3>
            <p>If this user doesn't complete the registration soon will be deleted!</p>
            <div class='back'><a href='?users'>back</a></div>
        "; 
    }
    else {
        if (isset($_POST['userlevel']) && $me->userlevel > 1) {
            updateTableItemWhere('user', 'userlevel', $_POST['userlevel'], 'id', $_GET['id'], $pdo);
            header( "refresh:0;url=?users" );
        }
        echo '
            <h3 class="userlevel'.$user[0]['userlevel'].'">'.$user[0]['fname'].' '.$user[0]['lname'].'</h3>
            <p><address>
                <a href="tel:'.$user[0]['tel'].'">'.$user[0]['tel'].'</a><br>
                <a href="mailto:'.$user[0]['email'].'">'.$user[0]['email'].'</a>
            </address></p>
            <form action="" method="POST">
                <select id="userlevel" name="userlevel" required>
                    <option value="" selected disabled hidden>userlevel:</option>';
                for ($i = 0; $i < count($userlevels); $i++) {
                    $sel = ($user[0]['userlevel'] == $i ? 'selected' : '');
                    $dis = ($me->id == $user['id'] && $me->userlevel != $i ? 'disabled' : '');
                    echo '<option value="'.$i.'" '.$sel.' '.$dis.'>'.$userlevels[$i].'</option>';
                    }
        echo '  
                </select><br>
                <input type="submit" value="update user">
            </form>
        ';
    }
}
else {
    deleteOneDayOldNonRegisteredUsers($pdo);
    (!isset($_POST['email']) || !(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || selectAllFromWhere('user', 'email', $_POST['email'], $pdo) || $me->userlevel < 2 ?: insertInto('user', 'email', filter_var($_POST['email'], FILTER_VALIDATE_EMAIL), $pdo));
    foreach (selectAllFrom('user', $pdo) as $u){
        $user[] = new User($u['email'], $pdo);
    }
    echo '
        <h3>Users</h3>
        <form action="" method="POST">
            <input type="text" id="email" name="email" required maxlength="45" placeholder="email" autocomplete="email">
            <input type="submit" class="button" value="add user" >
        </form>
                    
        <ul>';
    
    foreach ($user as $s){
        echo '<li class="userlevel'.$s->userlevel.'"><a href="?users&id='.$s->id.'">';
        echo (!is_null($s->fname) && !is_null($s->lname) ? $s->fname.' '.$s->lname : $s->email);
        echo '</a></li>';
    } 

    echo '
        </ul>';
}
?>
</section>
