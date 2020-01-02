<?php
if (!defined("IN_APP")) { die("Access denied"); }
require_once "control/class.Database.php";
require_once "control/class.Utilities.php";
require_once "control/class.User.php";
require_once "control/class.Template.php";

class Configuration {

  public $Utilities;
  public $DB;
  public $User;
  public $Web;
  public $PAGE_LEVEL;
  public $Template;
  public $templateSkin;
  public $Sitename;
  public $Supportmail;
  public $microtime_1;
  public $FooterbarMsg;
  public $FooterbarType;

  public function __construct() {
    $this->templateSkin = 1;
    $this->Sitename = "Applesign";
    $this->Supportmail = "hej@applesign.dk";

    $this->DB = DatabaseConfig::getInstance();
    $this->Utilities = new Utilities();
    $this->User = new User($this);
    $this->Template = new Template($this);

    $this->microtime_1 = microtime(true);

    // Locate Basedir.php and set the BASEDIR path
    $folder_level = ""; $i = 0;
    while (!file_exists($folder_level."Basedir.html")) {
    	$folder_level .= "../"; $i++;
    	if ($i == 7) { die("Basedir.html file not found"); }
    }

    $PHP_SELF = $_SERVER['PHP_SELF'];//$this->Utilities->cleanurl($_SERVER['PHP_SELF']);
    
    define("BASEDIR", $folder_level);
    define("PAGE", (isset($_GET['page']) ? $_GET['page'] : "workspace"));
    define("APP_URL", ($_SERVER['HTTP_HOST'] == "localhost" ? "/" : "http://applesign.dk/"));
    define("CONTROL", "control/");
    define("PAGES", "pages/");
    define("MODEL", "model/");
    define("PLUGINS", "plugins/");
    define("TEMPLATE", "template/");
    define("TEMPLATE_URL", APP_URL."template/");
    define("PHP_SELF", $PHP_SELF);
    define("USER_IP", $_SERVER['REMOTE_ADDR']);

    if (PAGE !== "login") {
      if (!isset($_SESSION['Profile_ID'])) {
        $this->Utilities->redirect("/login");
        die();
      }

      require_once TEMPLATE."index.php";
    } else if (PAGE == "login" && !isset($_SESSION['Profile_ID'])) {
      $this->getPage($_GET['page']);
    }

    if (PAGE == "logout") {
      $this->User->logout_user();
    }
    
    $Config = $this;

    if (PAGE !== "login") {
      //require_once TEMPLATE."footer.php";
    }
  }

  private function getPage($page, $load = true) {
  	if (!empty($page)) {
      if (file_exists(BASEDIR."pages/".$page."/index.php")) {
        if ($load) {
  				$this->PAGE_LEVEL = "pages/".$page."/";
  	      require_once BASEDIR."pages/".$page."/index.php";
  			}
      } else if (file_exists(BASEDIR."pages/".$page.".php")) {
  			if ($load) {
  				$this->PAGE_LEVEL = "pages/";
  	      require_once BASEDIR."pages/".$page.".php";
  			}
      } else {
  			$this->NotificationsArray[] = array("Type" => "Warning", "Message" => "Siden er ikke tilgængelig: Kunne ikke findes");
      }
  	} else {
  		$this->NotificationsArray[] = array("Type" => "Warning", "Message" => "Siden er ikke tilgængelig: Tom forespørgsel");
  		$this->Utilities->redirect($this->Utilities->LinkGiveString('page', 'websites'));
  	}
  }

  public function LoadModel($Name) {
  	$filename = MODEL."class.".$Name.".php";
  	if (file_exists($filename)) {
  		include $filename;
  	} else {
      die("Model doesn't exist");
    }
  }
  
  public function LoadPlugin($Name) {
  	$filename = PLUGINS.$Name."/loader.php";
  	if (file_exists($filename)) {
  		include $filename;
  	} else {
    }
  }

}
?>