<?php
$displayAll = true;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == "create") {
        $displayAll = false;
        require_once "createNew.php";
    } else if ($action == "createTask") {
        $displayAll = true;
    }
}

if ($displayAll) {
    require_once "displayAll.php";
}
?>