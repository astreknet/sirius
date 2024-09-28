<?php
(isset($me) ?: $me = new User($_SESSION['usermail'], $pdo));
(empty($me->fname) ?: $_SESSION['fname'] = $me->fname);
(empty($me->lname) ?: $_SESSION['lname'] = $me->lname);
(empty($me->tel) ?: $_SESSION['tel'] = $me->tel);

if (
    isset($_POST['fname'], $_POST['lname'], $_POST['tel'], $_POST['new'], $_POST['password']) && 
    !empty($fname = trim($_POST['fname'])) && 
    !empty($lname = trim($_POST['lname'])) &&
    !empty($tel =  filter_var(trim($_POST['tel']), FILTER_SANITIZE_NUMBER_INT)) && 
    !empty($password = hash('sha256', $_POST['new'])) && ($_POST['new'] === $_POST['password'])
    )
        $me->updateMyself($password, $fname, $lname, $tel, $pdo);
?>

<section id="register">
    <h3 id="my-account">My Account</h3>
    <form action method="POST">
        <input type="text" name="fname" required maxlength="18" placeholder="first name" value="<?php echo value('fname'); ?>" autocomplete="first-name"><br>
        <input type="text" name="lname" required maxlength="18" placeholder="last name" value="<?php echo value('lname'); ?>" autocomplete="last-name"><br>
        <input type="tel" name="tel" required maxlength="18" placeholder="tel" value="<?php echo value('tel'); ?>" pattern="[+][0-9].{5,}" title="phone with country code ex: +1234567890" oninvalid="setCustomValidity('phone with country code ex: +1234567890')" onchange="try{setCustomValidity('')}catch(e){}" autocomplete="tel"><br>

        <input type="password" id="new" name="new" required maxlength="45" minlength="8" placeholder="new password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password.pattern = this.value;" autocomplete="new-password"><br>
        <input type="password" id="password" name="password" required maxlength="45" minlength="8" placeholder="repeat new password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same password as above' : '');" autocomplete="new-password"><br>
        
        <input type="submit" class="button" value="update">
    </form>
</section>
