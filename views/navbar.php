<section id="navbar">
<?php
$menu_exit = array('?exit' => '⍈');
if (!isset($_SESSION['register']) || !$_SESSION['register']) {
    $menu_admin =  array(
        '?reports' => 'reports', 
        '?safaris' => 'safaris', 
        '?users' => 'users', 
        './' => 'trips', 
        '?issues' => 'issues', 
        '?account' => strtolower($me->fname)
    );
    $menu = ($me->userlevel > 1 ? array_merge($menu_admin, $menu_exit) : array_merge(array_slice($menu_admin, 3), $menu_exit));
}

foreach($menu as $k => $v) {
    echo '<a href="./'.$k.'"><div>'.$v.'</div></a>';
}
?>
</section>
