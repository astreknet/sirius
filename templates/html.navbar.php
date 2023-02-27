<section>
    <ul>
        <li><a href="./">trips</a></li>
        <li><a href="?chpass=1">change password</a></li>
<?php   if($user->admin){ echo '<li><a href="?users=1">users</a></li>';} ?>
        <li><a href="?out=1">exit</a></li>
    </ul>
</section>
