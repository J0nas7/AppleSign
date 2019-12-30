<span class="pageHeader">Time spent for the entire workspace</span>
<div class="mainContent">

<?php
$yesterdayStart = strtotime("yesterday");
$yesterdayEnd = strtotime("midnight")-1;
$lastweekStart = strtotime("last monday");
$lastweekEnd = strtotime("monday")-1;
$lastmonthStart = strtotime("midnight", strtotime("first day of last month"));
$lastmonthEnd = strtotime("midnight", strtotime("first day of this month"))-1;
$todayStart = strtotime("midnight");
$todayEnd = ($todayStart+86400);

simpleOverview("Today so far", $todayStart, $todayEnd, $this);
simpleOverview("Yesterday", $yesterdayStart, $yesterdayEnd, $this);
simpleOverview("Last week", $lastweekStart, $lastweekEnd, $this);
simpleOverview("Last month", $lastmonthStart, $lastmonthEnd, $this);
function simpleOverview($Headline, $TimeStart, $TimeEnd, $Config_cc) {
?>
    <span class="pageHeader"><?=$Headline;?></span>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <th>Project</th>
                <th>Time spent</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $projectSql = "SELECT Project_ID, Project_Title FROM ".DB_PREFIX."Projects WHERE Workspace_ID='".$Config_cc->User->Userinfo['Workspace_ID']."'";
            $projectQuery = $Config_cc->DB->dbquery($projectSql);
            $totalTimeSpent = 0;
            while ($Project = $projectQuery->fetch_assoc()) {
                $Track = DB_PREFIX."Track";
                $Tasks = DB_PREFIX."Tasks";
                $timeSql = "SELECT ".$Track.".Track_StartTime, ".$Track.".Track_EndTime FROM ".$Track." INNER JOIN ".$Tasks." ON ".$Track.".Task_ID = ".$Tasks.".Task_ID ";
                $timeSql .= "WHERE ".$Tasks.".Project_ID = ".$Project['Project_ID'];
                if ($TimeStart > 0 && $TimeEnd > 0) {
                    $timeSql .= " AND ".$TimeStart." < ".$Track.".Track_StartTime AND ".$Track.".Track_EndTime < ".$TimeEnd;
                }
                $timeQuery = $Config_cc->DB->dbquery($timeSql);
                $timeSpent = 0;
                while ($Track = $timeQuery->fetch_assoc()) {
                    if ($Track['Track_EndTime']) {
                        $timeSpent += ($Track['Track_EndTime']-$Track['Track_StartTime']);
                    }
                }
                $totalTimeSpent += $timeSpent;
                if ($timeSpent) {
                ?>
                <tr>
                    <td><?=$Project['Project_Title'];?></td>
                    
                    <td><?=gmdate("H:i:s", $timeSpent);?></td>
                </tr>
                <?
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <th>Total time spent</th>
                <td><u><?=gmdate("H:i:s", $totalTimeSpent);?></u></td>
            </tr>
        </tfoot>
    </table>
<?
}

function displayGmdate($timestamp) {
    $echo = "H";
    $echo .= "<strong>".gmdate("H", $timestamp)."</strong>";
    $echo .= ":M";
    $echo .= "<strong>".gmdate("i", $timestamp)."</strong>";
    $echo .= ":S";
    $echo .= "<strong>".gmdate("s", $timestamp)."</strong>";
    return $echo;
}
?>
</div>