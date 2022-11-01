<?php

//use LDAP\Result;

require_once(ROOT_DIR.'includes/db.php');

Class Asset
{
  public static function getAsset($departmentId){
    $db = new db();
    $queryString = "SELECT asset.AssetId, asset.AssignToUserId, asset.Category, asset.Description, asset.Name, asset.OwnerDepartmentId, asset.Status, asset.Tag,
              user.FirstName, user.LastName 
            from asset
            left join user
              on user.UserId = asset.AssignToUserId
            where asset.OwnerDepartmentId = ?";
     $result = $db->query($queryString, $departmentId)->fetchAll();
    return $result;
  }
}

?>