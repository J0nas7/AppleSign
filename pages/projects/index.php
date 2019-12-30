<?php
$this->LoadModel("Project");

if (!isset($this->User->Userinfo['Workspace_ID'])) {
    $this->Utilities->redirect("/");
}

$displayAll = true;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == "create") {
        $displayAll = false;
        require_once "createNew.php";
    } else if ($action == "edit") {
        $displayAll = false;
        require_once "editProject.php";
    } else if ($action == "timespent") {
        $displayAll = false;
        require_once "timeSpent.php";
    }
}

if ($displayAll) {
    require_once "displayAll.php";
}
?>