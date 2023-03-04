<?php

if (
    isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
    isset($_POST['name']) && !empty(trim($_POST['name'])) &&
    isset($_POST['surname']) && !empty(trim($_POST['surname'])) &&
    isset($_POST['phone']) && !empty(trim($_POST['phone'])) &&
    isset($_POST['new']) && !empty($_POST['new']) &&
    ($_POST['new'] === $_POST['password'])
    ){
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); 
        $password = hash('sha256', $_POST['password']);
        $name = htmlspecialchars(trim($_POST['name']));
        $surname = htmlspecialchars(trim($_POST['surname']));
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        updateUser($_SESSION['id'], $email, $password, $name, $surname, $phone, $pdo);
        header( "Location: index.php?out" ); 
}

?>
<section id="register">
    <h3>My Data</h3>
    <form action method="POST">
        <input type="text" id="given-name" name="name" required maxlength="18" placeholder="name" <?php value('name'); ?> autocomplete="given-name"><br>
        <input type="text" id="last-name" name="surname" required maxlength="18" placeholder="surname" <?php value('surname'); ?> autocomplete="family-name"><br>
        <input type="email" id="e-email" name="email" required maxlength="45" placeholder="email" <?php value('email'); ?> autocomplete="email"><br>
        <input type="tel" id="tel" name="phone" required maxlength="18" placeholder="phone" <?php value('phone'); ?> pattern="[+][0-9].{5,}" title="phone with country code ex: +1234567890" oninvalid="setCustomValidity('phone with country code ex: +1234567890')" onchange="try{setCustomValidity('')}catch(e){}" autocomplete="tel"><br>
        
        <input type="password" id="new" name="new" required maxlength="45" minlength="8" placeholder="new password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password.pattern = this.value;" autocomplete="new-password"><br>
        <input type="password" id="password" name="password" required maxlength="45" minlength="8" placeholder="repeat new password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same password as above' : '');" autocomplete="new-password"><br>
        
<!--
        <input type="password" id="new-password" name="new" required maxlength="45" minlength="8" placeholder="new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="new-password"><br>
        <input type="password" id="new-password" name="password" required maxlength="45" minlength="8" placeholder="repeat new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="new-password"><br> -->
        <input type="submit">
    </form>
</section>
