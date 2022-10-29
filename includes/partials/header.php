<?php
  function activeTab($requestUri){
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
    if ($current_file_name == $requestUri) { echo 'class="active"'; }
  }
  // echo currentUser();
  function setVariable(){
    
  }
  $userName = "";
  if(isLoggedIn() == 1) { 
    $user = new User(currentUser());
    $userName = $user->FirstName . " " . $user->LastName . " - " . $user->RoleDesc . " - " . $user->DepartmentDesc;
  }
?>

<html lang="en">
<head>
  <title>UniFork</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="<?php echo ROOT_DIR.'assets/img/favicon.ico'?>" type="image/x-icon" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo ROOT_DIR.'assets/css/bootstrap.min.css'?>">
  <link rel="stylesheet" href="<?php echo ROOT_DIR.'assets/css/font-awesome.css'?>">
  <link rel="stylesheet" href="<?php echo ROOT_DIR.'assets/css/bootstrap-theme.min.css'?>">
  <!-- Bootstrap JS -->
  <script src="<?php echo ROOT_DIR.'assets/js/functions.js'?>"></script>
  <script src="<?php echo ROOT_DIR.'assets/js/jquery.min.js'?>"></script>
  <script src="<?php echo ROOT_DIR.'assets/js/bootstrap.js'?>" crossorigin="anonymous"></script>
  <!-- Local CSS -->
  <link rel="stylesheet" href="<?php echo ROOT_DIR.'assets/css/style.css'?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ROOT_DIR.'assets/fonts/fontawesome/css/all.min.css'?>">

  <!-- Local JS -->
  <script>
    $('.dropdown-toggle').dropdown()
  </script>

<script>
  $(function() {
    $(".menu").click(function(){
      //alert($(this).data("menu"));
    })
  });

</script>

  <style type=”text/css”>
  </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
        <a><img alt="" class="navbar-brand" src="<?php echo ROOT_DIR.'assets/img/unifork.png' ?>" style="padding-top:0px; padding-bottom:0px;"></a>
    </div>
    <?php if(isLoggedIn() == 1) { ?> 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
      
            <?php foreach($user->AccessArray as $access){ ?>
              <li <?php activeTab("$access->Page")?> >
                <a class="nav-item" aria-current="page" data-menu="<?php echo $access->AppDesc . ' - ' . $access->AccessLevelDesc ?>" 
                href="<?php echo ROOT_DIR.'' . $access->Page . '';?>"><?php echo $access->AppDesc;?>-<?php  echo $access->AccessLevelDesc;?></a>
              </li>
            <?php } ?>
      
      </ul>
      <div>
        <ul class="navbar-nav ms-auto">
          <li>
            <a  class="nav-link" href="<?php echo ROOT_DIR.'userprofile';?>" >
              <i class="fa-solid fa-user" style="font-size:30px;color:gray;vertical-align:bottom;"></i>
              <i><b><span style="font-size:16px;color:gray;"> <?php echo "  " . $userName ?></span></b></i>
            </a>
          </li>
          <li>
            <a class="nav-link" href="<?php echo ROOT_DIR.'logout';?>" >
              <i class="fa fa-sign-out" aria-hidden="true" style="font-size:30px;color:gray;"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <?php } ?>
  </div>
</nav>


<div class="container" style="border: 1px solid lightgrey; padding: 10px; background-color:aliceblue;">


