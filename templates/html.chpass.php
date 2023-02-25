<section id="change_pass">
    <h3>change password</h3>
    <form action="" method="POST">
        <ul>
            <li>new password:<input type="password" maxlength="30" name="newpass"></li>
            <li>repeat:<input type="password" maxlength="30" name="newpass1"></li>
            <li><input type="submit"></li>
        </ul>
    </form>
</section>
<?php
if (isset($_GET['exit']))
    wayout();
if ( isset($_POST['newpass']) && isset($_POST['newpass1']) && !empty($_POST['newpass']) && ($_POST['newpass'] == $_POST['newpass1']) ){

    $newpass = hash('sha256', htmlspecialchars(stripslashes(trim($_POST['newpass']))));
    $stmt = $conn->prepare('update user set password = ?  where mail = ?;');
    $stmt-> bind_param('ss', $newpass, $_SESSION['mail']);
    $stmt-> execute();
    $stmt-> close();
    $conn-> close();
    wayout();
}
?>
