<section id="change_pass">
    <h3>change password</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <ul>
            <li>new password:<input type="password" maxlength="30" name="newpass"></li>
            <li>repeat:<input type="password" maxlength="30" name="newpass1"></li>
            <li><input type="submit"></li>
        </ul>
    </form>
</section>
