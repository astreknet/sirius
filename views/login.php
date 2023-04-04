<section id="login">
    <h3>log in</h3>
    <form id="login" method="POST">
        <input type="email" id="username" name="username" required maxlength="45" placeholder="mail" <?php value('username'); ?> autocomplete="username"><br>
        <input type="password" id="lpassword" name="lpassword" required maxlength="45" placeholder="password" autocomplete="current-password"><br>
        <input class="button" type="submit" value="log in">
    </form>
</section>
