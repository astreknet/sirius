<section id="safaris">
    
<?php
if (isset($_GET['safaris'], $_GET['id'])) {
    if (isset($_POST['name'], $_POST['length']) && $me->userlevel > 1) { 
        $active = (isset($_POST['active']) ? 1 : 0);
        updateTableItemWhere('safari', 'name', $_POST['name'], 'id', $_GET['id'], $pdo);
        updateTableItemWhere('safari', 'length', $_POST['length'], 'id', $_GET['id'], $pdo);
        updateTableItemWhere('safari', 'active', $active, 'id', $_GET['id'], $pdo);
        header( "refresh:0;url=?safaris" );
    }
    $safari = selectAllFromBy('safari', 'id', $_GET['id'], $pdo);
    echo '    
    <h3>update '.$safari['name'].'</h3>
    <form action="" method="POST">
        <input type="text" id="name" name="name" required maxlength="60" placeholder="safari name" value="'.$safari['name'].'"><br>
        <select id="length" name="length" required>
            <option value="" selected disabled hidden>length:</option>';
            for ($i=60; $i<=300; $i=$i+30) {
                $selected = ($safari['length'] == $i ? 'selected' : '');
                echo '<option value="'.$i.'" '.$selected.'>'.($i/60).'h</option>';
            }
    echo '
        </select><br>';
    $check = ($safari['active'] ? 'checked' : '');        
    echo '
        active: <input type="checkbox" id="active" name="active" '.$check.'><br>
        <input type="submit" value="update safari">
    </form>
    '; 
    }
else {
    if (isset($_POST['name'], $_POST['length']) && !(selectAllFromBy('safari', 'name', $_POST['name'], $pdo)) && $me->userlevel > 1) {
        add('safari', 'name', $_POST['name'], $pdo);
        updateTableItemWhere('safari', 'length', $_POST['length'], 'name', $_POST['name'], $pdo);
    }
    foreach (selectAllfrom('safari', $pdo) as $s){
        $safari[] = new Safari($s['id'], $s['name'], $s['length'], $s['weekday'], $s['description'], $s['time'], $s['active']);
    }
    echo '
    <h3>Safaris</h3>
    <form method="POST">
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
    
    <ul>';
    foreach ($safari as $s){
        echo '<li class="safari'.$s->active.'"><a href="?safaris&id='.$s->id.'">'.$s->name.'</a></li>';
    } 
    echo '
    </ul>';
}
?>
</section>
