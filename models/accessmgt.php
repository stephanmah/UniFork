<?php


class AccessManagement
{
  public $AccessId;
  public $DepartmentId;
  public $DepartmentCode;
  public $DepartmentDesc;
  public $RoleId;
  public $RoleCode;
  public $RoleDesc;
  public $AccessLevelId;
  public $AccessLevelCode;
  public $AccessLevelDesc;
  public $AppId;
  public $AppCode;
  public $AppDesc;

  public static function GetAllAccess($departmentCode, $roleCode){
    $db = new db();
    $queryString = "CALL AccessManagementGet(?, ?)";
     $result = $db->query($queryString, $departmentCode, $roleCode)->fetchAll();
    return $result;
  }

  public static function getAllUsers(){
    $db = new db();
    $queryString = "CALL AccessManagementGetUsers()";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }
}

Class System
{
  public static function getDepartment(){
    $db = new db();
    $queryString = "SELECT DepartmentId, DepartmentCode, DepartmentDesc from department order by DepartmentCode";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }

  public static function getRole(){
    $db = new db();
    $queryString = "SELECT RoleId, RoleCode, RoleDesc from Role order by RoleCode";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }

  public static function getAccessLevel(){
    $db = new db();
    $queryString = "SELECT AccessLevelId, AccessLevelCode, AccessLevelDesc, Seq from accesslevel order by Seq";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }

  public static function getApp(){
    $db = new db();
    $queryString = "SELECT AppId, AppCode, AppDesc from app order by AppCode";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }

  public static function getAccess($accessId){
    $db = new db();
    $queryString = "SELECT * from access where AccessId = ?";
    if($_user = $db->query($queryString, $accessId)->fetchAll()){
      return $_user;
    } else{
      return null;
    }
  }

  public static function getUser($userId)
  {
    $db = new db();
    $queryString = "SELECT * from user where UserId = ?";
    if($_user = $db->query($queryString, $userId)->fetchArray()){
      return $_user;
    } else{
      return null;
    }
  }
}

?>