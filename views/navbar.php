<section id="navbar">
<?php
    if (isset($_SESSION['validated']) && ($_SESSION['validated'])) {
        (isset($me) ?: $me = new User($_SESSION['usermail'], $pdo));
        echo '<ul>
                <li><a href="./">[trips]</a></li>';
        if (isset($me) && $me->userlevel > 1) { 
            echo '
                <li><a href="./?users">[users]</a></li>
                <li><a href="./?safaris">[safaris]</a></li>';
        }
        echo '  <li><a href="./?account">['.strtolower($me->fname).']</a></li>
                <li><a href="./?out">[exit]</a></li>
            </ul>';
    }
    elseif (isset($_SESSION['registered'])) {
         echo ' <ul>
                    <li><a href="./?out">[exit]</a></li>
                </ul>';
    }
    else {
        echo '
            <form id="login"  method="POST">
                <input type="email" id="username" name="username" required maxlength="45" placeholder="username" value="'.value('username').'" autocomplete="username">
                <input type="password" id="lpassword" name="lpassword" required maxlength="45" placeholder="password" autocomplete="current-password">
                <input class="button" type="submit" value="log in">
            </form>';
    }
?>
</section>
