<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'includes/loader.php');
require_once(ROOT_DIR.'includes/partials/header.php');


?>
<div style="text-align:center"><h1>Welcome <?php echo $user->FirstName ?>!</h1></div>
<div style="text-align:center">
        <a><img alt="" src="<?php echo ROOT_DIR.'assets/img/string.png' ?>"></a>
</div>


<?php require_once(ROOT_DIR.'includes/partials/footer.php'); ?>
