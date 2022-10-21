<?php

//use LDAP\Result;

require_once(ROOT_DIR.'includes/db.php');

class Access{
  public $AccessId;
  public $Page;
  public $AppCode;
  public $AppDesc; //menu, 1st item
  public $AccessLevelCode;
  public $AccessLevelDesc; //menu, 2nd item
}

class User {
  // Properties
  public $UserId;
  public $UserName;
  public $PasswordHash; //level 10
  public $FirstName;
  public $LastName;
  public $Email;
  public $RoleId;
  public $RoleCode;
  public $RoleDesc;
  public $DepartmentId;
  public $DepartmentCode;
  public $DepartmentDesc;
  //private $Department; //department object
  //private $Role;	//role object
  public $AccessArray;  //Array of Access objects to build menu

  //function getDepartmentAndRole()
  //funciton getAccessManagement()

  public function __construct($_username) {
    $db = new db();
    $queryString = "SELECT UserId, UserName, PasswordHash, FirstName, LastName, Email, 
                          user.RoleId, role.RoleCode, role.RoleDesc,
                          user.DepartmentId, department.DepartmentCode, department.DepartmentDesc
                      FROM user
                      INNER JOIN role
                        on role.RoleId = user.RoleId
                      INNER JOIN department
                        on department.DepartmentId = user.DepartmentId
                            where UserName = ?";

      $_user = $db->query($queryString, $_username)->fetchArray();
      $this->UserId = $_user['UserId'];
       $this->UserName = $_user['UserName'];
       $this->PasswordHash = $_user['PasswordHash'];
       $this->FirstName = $_user['FirstName'];
       $this->LastName = $_user['LastName'];
       $this->Email = $_user['Email'];
       $this->RoleId = $_user['RoleId'];
       $this->RoleCode = $_user['RoleCode'];
       $this->RoleDesc = $_user['RoleDesc'];
       $this->DepartmentId = $_user['DepartmentId'];
       $this->DepartmentCode = $_user['DepartmentCode'];
       $this->DepartmentDesc= $_user['DepartmentDesc'];
       $db->close();

       $this->getAccess();

/*       $dbhost = 'localhost';
      $dbuser = 'gtri';
      $dbpass = 'gtri';
      $dbname = 'giwm';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      $sql = "SELECT UserName, Firstname, Lastname FROM user where UserName = 'jsmith'";
      if ($result = $conn->query($sql)) {
        $obj = $result->fetch_object();
        $this = $obj;
      } */

  }

  private function getAccess()
  {
    // $a = new Access();
    // $a->AccessId = 1;
    // $a->AppDesc = 'Asset Management';
    // $a->AccessLevelDesc = 'User';
    // $a->Page = "assetmanagement";
    // $a1 = new Access();
    // $a1->AccessId = 2;
    // $a1->AppDesc = 'Helpdesk Ticket';
    // $a1->AccessLevelDesc = 'User';
    // $a1->Page = "helpdeskticket";
    // $a2 = new Access();
    // $a2->AccessId = 3;
    // $a2->AppDesc = 'Asset Management';
    // $a2->AccessLevelDesc = 'Department';
    // $a2->Page = "assestmanagement";
    // $a3 = new Access();
    // $a3->AccessId = 4;
    // $a3->AppDesc = 'Helpdesk Ticket';
    // $a3->AccessLevelDesc = 'Admin';
    // $a3->Page = "helpdeskticket";
    // $a4 = new Access();
    // $a4->AccessId = 5;
    // $a4->AppDesc = 'System Admin';
    // $a4->AccessLevelDesc = 'Admin';
    // $a4->Page = "system";
    
    // $array = array();
    // $array[] =  $a;
    // $array[] =  $a1;
    // $array[] =  $a2;
    // $array[] =  $a3;
    // $array[] =  $a4;
    
    // $this->AccessArray = $array;

    $db = new db();
    $queryString = "select * from
              (select
                  access.AccessId
                  ,department.DepartmentCode
                  ,department.DepartmentDesc
                  ,role.RoleCode
                  ,role.RoleDesc
                  ,accesslevel.AccessLevelCode
                  ,accesslevel.AccessLevelDesc
                  ,accesslevel.Seq accesslevelSeq
                  ,app.AppCode
                  ,app.AppDesc
                  ,app.Seq appSeq
              from access
              inner join user
                on user.DepartmentId = ifnull(access.DepartmentId, user.DepartmentId)
                  and user.RoleId = ifnull(access.RoleId, user.RoleId)
                  and user.UserId = ?
              inner join department
                on department.DepartmentId = access.DepartmentId
              inner join role
                on role.RoleId = access.RoleId
              inner join accesslevel
                on accesslevel.AccessLevelId = access.AccessLevelId
              inner join app
                on app.AppId = access.AppId
              union 
              select
                  access.AccessId
                  ,department.DepartmentCode
                  ,department.DepartmentDesc
                  ,role.RoleCode
                  ,role.RoleDesc
                  ,accesslevel.AccessLevelCode
                  ,accesslevel.AccessLevelDesc
                  ,accesslevel.Seq accesslevelSeq
                  ,app.AppCode
                  ,app.AppDesc
                  ,app.Seq appSeq
              from access
              left join department
                on department.DepartmentId = access.DepartmentId
              inner join role
                on role.RoleId = access.RoleId
              inner join accesslevel
                on accesslevel.AccessLevelId = access.AccessLevelId
              inner join app
                on app.AppId = access.AppId
                where role.RoleCode = 'USER') a
              order by a.accesslevelSeq, a.appSeq";
    $_accesses = $db->query($queryString, $this->UserId)->fetchAll();
    $array = array();
    foreach($_accesses as $_access){
      $a = new Access();
      $a->AccessId = $_access['AccessId'];
      $a->AppCode = $_access['AppCode'];
      $a->AppDesc = $_access['AppDesc'];
      $a->AccessLevelCode = $_access['AccessLevelCode'];
      $a->AccessLevelDesc = $_access['AccessLevelDesc'];
      $a->Page = Setting::getPage($_access['AppCode'] . '_' . $_access['AccessLevelCode']);
      $array[] =  $a;
    }
    $this->AccessArray = $array;
  }
}

class Setting{
  public static function getPage($code){
    switch ($code){
      case "ASSET_MANAGEMENT_USER":
        return "assetsuser";
        break;
      case "ASSET_MANAGEMENT_DEPARTMENT":
        return "assetdepartment";
        break;
      case "ASSET_MANAGEMENT_ADMIN":
        return "assetadmin";
        break;
      case "TICKET_USER":
        return "ticketuser";
        break;
      case "TICKET_DEPARTMENT":
        return "ticketdepartment";
        break;
      case "TICKET_ADMIN":
        return "ticketadmin";
         break;  
      case "SYSTEM_ADMIN":
        return "system";
        break;
    }
  }
}



?>
