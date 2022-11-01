<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'accessmgt.php');
require_once(ROOT_DIR.'../includes/db.php');

$userId = isset($_GET['userId'])?$_GET['userId']:0;
$result = System::getUser($userId);

if ($result != null){
    $data['status'] = 'ok';
    $data['result'] = $result;
    
} else{
    $data['status'] = 'err';
    $data['result'] = '';
}
echo json_encode($data);

?>