<?php
$mytime = new DateTime('NOW');
$i =  $mytime->format('i');
while ($i < 60){
	$i = $i + 15;
}
$i = 75 - $i;
$diffMin = new DateInterval('PT'.$i.'M');
$diff15Min = new DateInterval('PT15M');
$mytime->add($diffMin);
?>
<div id="route_plan" class="block">
        <h3>safari plan</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <ul>
                        <li>travius id: <input class="form" type="text" maxlength="9" name="travius" value="<?php echo $_POST['travius']; ?>"></li>
                        <li>time:
                                <select name="time" class="form">
					<?php                                   
					for ($i=0; $i<9; $i++){
                                                $h = $mytime->format('H:i');
                                                $a = $mytime->format("Y-m-d H:i");
						$sel = '';
                                                if ($_POST['time'] == $a)
							$sel = 'selected';
                                                echo '<option value="'.$a.'" '.$sel.'>'.$h.'</option>';
                                                $mytime->add($diff15Min);
                                        } 
					?>
                                </select>

                        </li>
			<li>safari:
                                <select name="safari" class="form_wide">
                                        <option value="" selected disabled hidden>Choose a safari:</option>
                                        <?php
                                        $result = $conn->query('SELECT id, name FROM safari');
                                        while($row = $result->fetch_assoc()){
                                                $sel = '';
                                                if ($row['id'] == $_POST['safari'])
                                                        $sel = 'selected';
                                                echo '<option value="'.$row['id'].'" '.$sel.'>'.$row['name'].'</option>';
                                        }
                                        ?>
                                </select>
                        </li>
                        <li>route: <textarea class="form_wide" name="route"><?php echo $_POST['route']; ?></textarea></li>
                        <li><input type="submit" name="submit" value="send"></li>
                </ul>
        </form>
</div>
