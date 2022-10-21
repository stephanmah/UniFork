<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'includes/loader.php');
require_once(ROOT_DIR.'includes/partials/header.php');
?>

<?php
if (isLoggedIn()) {
    redirectTo(ROOT_DIR.'.');
}
else {
  if (isset($_POST['login'])){
    checkSessionToken($_REQUEST['tokenfield'], $_SESSION['sessiontoken'], '/login.php');
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    var_dump($username);
    var_dump($password);
    logIn($username,$password);
  }
  else {
    newSessionToken();
    showLoginForm();
  }
}
?>


<?php
  function showLoginForm(){ ?>
    <div class="row">
      <div caption style="width:33%; margin:auto;">
        <h3 style="text-align: center;">Login</h3>
        <form class="form" action="login.php" method="post">
          <div class="mb-3">
            <label class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="User Name" autocomplete="off" autofocus="true">
          </div>
          <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" autocomplete="off">
          </div>
          <input type="hidden" name="tokenfield" value="<?php echo $_SESSION['sessiontoken']; ?>">
          <button type="submit" role="button" name="login" class="btn btn-primary btn-block">Log In</button>
          <div>Username: jsmith - password: jsmith</div>
        </form>
      </div>
    </div>
  <?php }
?>

<?php require_once(ROOT_DIR.'includes/partials/footer.php'); ?>
