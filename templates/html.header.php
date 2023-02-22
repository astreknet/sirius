<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8" >
    <meta name="description" content="astrek aurora forecast, a fast, light, and responsive northern lights forecast" >
    <meta name="Keywords" content="aurora, aurora forecast, lapland, northern lights, revontulet, inlapland, guide, finland" >
    <meta name="Author" content="hugo@astrek.net" />
    <link rel="shortcut icon" href="./img/favicon.ico" />
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
