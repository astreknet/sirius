<?php
foreach (getUsers($pdo) as $u){
    $user[] = new User($u['email'], $pdo);
}
?>
<section id="my_trips">
    <h3>Users</h3>
    <ul>
<?php
foreach ($user as $s){
    echo '<li>'.$s->name.' '.$s->surname.'</li>';
} 
?>
    </ul>
</section>
