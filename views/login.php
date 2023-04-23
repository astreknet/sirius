<section id="login">
<?php
if (isset($_GET['user_lock'])){
    if (isset($_POST['username']) && ($me = new User(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL), $pdo)) && ($me->userlevel)){
        $activation = bin2hex(random_bytes(16));
        $url = 'https://'.$_SERVER['HTTP_HOST'].'?account&username='.$me->email.'&activation='.$activation;
	    #$headers = array('From' => 'hugo@astrek.net', 'Reply-To' => 'sirius@astrek.net');
        updateTableItemWhere('user', 'activation', $activation, 'email', $me->email, $pdo);
        mail($_POST['username'], 'sirius recover', $url);
        getout();
    }
    echo '
        <h3>restart pasword</h3>
        <form id="restart_password" method="POST">
            <input type="email" id="username" name="username" required maxlength="45" placeholder="mail" '.value('username').' autocomplete="username"><br>
            <input class="button" type="submit" value="restart password">
            <div class="button"><a href="index.php">log in</a></div>
        </form>
    ';


}
else{
    echo '
        <h3>log in</h3>
        <form id="login" method="POST">
            <input type="email" id="username" name="username" required maxlength="45" placeholder="mail" '.value('username').' autocomplete="username"><br>
            <input type="password" id="lpassword" name="lpassword" required maxlength="45" placeholder="password" autocomplete="current-password"><br>
            <input class="button" type="submit" value="log in">
            <div class="button"><a href="?user_lock">forgot pass</a></div>
        </form>
    ';  
}
?>
</section>
