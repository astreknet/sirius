<?php 
header( "refresh:3;url=index.php" ); 
echo '<div id="getout"></div>';
session_unset();
session_destroy();
die();

?>
