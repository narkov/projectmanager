<?php
/**
 * User model definition
 */
 
 /**
  * local IP subnet for admin validation
  */
 define('USER_LOCAL_SUBNET', '192.168.10.');
 /**
  * loopback address for admin validation
  */
 define('USER_LOCAL_HOST', '127.0.0.1');
 /**
  * hard coded password
  */
 define('USER_ADMIN_PASS', 'root');
 /**
  * phrase to hash for admin cookie storage
  *
  * never store clear text value in cookies when security is concerned
  * this md5 hash is trivial, but at least a passive deterant
  */
 define('USER_ADMIN_VAL', md5('administrator'));
 /**
  * cookie name
  *
  * try to avoid clashes with other GET or POST vars
  */
 define('USER_ADMIN_COOKIE', 'projects_admin');
 
/**
 * User class defintion
 */
class Users
{
  /**
   * determine if we should consider the user an application admin
   * @return  boolean
   */
  function IsAdmin() {
//    $s_user_ip = $_SERVER['REMOTE_ADDR'];
    $b_admin = false;
    if (  //USER_LOCAL_SUBNET == substr($s_user_ip,0,strlen(USER_LOCAL_SUBNET)) 
//      ||  USER_LOCAL_HOST == substr($s_user_ip,0,strlen(USER_LOCAL_HOST))
//      || 
        (array_key_exists(USER_ADMIN_COOKIE, $_COOKIE) 
        && USER_ADMIN_VAL == $_COOKIE[USER_ADMIN_COOKIE])
      ) {
      $b_admin = true;
    }
    return $b_admin;
  }

  /**
   * drop admin cookie
   */
  function RemoveAdmin() {
    SetCookie(USER_ADMIN_COOKIE, '');
    return true;
  }
  
  /**
   * set admin cookie
   */
  function SetAdmin($psPassCheck) {
    if (USER_ADMIN_PASS == $psPassCheck) {
      //Set Cookie for 30 days
      SetCookie(USER_ADMIN_COOKIE, USER_ADMIN_VAL);
//      SetCookie(USER_ADMIN_COOKIE
//          , USER_ADMIN_VAL
//          , time()+30*24*3600
//          , '/'
//          , $_SERVER['HTTP_HOST']
//          ); 
      return true;
    } else {
      require_once WACT_ROOT . 'validation/errorlist.inc.php';
      $errorList =& new ErrorList();
      $errorList->addErrorMessage('Invalid Administrator Password');
      return false;
    }
  }
  
  /**
   * enforce admin check, and redirect to default page if not admin
   */
  function ValidateAdmin() {
    if (!Users::IsAdmin()) {
      $errorList =& new ErrorList();
      $errorList->addErrorMessage('You have requested an action reserved for application administrators. Access denied.');
      exit;
    }
  }

  /**
   * test password for Admin rights
   */
  function DoLogin(&$data) {
    $s_password = $data->get('Password');
    
    if (Users::SetAdmin($s_password)) {
       return 'success';
    } else {
       return 'failure';
    }

    return 'failure';
  }

  /**
   * logout Admin rights
   */
  function DoLogout() {
    if (Users::RemoveAdmin()) {
       return 'success';
    } else {
       return 'failure';
    }

    return 'failure';
  }

 }

?>