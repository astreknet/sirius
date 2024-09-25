<?php
if (
    isset($_POST['description']) && !empty(trim($_POST['description']))
    ){
        $description = htmlspecialchars(trim($_POST['description']));
        insertInto('feedback', 'description', $description, $pdo);
    }
?>

<section id="feedback">
    <h3 id="my-feedback">Anonymous Feedback</h3>
    <form action method="POST">
        <textarea id="description" name="description" maxlength="270" placeholder="feedback"></textarea><br>

        <input type="submit" class="button" value="send">
    </form>
</section>
