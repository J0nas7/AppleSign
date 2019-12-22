<?php
ob_start();
session_start();
if (
  $_SESSION['Project_ID']
) { define("IN_APP", true); }
header('Content-Type: text/html; charset=utf-8');

require_once "../control/class.Database.php";
require_once "../control/class.User.php";
require_once "task.php";

$BackEnd = new Backend();
class Backend {
  public $DB;
  public $User;
  public $TaskHandler;

  public function __construct() {
    $this->DB = DatabaseConfig::getInstance();
    $this->User = new User($this);
    $this->TaskHandler = new Task($this);

    if (isset($_POST['customData']['startTaskID'])) {
        $taskID = $this->DB->res($_POST['customData']['startTaskID']);
        $newTask = $this->TaskHandler->startTask($taskID);
    } else if (isset($_POST['customData']['checkCurTask'])) {
        $checkTask = $this->TaskHandler->checkCurTask();
    } else if (isset($_POST['customData']['stopCurTask'])) {
        $stopTask = $this->TaskHandler->stopCurTask();
    }


  }
}
?>