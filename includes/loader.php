<?php

session_start();

# Imports and initializations
require_once(ROOT_DIR.'models/user.php');
require_once(ROOT_DIR.'models/accessmgt.php');
require_once(ROOT_DIR.'includes/functions.php');


# Check database
checkDatabaseInstallation();

# Check logged user
if (!isLoggedIn() && !preg_match('/login(.php)?/', currentPage())) {
  redirectTo(ROOT_DIR.'login.php');
}

$_SESSION['where_am_I'] = "";
?>
