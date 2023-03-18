<?php
(!isset($_POST['name'], $_POST['length'], $_POST['description']) ?: addUser(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL), $pdo));
foreach (getSafaris($pdo) as $s){
    $safari[] = new Safari($s['id'], $s['name'], $s['length'], $s['weekday'], $s['description'], $s['time'], $s['active']);
}
?>
<section id="my_trips">
    <h3>Safaris</h3>
    <form action="" method="POST">
        <input type="text" id="name" name="name" required maxlength="60" placeholder="safari name">
        <select id="length" name="length" required>
            <option value="" selected disabled hidden>length:</option>
            <option value="60">1h</option>
            <option value="90">1h 30m</option>
            <option value="120">2h</option>
            <option value="150">2h 30m</option>
            <option value="180">3h</option>
            <option value="210">3h 30m</option>
            <option value="240">4h</option>
            <option value="270">4h 30m</option>
            <option value="300">5h</option>
        </select>
        <input type="submit" class="button" value="add safari">
    </form>
    
    <ul>
<?php
foreach ($safari as $s){
    echo '<li>'.$s->name.'</li>';
} 
?>
    </ul>
</section>
