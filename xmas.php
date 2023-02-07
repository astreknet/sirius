<?php
#;session_start();
echo $_SERVER['http_referer'];


if (!empty($_POST['feedback_subject']) && !empty($_POST['feedback_text'])){
	$subject = $text = "";
	$conn = new mysqli('127.0.0.1', 'user', 'password', 'database');
	$conn-> set_charset("utf8");
	$subject = htmlspecialchars(stripslashes(trim($_POST['feedback_subject'])));
	$text = htmlspecialchars(stripslashes(trim($_POST['feedback_text'])));
	$prepared = $conn-> prepare('INSERT INTO xmas_feedback (subject, text) VALUES (?, ?);');
	if ($prepared == false)
		die("Secured");
	
	$result= $prepared-> bind_param('ss', $subject, $text);
	if ($result == false)
		die("Secured");
	
	$result = $prepared-> execute();    
	if ($result == false)
		die("Secured");	
	
	$prepared-> close();
	$conn-> close();
      	header('location:'.'xmas_kiitos.php');
      	die();
}

elseif (!empty($_POST['signin_name']) && !empty($_POST['signin_surname']) && !empty($_POST['signin_phone'])) {
        	$name = $surname =  $phone = "";
	        $conn = new mysqli('127.0.0.1', 'user', 'password', 'database');
        	$conn-> set_charset("utf8");
        	$name = htmlspecialchars(stripslashes(trim($_POST['signin_name'])));
        	$surname = htmlspecialchars(stripslashes(trim($_POST['signin_surname'])));
        	$phone = htmlspecialchars(stripslashes(trim($_POST['signin_phone'])));

        	$prepared = $conn-> prepare('INSERT INTO xmas_guide (name, surname, phone) VALUES (?, ?, ?);');
        	if ($prepared == false)
                	die("Secured");

        	$result= $prepared-> bind_param('sss', $name, $surname, $phone);
        	if ($result == false)
                	die("Secured");

        	$result= $prepared-> execute();
        	if ($result == false)
                	die("Secured");

        	$prepared-> close();
        	$conn-> close();
                header('location:'.'xmas_kiitos.php');
        	die();
	}

else 
	echo 'steal some stuff and run!';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="Author" content="hugo sastre" />
        <link rel="shortcut icon" href="./art/favicon.ico" />
        <title>sirius - xmas</title>
<!-- CSS3 starts -->
<style type="text/css">
body {
	font: 100% Monospace; 
	background-image: url("./art/index.jpg");
	background-size:100% 100%;
	background-repeat: no-repeat;
}
h1, h2 {margin: 0;}
h3 {text-align: center;}
li {list-style: none;}
#head{
        width:102%;
        background-color:red;
        color:#fff;
	text-align: center;
	margin:-1.5%;
	top:0;
	position: -webkit-sticky; /* Safari */
    	position: sticky;
	opacity: 0.9;
        filter: alpha(opacity=90);
}
#main {
        color: red;
	width: 75%;
	margin:auto;
}
.block {
	width:45%;
	margin:3% auto;
        padding:1.2%;
        border: 0.09em dashed red;
        border-radius: 0.6em;
	background-color: #fff;
	opacity: 0.6;
    	filter: alpha(opacity=60);
	text-align: right;
}
.form { 
	width:30%;
	margin:0.3%;
	vertical-align: middle;
	}
.form_wide{ width:75%;}
#anonymous textarea{ 
	height: 15%;
	vertical-align: top;
	}
.form, .form_wide {
        border: 0.045em solid red;
        border-radius: 0.3em;
}
#login, #signin {
	margin-left:0;
	}
#anonymous {
	margin-right:0;
	}
</style>
<!-- CSS3 ends -->
</head>
<body>
<div id="head">
	<h1>sirius<h1/><h2>lapland safaris north xmas</h2>
</div>

<div id="main">
	<div id="anonymous" class="block">
		<h3 id="c3">anonymous feedback</h3>
        	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" accept-charset="utf-8">
        		<ul>
        			<li>subject: <input class="form_wide" type="text" maxlength="150" name="feedback_subject" value="<?php echo $_POST['feedback_subject']; ?>"></li>
        			<li>message: <textarea class="form_wide" name="feedback_text"><?php echo $_POST['feedback_text']; ?></textarea></li>
        			<li><input type="submit" name="submit" value="send"></li>
        		</ul>
		</form>
	</div>
	<div id="signin" class="block">
                <h3 id="c2">sign in</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        <ul>
                                <li>name: <input class="form" type="text" maxlength="15" name="signin_name" value="<?php echo $_POST['signin_name']; ?>"></li>
                                <li>surname: <input class="form" type="text" maxlength="15" name="signin_surname" value="<?php echo $_POST['signin_surname']; ?>"></li>
                                <li>phone: <input class="form" type="text" maxlength="15" name="signin_phone" value="<?php echo $_POST['signin_phone']; ?>"></li>
                                <li><input type="submit" name="submit" value="sign in"></li>
                        </ul>
                </form>
        </div>

</div>
</body>
</html>
