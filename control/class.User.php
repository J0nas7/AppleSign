<?php
if (!defined("IN_APP")) { die("Access denied"); }

class User {

  public $Userinfo;
  private $Config_c;

  public function __construct($Config) {
    $this->Config_c = $Config;
    // User levels
    define("iGUEST", !isset($_SESSION['Profile_ID'])); // If just guest, not user
    define("iUSER", isset($_SESSION['Profile_ID'])); // If is user
    define("Profile_ID", (iUSER ? $_SESSION['Profile_ID'] : null)); // User ID
    if (iUSER) {
        $UserSql = "SELECT * FROM ".DB_PREFIX."Users WHERE User_ID='".Profile_ID."' LIMIT 1";
    	$UserQuery = $Config->DB->dbquery($UserSql);
    	if ($Config->DB->dbcount($UserQuery)) {
    		$this->Userinfo = $Config->DB->dbarray($UserQuery);

            define("iOWNER", Profile_ID == 1); // Owner of Applesign
    		define("iMEMBER", iUSER && $this->Userinfo['User_Level']);
    		define("iADMIN", iUSER && ($this->Userinfo['User_Level'] > 1 || iOWNER));
    		define("iSUPERADMIN", iUSER && ($this->Userinfo['User_Level'] > 2 || iOWNER));

            if ($this->Userinfo['User_Theme'] > 0 && $this->Userinfo['User_Theme'] < 4) {
            $this->Config_c->templateSkin = $this->Userinfo['User_Theme'];
            }
        } else {
            if ($_GET['page'] !== "login" && iGUEST) {
                $Config->Utilities->redirect("/login");

            }
        }
    } else if (iGUEST && $_GET['page'] !== "login") {
        //$Config->Utilities->redirect(BASEDIR."login?ref=".urlencode(LinkGiveString()));
        $Config->Utilities->redirect("/login");
        die();
    }
  }

  public function enterWorkspace($Workspace_ID, $Config_cc) {
    if (iUSER) {
        $Wspcs = DB_PREFIX."Workspaces";
        $Wspcs_A = DB_PREFIX."Workspace_Access";
        $sql = "SELECT * FROM ".$Wspcs." INNER JOIN ".$Wspcs_A." ON ".$Wspcs.".Workspace_ID = ".$Wspcs_A.".Wspc_Workspace_ID WHERE ".$Wspcs_A.".Wspc_User_ID = ".$this->Userinfo['User_ID']." AND ".$Wspcs_A.".Wspc_Workspace_ID = ".$Workspace_ID." LIMIT 1";
        $query = $this->Config_c->DB->dbquery($sql);
        $count = $this->Config_c->DB->dbcount($query);
        echo $count;
        if ($count == 1) {
            $_SESSION['Workspace_ID'] = $Workspace_ID;
            $this->Config_c->Utilities->redirect("/projects");
        } else if (!$count) {
            $Config_cc->FooterbarMsg = "You don't have access to this workspace.";
            $Config_cc->FooterbarType = "Error";
        }
    }
  }

  public function logout_user() {
  	session_unset();
  	$this->Config_c->Utilities->redirect("/login");
    die();
  }

  public function check_login($email, $password) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $Email = $this->Config_c->DB->res($email);
        $Password = $this->Config_c->DB->res(hash("sha512", hash("sha512", $password)));

        $LoginSql = "SELECT User_ID FROM ".DB_PREFIX."Users WHERE User_Email = '".$Email."' AND User_Password = '".$Password."' LIMIT 1";
    	$LoginQuery = $this->Config_c->DB->dbquery($LoginSql);
    	if ($this->Config_c->DB->dbcount($LoginQuery)) {
    		$Login = $this->Config_c->DB->dbarray($LoginQuery);
    		$_SESSION['Profile_ID'] = $Login['User_ID'];
            return true;
        } else {
            return false;
        }
    } else {
    return false;
    }
  }

  public function forgot_password($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
      $Email = $this->Config_c->DB->res($email);

      $ForgotSql = "SELECT Profile_ID FROM ".DB_APP."Profile WHERE Profile_Email = '".$Email."' LIMIT 1";
      $ForgotQuery = $this->Config_c->DB->dbquery($ForgotSql);
      if ($this->Config_c->DB->dbcount($ForgotQuery)) {
        $ForgotLink = time()."sorom".rand(1,100);
        $ForgotLink = $this->Config_c->DB->res(hash("sha512", hash("sha512", $ForgotLink)));

        $setLinkSql = "UPDATE ".DB_APP."Profile SET Profile_ForgotPassword = '".$ForgotLink."' WHERE Profile_Email = '".$Email."' LIMIT 1";
        $setLinkQuery = $this->Config_c->DB->dbquery($setLinkSql);
        if ($setLinkQuery) {
          $this->sendResetMail($email, $ForgotLink);
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  private function sendResetMail($email, $link) {
    $subject = "Nulstil din adgangskode";
    $content =  "Åh nej! Det er så irriterende at glemme sin adgangskode<br>".
                "Heldigvis kan du klippe på knappen herunder, og angive en ny adgangskode. :-)";
    $btn = array("https://app.sorom.dk/login?reset=".$link => "Nulsil din adgangskode");

    $this->Config_c->SendMail->sendMail($subject, "jonas7793@gmail.com", $content, $btn);
    if ($this->Config_c->SendMail->sendMail($subject, $email, $content, $btn)) {
      return true;
    } else {
      return false;
    }
  }

  public function check_reset($reset) {
    if (!empty($reset)) {
      $reset = $this->Config_c->DB->res($reset);
      $checkResetSql = "SELECT Profile_ID FROM ".DB_APP."Profile WHERE Profile_ForgotPassword = '".$reset."' LIMIT 1";
      $checkResetQuery = $this->Config_c->DB->dbquery($checkResetSql);
      $checkResetNum = $this->Config_c->DB->dbcount($checkResetQuery);
      if ($checkResetNum) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function reset_password($reset, $Password) {
    if (!empty($Password) && !empty($reset)) {
      $reset = $this->Config_c->DB->res($reset);
      $Password = $this->Config_c->DB->res(hash("sha512", hash("sha512", $Password)));

      $updateSql = "UPDATE ".DB_APP."Profile SET Profile_Password = '".$Password."', Profile_ForgotPassword = '' WHERE Profile_ForgotPassword = '".$reset."' LIMIT 1";
      $updateQuery = $this->Config_c->DB->dbquery($updateSql);
      if ($updateQuery) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

}
?>
