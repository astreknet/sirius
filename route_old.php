<?php
session_start();
include('./include/header.inc.php');
?>
<div id="guide_id" class="block">
        <p>Hola <?php echo $_SESSION['guide_name']; ?>  <?php echo $_SESSION['guide_surname']; ?> | <a href="./index.php">exit</a></p>
</div>
<?php
$zero = 0;
$conn = new mysqli('127.0.0.1', 'lsn', 'L1pl1nd', 'lsn');
$conn-> set_charset("utf8");
$stmt = $conn->prepare('SELECT id FROM route WHERE guide_id = ? AND finished = ?');
$stmt-> bind_param("ii", $_SESSION['guide_id'], $zero);
$stmt-> execute();
$stmt-> store_result();
$stmt-> bind_result($unfinished_id);
$stmt-> fetch();


if (!is_null($unfinished_id)){


$stmt = $conn->prepare('SELECT guide_id, safari_id, travius, date, route  FROM route WHERE id = ?');
$stmt-> bind_param("i", $unfinished_id);
$stmt-> execute();
$stmt-> store_result();
$stmt-> bind_result($route_rev['guide_id'], $route_rev['safari_id'], $route_rev['travius'], $route_rev['date'], $route_rev['route']);
$stmt-> fetch();
$stmt = $conn->prepare('SELECT name FROM safari WHERE id = ?');
$stmt-> bind_param("i", $route_rev['safari_id']);
$stmt-> execute();
$stmt-> store_result();
$stmt-> bind_result($route_rev['safari_name']);
$stmt-> fetch();

if (isset($_POST['route_real']) && isset($_POST['missed_customer']) && isset($_POST['schedule_issue']) && isset($_POST['gear_amount_issue']) && isset($_POST['near_miss']) && isset($_POST['accident'])) {
	
	$route_real = htmlspecialchars(stripslashes(trim($_POST['route_real'])));
	$missed_customer = htmlspecialchars(stripslashes(trim($_POST['missed_customer'])));
	$schedule_issue = htmlspecialchars(stripslashes(trim($_POST['schedule_issue'])));
	$gear_amount_issue = htmlspecialchars(stripslashes(trim($_POST['gear_amount_issue'])));
	$near_miss = htmlspecialchars(stripslashes(trim($_POST['near_miss'])));
	$accident = htmlspecialchars(stripslashes(trim($_POST['accident'])));
	$finished = 1;

	$stmt = $conn->prepare('UPDATE route SET route_real = ?, missed_customer = ?, schedule_issue = ?, gear_amount_issue = ?, near_miss = ?, accident = ?, finished = ? WHERE id = ?;');
        $stmt-> bind_param('ssssssii', $route_real, $missed_customer, $schedule_issue, $gear_amount_issue, $near_miss, $accident, $finished, $unfinished_id);
        $stmt-> execute();
        $stmt-> close();
        $conn-> close();
        header('location:'.'kiitos.php');
        die();


}

include('./include/route_overview.inc.php');
}
else {
if (!is_null($_POST['safari']) && !empty($_POST['travius']) && is_numeric($_POST['travius']) && (strlen($_POST['travius']) == 6)&& !empty($_POST['time']) && !empty($_POST['route'])){
	$travius = htmlspecialchars(stripslashes(trim($_POST['travius'])));
	$route = htmlspecialchars(stripslashes(trim($_POST['route'])));
	$date = $_POST['time'].':00';
	$stmt = $conn->prepare('INSERT INTO route (guide_id, safari_id, travius, date, route) VALUES (?, ?, ?, ?, ?);');
	$stmt-> bind_param('iisss', $_SESSION['guide_id'], $_POST['safari'], $travius, $date, $route);
	$stmt-> execute();
	$stmt-> close();
        $conn-> close();
	header('location:'.'kiitos.php');
        die();
	}
include('./include/route_plan.inc.php');
}
include('./include/footer.inc.php');
?>
