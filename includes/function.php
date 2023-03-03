<?php
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
} 

function value($post){
    if(isset($_POST[$post])){
        echo 'value="'.$_POST[$post].'"';
    }
    else{
        if(isset($_SESSION[$post])){
            echo 'value="'.$_SESSION[$post].'"';
        }
    }
}

function formatdate($date) {
    $myunixdate = strtotime($date);
    if (date("Y-m-d") == date("Y-m-d", $myunixdate))
        return "today ".date("G:i", $myunixdate);
    else
        return date("D M j G:i", $myunixdate);
}

?>
