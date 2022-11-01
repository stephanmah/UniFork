<?php

session_start();

# Imports and initializations
require_once(ROOT_DIR.'models/asset.php');
require_once(ROOT_DIR.'models/user.php');
require_once(ROOT_DIR.'models/accessmgt.php');
require_once(ROOT_DIR.'includes/functions.php');
require_once(ROOT_DIR.'includes/db.php');



# Check database
# checkDatabaseInstallation();

# Check logged user
if (!isLoggedIn() && !preg_match('/login(.php)?/', currentPage())) {
  redirectTo(ROOT_DIR.'login.php');
}

?>
