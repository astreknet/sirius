<section>
    <ul>
        <li><a href="./">trips</a></li>
        <li><a href="./?menu=account">account</a></li>
<?php   if($me->admin){ echo '
        <li><a href="./?menu=users">users</a></li>
        <li><a href="./?menu=safaris">safaris</a></li>';
} ?>
        <li><a href="./?out=1">exit</a></li>
    </ul>
</section>
