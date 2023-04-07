<section id="navbar">
<?php
$menu = array('exit');
if (!isset($_SESSION['register']) || !$_SESSION['register']) {
    $menu =  array('reports', 'safaris', 'users', 'trips',  strtolower($me->fname), 'exit');
    $menu = ($me->userlevel > 1 ? $menu : array_slice($menu, 3));
}

foreach($menu as $m) {
    echo '<a href="./?'.str_replace(' ', '_', $m).'"><div>'.$m.'</div></a>';
}
?>
</section>
