<?php
$this->LoadModel("Workspace");

$displayAll = true;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == "create") {
        $displayAll = false;
        require_once "createNew.php";
    } else if ($action == "edit") {
        $displayAll = false;
        require_once "editWorkspace.php";
    }
}

if ($displayAll) {
    require_once "displayAll.php";
}
?>