<section>
    <ul>
        <li>trips</li>
        <li>change password</li>
<?php   if($user->admin){ echo '<li>users</li>';} ?>
        <li><a href="?out=1">exit</a></li>
    </ul>
</section>
