<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'includes/loader.php');
require_once(ROOT_DIR.'includes/partials/header.php');

echo '<h1>';
echo $_SESSION['where_am_I'];
echo '</h1>';
?>




<?php require_once(ROOT_DIR.'includes/partials/footer.php'); ?>
