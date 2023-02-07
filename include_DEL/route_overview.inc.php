<?php


?>
<div id="route_planed" class="block">
<h3>planed route</h3>
	<ul>
		<li>guide id: <?php echo $route_rev['guide_id']; ?></li>
		<li>safari: <?php echo $route_rev['safari_name']; ?></li>
		<li>travius: <?php echo $route_rev['travius']; ?></li>
		<li>date: <?php echo $route_rev['date']; ?></li>
		<li>route: <?php echo $route_rev['route']; ?></li>
	</ul>
</div>
<div id="route_overview" class="block">
<h3>route overview</h3>
	<p>
		If there wasn't any issues you can leave the blanks and just send it.
	</p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" accept-charset="utf-8">
                <ul>
                        <li>real route: <textarea class="form_wide" name="route_real"><?php echo $_POST['route_real']; ?></textarea></li>
                        <li>customers: <textarea class="form_wide" name="missed_customer"><?php echo $_POST['missed_customer']; ?></textarea></li>
                        <li>schedule: <textarea class="form_wide" name="schedule_issue"><?php echo $_POST['schedule_issue']; ?></textarea></li>
                        <li>gear: <textarea class="form_wide" name="gear_amount_issue"><?php echo $_POST['gear_amount_issue']; ?></textarea></li>
                        <li>near miss: <textarea class="form_wide" name="near_miss"><?php echo $_POST['near_miss']; ?></textarea></li>
                        <li>accident: <textarea class="form_wide" name="accident"><?php echo $_POST['accident']; ?></textarea></li>
                        <li><input type="submit" name="submit" value="send"></li>
                </ul>
        </form>

</div>
