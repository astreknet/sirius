<div id="login" class="block_left">
       	<h3 id="c1">log in</h3>
       	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
               	<ul>
                       	<li>username: <input class="form" type="password" maxlength="3" name="login_id"></li>
			<li>password: <input class="form" type="password" maxlength="30" name="login_password"></li>
                      	<li><input type="submit" name="submit" value="login"></li>
                	</ul>
        	</form>
</div>
<div id="anonymous" class="block_right">
	<h3 id="c3">anonymous feedback</h3>
       	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" accept-charset="utf-8">
       		<ul>
       			<li>subject: <input class="form_wide" type="text" maxlength="150" name="feedback_subject" value="<?php echo $_POST['feedback_subject']; ?>"></li>
       			<li>message: <textarea class="form_wide" name="feedback_text"><?php echo $_POST['feedback_text']; ?></textarea></li>
       			<li><input type="submit" name="submit" value="send"></li>
       		</ul>
	</form>
</div>
<div id="signin" class="block_left">
	<h3 id="c2">sign in</h3>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
		<ul>
			<li>name: <input class="form" type="text" maxlength="15" name="signin_name" value="<?php echo $_POST['signin_name']; ?>"></li>
			<li>surname: <input class="form" type="text" maxlength="15" name="signin_surname" value="<?php echo $_POST['signin_surname']; ?>"></li>
			<li>phone: <input class="form" type="text" maxlength="15" name="signin_phone" value="<?php echo $_POST['signin_phone']; ?>"></li>
			<li>password: <input class="form" type="password" maxlength="30" name="signin_pass_0"></li>
			<li>confirm password: <input class="form" type="password" maxlength="30" name="signin_pass_1"></li>
			<li><input type="submit" name="submit" value="sign in"></li>
		</ul>
	</form>
</div>
