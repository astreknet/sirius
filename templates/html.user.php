<?php
foreach (getUsers($pdo) as $u){
    $user[] = new User($u['email'], $pdo);
}
?>
<section id="my_trips">
    <h3>Users</h3>
    <table>
<?php
foreach ($user as $s){
    echo '<tr><td>'.$s->fname.'</td><td>'.$s->lname.'<td>'.$s->tel.'</td></tr>';
} 
?>
    </table>
</section>
