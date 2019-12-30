<?php
if (!isset($this->User->Userinfo['Project_ID'])) {
    if (isset($this->User->Userinfo['Workspace_ID'])) {
        $this->Utilities->redirect("/projects");
    } else {
        $this->Utilities->redirect("/");
    }
}

$displayAll = true;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == "create") {
        $displayAll = false;
        require_once "createNew.php";
    } else if ($action == "createTask") {
        $displayAll = true;
    } else if ($action == "timespent") {
        $displayAll = false;
        require_once "timeSpent.php";
    }
}

if ($displayAll) {
    require_once "displayAll.php";
}
?>