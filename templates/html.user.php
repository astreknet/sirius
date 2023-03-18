<?php
deleteOneDayOldNonRegisteredUsers($pdo);
(!isset($_POST['email']) || !(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || getUserByMail($_POST['email'], $pdo) ?: addUser(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL), $pdo));
foreach (getUsers($pdo) as $u){
    $user[] = new User($u['email'], $pdo);
}


?>
<section id="users">
    <h3>Users</h3>
    <form action="" method="POST">
        <input type="text" id="email" name="email" required maxlength="45" placeholder="email" autocomplete="email">
        <input type="submit" class="button" value="add user" >
    </form>
                    
<?php

foreach ($user as $s){
    echo '<div class="userlevel'.$s->userlevel.'">';
    echo (!is_null($s->fname) && !is_null($s->lname) ? $s->fname.' '.$s->lname : $s->email);
    echo '</div>';
} 
?>
</section>
