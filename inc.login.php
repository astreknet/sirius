<section id="guide_login">
    <h3>log in</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <ul>
            <li><label id="user">user:</label><input maxlength="45" name="mail"></li>
            <li><label id="password">password:</label><input maxlength="45" type="password" name="password"></li>
            <li><input class="button" type="submit" value="log in"></li>
        </ul>
    </form>
</section>
