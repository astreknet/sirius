<?php
deleteOneDayOldNonRegisteredUsers($pdo);
(!isset($_POST['email']) || !(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ?: addUser(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL), $pdo));
foreach (getUsers($pdo) as $u){
    $user[] = new User($u['email'], $pdo);
}

?>
<section id="users">
    <h3>Users</h3>
    <form action="" method="POST">
        <fieldset>
            <legend>add a user</legend>
                <input type="text" id="email" name="email" required maxlength="45" placeholder="email" autocomplete="email"><br>
                <input type="submit">
        </fieldset>
    </form>
                    
<?php

foreach ($user as $s){
    echo '<div class="userlevel'.$s->userlevel.'">';
    echo (!is_null($s->fname) && !is_null($s->lname) ? $s->fname.' '.$s->lname : $s->email);
    echo '</div>';
} 
?>
</section>
