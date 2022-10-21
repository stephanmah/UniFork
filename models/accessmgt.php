<?php

//use LDAP\Result;

require_once(ROOT_DIR.'includes/db.php');

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
    $queryString = "SELECT AccessLevelId, AccessLevelCode, AccessLevelDesc, Seq from accesslevel ordr by Seq";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }

  public static function getApp(){
    $db = new db();
    $queryString = "SELECT AppId, AppCode, AppDesc from app order by AppCode";
     $result = $db->query($queryString)->fetchAll();
    return $result;
  }
}



?>