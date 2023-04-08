<?php
session_start();
if(isset($_SESSION['vcards'], $_SESSION['validated']) && $_SESSION['validated']) {
    $out = fopen('php://output', 'w');
    foreach ($_SESSION['vcards'] as $v){
            fwrite($out, "BEGIN:VCARD\n");
            fwrite($out, "VERSION:4.0\n");
            fwrite($out, "FN:".$v['fname']." ".$v['lname']."\n");
            fwrite($out, "N:".$v['lname'].";".$v['fname'].";;;\n");
            fwrite($out, "ORG:Lapland Safaris North\n");
            fwrite($out, "EMAIL:".$v['email']."\n");
            fwrite($out, "TEL;type=CELL:".$v['tel']."\n");
            fwrite($out, "END:VCARD\n");
    }
    unset($_SESSION['vcards']);
    fclose($out);
header( 'Content-Type: text/vcf' );
header( 'Content-Disposition: attachment;filename=guides.vcf');
}

if(isset($_SESSION['trip_report'], $_SESSION['validated']) && $_SESSION['validated']) {
    $filename = 'trip_report';
    $out = fopen('php://output', 'w');
    foreach ($_SESSION['trip_report'] as $t){
        fputcsv($out, $t);
    }
    fclose($out);
    unset($_SESSION['trip_report']);
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$filename);
}

if(isset($_SESSION['accident_report'], $_SESSION['validated']) && $_SESSION['validated']) {
    $filename = 'accident_report';
    $out = fopen('php://output', 'w');
    foreach ($_SESSION['accident_report'] as $t){
        fputcsv($out, $t);
    }
    fclose($out);
    unset($_SESSION['accident_report']);
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$filename);
}

if(isset($_SESSION['nearmiss_report'], $_SESSION['validated']) && $_SESSION['validated']) {
    $filename = 'nearmiss_report';
    $out = fopen('php://output', 'w');
    foreach ($_SESSION['nearmiss_report'] as $t){
        fputcsv($out, $t);
    }
    fclose($out);
    unset($_SESSION['nearmiss_report']);
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$filename);
}



?>
