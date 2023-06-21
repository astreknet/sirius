<?php
function value($post){
    if (isset($_POST[$post]))
        return $_POST[$post];
    else
        if (isset($_SESSION[$post]))
            return $_SESSION[$post];
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

function sessionForm($val, $bool) {
    foreach ($val as $k => $v) {
        if ($bool == TRUE) {
            $_SESSION[$k] = $v;
        }
        else {
            unset($_SESSION[$k]);
        }
    }
}


function prepareReport($name, $sql, $csvheader, $pdo) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION[$name] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION[$name][] = $row;
    }
    array_unshift($_SESSION[$name], $csvheader);
    header( "refresh:0;url=views/downloads.php" );
}

function downloadCsv($name){
    $out = fopen('php://output', 'w');
    foreach ($_SESSION[$name] as $t){
        fputcsv($out, $t);
    }
    fclose($out);
    unset($_SESSION[$name]);
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$name.'-'.date('YmdHis').'.csv' );
}
?>
