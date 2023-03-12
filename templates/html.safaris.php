<?php
foreach (getSafaris($pdo) as $s){
    $safari[] = new Safari($s['id'], $s['name'], $s['length'], $s['weekday'], $s['description'], $s['time'], $s['active']);
}
?>
<section id="my_trips">
    <h3>Safaris</h3>
    <ul>
<?php
foreach ($safari as $s){
    echo '<li>'.$s->name.'</li>';
} 
?>
    </ul>
</section>
