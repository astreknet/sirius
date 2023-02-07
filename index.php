<?php
session_start();
include('./include/header.inc.php');

if (!empty($_POST['feedback_subject']) && !empty($_POST['feedback_text'])){
	$conn = new mysqli('127.0.0.1', 'user', 'password', 'db');
	$conn-> set_charset("utf8");
	$subject = htmlspecialchars(stripslashes(trim($_POST['feedback_subject'])));
	$text = htmlspecialchars(stripslashes(trim($_POST['feedback_text'])));
	$stmt = $conn-> prepare('INSERT INTO feedback (subject, text) VALUES (?, ?);');
	$stmt-> bind_param('ss', $subject, $text);
	$stmt-> execute();    
	$stmt-> close();
	$conn-> close();
      	header('location:'.'kiitos.php');
      	die();
}

elseif (!empty($_POST['signin_name']) && !empty($_POST['signin_surname']) && !empty($_POST['signin_phone']) && !empty($_POST['signin_pass_0']) && !empty($_POST['signin_pass_1']) && ($_POST['signin_pass_0'] === $_POST['signin_pass_1'])) {
	        $conn = new mysqli('127.0.0.1', 'user', 'password', 'db');
        	$conn-> set_charset("utf8");
        	$name = htmlspecialchars(stripslashes(trim($_POST['signin_name'])));
        	$surname = htmlspecialchars(stripslashes(trim($_POST['signin_surname'])));
        	$phone = htmlspecialchars(stripslashes(trim($_POST['signin_phone'])));
        	$password = hash('sha256', htmlspecialchars(stripslashes(trim($_POST['signin_pass_0']))));
        	$stmt = $conn->prepare('INSERT INTO guide (name, surname, phone, password) VALUES (?, ?, ?, ?);');
        	$stmt-> bind_param('ssss', $name, $surname, $phone, $password);
        	$stmt-> execute();
        	$stmt-> close();
        	$conn-> close();
                header('location:'.'kiitos.php');
        	die();
}

elseif (!empty($_POST['login_id']) && !empty($_POST['login_password'])){
	    $conn = new mysqli('127.0.0.1', 'user', 'password', 'db');
        $conn-> set_charset("utf8");
        $_SESSION['guide_id'] = htmlspecialchars(stripslashes(trim($_POST['login_id'])));
        $password = hash('sha256', htmlspecialchars(stripslashes(trim($_POST['login_password']))));
        $stmt = $conn->prepare('SELECT name, surname, password, admin FROM guide WHERE id = ?');
        $stmt-> bind_param("i", $_SESSION['guide_id']);
        $stmt-> execute();
	    $stmt-> store_result();
	    $stmt-> bind_result($_SESSION['guide_name'], $_SESSION['guide_surname'], $guide_password, $_SESSION['guide_admin']);
	    $stmt-> fetch();
        $stmt-> close();
        $conn->close();
	if ($guide_password == $password)
		header('location:'.'route.php');	
}

include('./include/lobby.inc.php');
include('./include/footer.inc.php');
?>
