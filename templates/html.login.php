<section id="login">
    <h3>log in</h3>
    <form id="login" action method="POST">
        <input type="email" id="email" name="email" required maxlength="45" placeholder="mail" <?php value('email'); ?> autocomplete="email"><br>
        <input type="password" id="password" name="password" required maxlength="45" placeholder="password" autocomplete="current-password"><br>
        <input class="button" type="submit"></li>
    </form>
</section>
