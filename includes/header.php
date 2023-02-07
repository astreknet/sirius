<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Author" content="hugo@astrek.net" />
    <link rel="shortcut icon" href="./favicon.png" />
    <link rel="stylesheet" href="./sirius.css">
    <title id="title">sirius</title>
</head>
<body>
<header>
<?php
    if (isset($_SESSION['active']) && ($_SESSION['active'] == 1)) {
    echo'   <div id="guide_id">
                <p>Hola '.$_SESSION['name'].' '.$_SESSION['surname'].' | <a href="'.$_SERVER['PHP_SELF'].'?exit=1">exit</a></p>
            </div>';
    }
?>
        <h1>sirius<h1/><h2>lapland safaris north</h2>
</header>
