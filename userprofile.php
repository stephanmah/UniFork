<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'includes/loader.php');
require_once(ROOT_DIR.'includes/partials/header.php');

?>


<div style="border: 1px solid lightgrey; padding: 10px; background-color:aliceblue;">
<h3 style="text-align:center;">My Profile</h3>
<form class="form-horizontal">
  <div class="form-group mb-3">
    <label class="control-label col-sm-2" for="username">User Name:</label>
    <div class="col-sm-4">
      <label class="form-control" id="username" ><?php echo $user->UserName ?></label>
    </div>
  </div>
  <div class="form-group mb-3">
    <label class="control-label col-sm-2" for="Name">Name:</label>
    <div class="col-sm-4">
      <label class="form-control" id="Name" ><?php echo $user->FirstName . ' ' . $user->LastName ?></label>
    </div>
  </div>
  <div class="form-group mb-3">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-4">
      <label class="form-control" id="email" ><?php echo $user->Email ?></label>
    </div>
  </div>
  <div class="form-group mb-3">
    <label class="control-label col-sm-2" for="role">Role:</label>
    <div class="col-sm-4">
      <label class="form-control" id="role" ><?php echo $user->RoleDesc ?></label>
    </div>
  </div>
  <div class="form-group mb-3">
    <label class="control-label col-sm-2" for="department">Department:</label>
    <div class="col-sm-4">
      <label class="form-control" id="department" ><?php echo $user->DepartmentDesc ?></label>
    </div>
  </div>
</form>
</div>


<?php require_once(ROOT_DIR.'includes/partials/footer.php'); ?>