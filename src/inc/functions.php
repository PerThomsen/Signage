<?php
/* Dette script er kopieret fra senne side:
   http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
   https://github.com/peredurabefrog/phpSecureLogin
   http://cryptojs.altervista.org/hash/doc/doc_hash_pajs.html
*/

include_once 'psl-config.php';

function getAddress() {
  $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
  $filenamepattern = basename(__FILE__);
  $filePath        = $_SERVER['REQUEST_URI'];
  $posOfParm       = strpos($filePath,"?")-1;
  if ($posOfParm > 1) {
    $filePath      = substr($filePath,1,$posOfParm);
    $filePath        = str_replace($filenamepattern,'',$filePath);
    return $protocol.'://'.$_SERVER['HTTP_HOST'].'/'.$filePath;
  } else {
    $filePath        = str_replace($filenamepattern,'',$filePath);    
    return $protocol.'://'.$_SERVER['HTTP_HOST'].$filePath;
  }
}

function getPath() {
  $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
  $filePath        = $_SERVER['REQUEST_URI'];
  $posOfParm       = strrpos($filePath,"/")-1;
  $filePath        = substr($filePath,1,$posOfParm);
  return $protocol.'://'.$_SERVER['HTTP_HOST'].'/'.$filePath;
}

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
//    session_set_cookie_params($cookieParams["lifetime"],
//    session_set_cookie_params(86400,
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(86400,
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}
function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt, languageId, changeLanguage, admin, editMenu, editArtikel   
        FROM 1_members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt, $sprogId, $chLang, $admin, $editMenu, $editArt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    $_SESSION['languageId'] = $sprogId;
                    $_SESSION['chLang']     = $chLang;
                    $_SESSION['admin']      = $admin;
                    $_SESSION['editMenu']   = $editMenu;
                    $_SESSION['editArt']   = $editArt;
                    
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO 1_login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM 1_login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM 1_members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function getMenu($type, $admShow, $menuEdit) {
  global $mysqli, $filNavn, $sprogId;
  $hideSearch = 0;
  
if ($type != '') {
      $sql0 = "SELECT `hide_search` FROM `pt_menu` WHERE `url` = '$filNavn' LIMIT 1";
      if ($res=mysqli_query($mysqli,$sql0)) { 
        while ($row = mysqli_fetch_row($res)) {
            $hideSearch = $row[0];
        }
      }
      $menuTxt  = '';  
      $sql = "SELECT * FROM `pt_menu` WHERE `enable` = 1 AND menu_type = '$type' AND rights_admin <= $admShow AND rights_menu <= $menuEdit ORDER BY menu_order";
//"SELECT * FROM `pt_menu` WHERE `enable` = 1 AND menu_type = 'main' AND rights_admin <= $admShow AND (rights_menu = 0 AND rights_menu <> $menuEdit) ORDER BY menu_order";

      //echo $sql."<br />";
      if (($res=mysqli_query($mysqli,$sql)) && ($type !='none')) { 
        $menuTxt .= '<nav class="navbar navbar-custom" role="navigation">';
        //$menuTxt .= '  <div class="collapse navbar-collapse" id="navbarSupportedContent">';
        $menuTxt .= '    <ul class="nav navbar-nav">';
         
        while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {      
          if ( ($filNavn == $row['url']) ) {
            $activTxt = ' active';
          } else {
            $activTxt = '';
          }
          if ($row['not_on_default'] == 1 AND $sprogId == 0) {    
            // Do nothing
          } else {
              $menuTxt .= '          ';
              $menuTxt .= '<li class="nav-item'.$activTxt.'">';
              if (($row['search'] == 1) && ($hideSearch == 0) ) {
                $menuTxt .='<a data-toggle="modal" data-target="#searchModal" href="#">'.$row['icon'].'</a>';
              }elseif (($row['pre_name']!="") && ($row['search'] != 1)) {
                $menuTxt .= '<a class="nav-link" title="'.$row['alt_text'].'" href="'.$row['url'].'">'.$row['pre_name'].'&nbsp;'.$row['name'].'</a>';
              } elseif ($row['search'] != 1) {
                $menuTxt .= '<a class="nav-link" title="'.$row['alt_text'].'" href="'.$row['url'].'">'.$row['icon'].'&nbsp;'.$row['name'].'</a>';
              }
              $menuTxt .= '</li>';
              $menuTxt .= "\r";
          }
        }
        $menuTxt .= '    </ul>';
        //$menuTxt .= '  </div>';
        $menuTxt .= '</nav>';

        echo $menuTxt;
      }
    }
}
?>