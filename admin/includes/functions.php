<?php
//audit log function
function logEntry($action,$admin_id,$con)
{
    $key='F3229A0B371ED2D9441B830D21A390C3';
    $date=date('Y-m-d H:i:s');
    $browser=get_browser_name($_SERVER['HTTP_USER_AGENT']);
    $sql="INSERT INTO `audit_log`(`admin_id`, `action`,`browser`,`date_created`) VALUES ($admin_id,AES_ENCRYPT('$action',UNHEX('$key')),AES_ENCRYPT('$browser',UNHEX('$key')),AES_ENCRYPT('$date',UNHEX('$key')))";
    $con->query($sql);
}
//browser used function
function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera';
    elseif (strpos($t, 'edg'      )                           ) return 'Edge';
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome';
    elseif (strpos($t, 'safari'    )                           ) return 'Safari';
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox';
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unknown';
}

function canDeleteAdmins($role)
{
    if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){
        if($role !=0) {
            return true;
        }
    }
    return  false;
}
function canUpdateAdmins($role)
{
    if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){
      return  true;
    }
    return  false;
}

function canManageQuestion($role,$id)
{

    if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){
        return true;
    }
    else if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'])
    {
           if($id == $_SESSION['uid']) {
               return true;
           }
    }
    return  false;
}

function toggleSlash($value, $action){
	($action == 'add') ? $search = "'": $search = "\'";
	($action == 'add') ? $replace = "\'": $replace = "'";
    
	// Add or remove slash to avoid MySQL query break
	return str_replace($search, $replace, htmlspecialchars(trim($value)));
}

?>
