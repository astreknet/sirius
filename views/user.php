<?php
deleteOneDayOldNonRegisteredUsers($pdo);
(!isset($_POST['email']) || !(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || getUserByMail($_POST['email'], $pdo) || $me->userlevel < 2 ?: addUser(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL), $pdo));
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
                    
    <ul>
<?php
foreach ($user as $s){
    echo '<li class="userlevel'.$s->userlevel.'"><a href="?users&userid='.$s->id.'">';
    echo (!is_null($s->fname) && !is_null($s->lname) ? $s->fname.' '.$s->lname : $s->email);
    echo '</a></li>';
} 
?>
    </ul>
</section>
