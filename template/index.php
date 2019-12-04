<?php
ob_start();
session_start();

$DBconn = null;

$servername = "mysql35.unoeuro.com";
$username = "applesign_dk";
$password = "rnceh2za";
$databasename = "applesign_dk_db";
$conn = new mysqli($servername, $username, $password, $databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
define("DB_PREFIX", "App_");
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <title>Time Tracking Tool | Applesign</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" media="screen" href="css/template.min.css?t=<?=time();?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap&display=swap" />
</head>
<body>
    <div class="topbar">
        <div class="topbar-center">
            <span class="logo"></span>
            <span class="applesign">Applesign</span>
            <span class="menuTrigger">
                <span class="hamburger" id="one"></span>
                <span class="hamburger" id="two"></span>
                <span class="hamburger" id="three"></span>
                <span class="x" id="one"></span>
                <span class="x" id="two"></span>
            </span>
            <ul class="topmenu">
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
            </ul>
        </div>
    </div>
    <div class="bottombar">

    </div>
    <div class="pageWrapper">
        <span class="pageHeader">Workspaces</span>
        <div class="mainContent">
            <?php
            $sql = "SELECT * FROM ".DB_PREFIX."Workspaces";
            $query = $conn->query($sql);
            ?>
            <ul class="workspaces-list">
                <?php while ($Workspace = $query->fetch_assoc()) { ?>
                    <li class="workspace">
                        <strong><?=$Workspace['Workspace_Name'];?></strong>
                        <span> - <?=$Workspace['Workspace_Description'];?></span>
                    </li>
                <? } ?>
            </ul>
            <div class="createWorkspace">
                <span class="btn">+</span>
                <span class="txt">Create new workspace</span>
            </div>
        </div>
        <div class="clrBth"></div>
    </div>
</body>
</html>