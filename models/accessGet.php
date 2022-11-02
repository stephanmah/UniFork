<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'accessmgt.php');
require_once(ROOT_DIR.'../includes/db.php');

$accessId = isset($_GET['accessId'])?$_GET['accessId']:0;
$result = System::getAccess($accessId);

if ($result != null){
    $data['status'] = 'ok';
    $data['result'] = $result;
    
} else{
    $data['status'] = 'err';
    $data['result'] = '';
}

echo json_encode($data);

?>