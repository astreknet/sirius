<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8" >
    <meta name="description" content="astrek aurora forecast, a fast, light, and responsive northern lights forecast" >
    <meta name="Keywords" content="aurora, aurora forecast, lapland, northern lights, revontulet, guide, finland" >
    <meta name="Author" content="hugo@astrek.net" />
    <link rel="shortcut icon" href="./img/favicon.ico" />
    <link rel="stylesheet" href="./sirius.css">
    <title id="title">sirius</title>
</head>
<body>
<header>
    <h1>sirius<h1/>
    <h2>lapland safaris north</h2>

<?php
    if (isset($_SESSION['validated']) && ($_SESSION['validated'])) {
        (isset($me) ?: $me = new User($_SESSION['usermail'], $pdo));
        echo '<ul>
                <li><a href="./">[trips]</a></li>';
        if (isset($me) && $me->userlevel > 1) { 
            echo '
                <li><a href="./?menu=users">[users]</a></li>
                <li><a href="./?menu=safaris">[safaris]</a></li>';
        }
        echo '  <li><a href="./?menu=account">['.strtolower($me->fname).']</a></li>
                <li><a href="./?out=1">[exit]</a></li>
            </ul>';
    }
    else {
        echo '
            <form id="login" action method="POST">
                <input type="email" id="username" name="username" required maxlength="45" placeholder="username"'.value('username').' autocomplete="username">
                <input type="password" id="lpassword" name="lpassword" required maxlength="45" placeholder="password" autocomplete="current-password">
                <input class="button" type="submit" value="log in">
            </form>';
    }
?>
</header>
