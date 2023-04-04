<section id="navbar">
<?php
$menu_all = array("a" => "trips", "e" => strtolower($me->fname));
$menu_admin = array("b" => "reports", "c" => "safaris", "d" => "users");
$menu_exit = array("f" => "exit");
$menu = (isset($_SESSION['register']) && $_SESSION['register'] ? $menu_exit : ($me->userlevel > 1 ? array_merge($menu_all, $menu_admin, $menu_exit) : array_merge($menu_all, $menu_exit)));
ksort($menu);

foreach($menu as $m) {
    echo '<div><a href="./?'.str_replace(' ', '_', $m).'">['.$m.']</a></div>';
}
?>
</section>
