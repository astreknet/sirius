<?php
function value($post){
    if(isset($_POST[$post])){
        return $_POST[$post];
    }
    else{
        if(isset($_SESSION[$post])){
            return $_SESSION[$post];
        }
    }
}

function getout(){
    header( "refresh:0;url=index.php" ); 
    session_unset();
    session_destroy();
    die();
}

function formatdate($date) {
    $myunixdate = strtotime($date);
    if (date("Y-m-d") == date("Y-m-d", $myunixdate))
        return "today ".date("G:i", $myunixdate);
    else
        return date("D M j G:i", $myunixdate);
}
?>
