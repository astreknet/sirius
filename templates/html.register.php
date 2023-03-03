<?php
/*
    if (
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
        !empty(sanitize($_POST['firstName'])) &&
        !empty(sanitize($_POST['lastName'])) &&
        !empty(sanitize($_POST['lastName']), FILTER_SANITIZE_NUMBER_INT) &&
    
        ){
}
 */

echo var_dump($_POST).'<br>';
echo filter_var("+1 2 3", FILTER_SANITIZE_NUMBER_INT).'<br>';

if ( isset($_POST['newpass']) && isset($_POST['newpass1']) && !empty($_POST['newpass']) && ($_POST['newpass'] == $_POST['newpass1']) ){

    $newpass = hash('sha256', htmlspecialchars(stripslashes(trim($_POST['newpass']))));
    $stmt = $conn->prepare('update user set password = ?  where email = ?;');
    $stmt-> bind_param('ss', $newpass, $_SESSION['email']);
    $stmt-> execute();
    $stmt-> close();
    $conn-> close();
    wayout();
}
?>
<section id="register">
    <h3>My Data</h3>
    <form action method="POST">
    <input type="text" id="name" name="name" required maxlength="18" placeholder="name" <?php value('name'); ?> autocomplete="given-name"><br>
        <input type="text" id="surname" name="surname" required maxlength="18" placeholder="surname" <?php value('surname'); ?> autocomplete="family-name"><br>
        <input type="email" id="email" name="email" required maxlength="45" placeholder="email" <?php value('email'); ?> autocomplete="email"><br>
        <input type="tel" id="phone" name="phone" required maxlength="18" placeholder="phone" <?php value('phone'); ?> autocomplete="tel"><br>
        <input type="password" id="new" name="new" required maxlength="45" placeholder="new password" autocomplete="new-password"><br>
        <input type="password" id="password" name="password" required maxlength="45" placeholder="repeat new password" autocomplete="new-password"><br>
        <input type="submit">
    </form>
</section>
