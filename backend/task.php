<?php
class Task {
    
    private $Config_c;
    public function __construct($Config) {
        $this->Config_c = $Config;
    }

    public function startTask($taskID) {
        $startTimestamp = time();
        $taskTitle = $this->getTaskTitle($taskID);

        if ($taskID !== $this->Config_c->User->Userinfo['User_CurTask']) {
            $updateUserSql = "UPDATE ".DB_PREFIX."Users SET User_CurTask='".$taskID."', User_StartTime='".$startTimestamp."' WHERE User_ID='".$_SESSION['Profile_ID']."'";
            $updateUserQuery = $this->Config_c->DB->dbquery($updateUserSql);

            $selectWorkSql = "SELECT Work_ID FROM ".DB_PREFIX."Work WHERE Task_ID='".$taskID."' AND User_ID='".$_SESSION['Profile_ID']."' LIMIT 1";
            $selectWorkQuery = $this->Config_c->DB->dbquery($selectWorkSql);
            $selectWorkCount = $this->Config_c->DB->dbcount($selectWorkQuery);
            if ($selectWorkCount == 1) {
                $updateWorkSql = "UPDATE ".DB_PREFIX."Work SET Work_Counter=Work_Counter+1 WHERE Task_ID='".$taskID."' AND User_ID='".$_SESSION['Profile_ID']."' LIMIT 1";
                $updateWorkQuery = $this->Config_c->DB->dbquery($updateWorkSql);
            } else {
                $insertWorkSql = "INSERT INTO ".DB_PREFIX."Work (User_ID, Task_ID, Work_Counter) VALUES ('".$_SESSION['Profile_ID']."', '".$taskID."', '1')";
                $insertWorkQuery = $this->Config_c->DB->dbquery($insertWorkSql);
            }

            $checkTrackSql = "SELECT Track_ID FROM ".DB_PREFIX."Track WHERE User_ID='".$_SESSION['Profile_ID']."' AND Track_EndTime='0' LIMIT 1";
            $checkTrackQuery = $this->Config_c->DB->dbquery($checkTrackSql);
            $checkTrackCount = $this->Config_c->DB->dbcount($checkTrackQuery);
            if ($checkTrackCount == 1) {
                $checkTrack = $this->Config_c->DB->dbarray($checkTrackQuery);
                $updateTrackSql = "UPDATE ".DB_PREFIX."Track SET Track_EndTime='".($startTimestamp-1)."' WHERE Track_ID='".$checkTrack['Track_ID']."'";
                $updateTrackQuery = $this->Config_c->DB->dbquery($updateTrackSql);
            }

            $insertTrackSql = "INSERT INTO ".DB_PREFIX."Track (User_ID, Task_ID, Track_StartTime) VALUES ('".$_SESSION['Profile_ID']."', '".$taskID."', '".$startTimestamp."')";
            $insertTrackQuery = $this->Config_c->DB->dbquery($insertTrackSql);
            
            echo json_encode(array("taskTitle" => $taskTitle));
        } else {
            echo json_encode("Already running");
        }
    }

    public function getTaskTitle($taskID) {
        if ($taskID == 0) {
            $taskTitle = "PAUSE";
        } else if ($taskID > 0) {
            $sqlTask = "SELECT Task_Title FROM ".DB_PREFIX."Tasks WHERE Task_ID='".$taskID."' LIMIT 1";
            $queryTask = $this->Config_c->DB->dbquery($sqlTask);
            $countTask = $this->Config_c->DB->dbcount($queryTask);
            if ($countTask) {
                $Task = $this->Config_c->DB->dbarray($queryTask);
                $taskTitle = $Task['Task_Title'];
            }
        }
        return $taskTitle;
    }

    public function checkCurTask() {
        $curTask = $this->Config_c->User->Userinfo['User_CurTask'];
        if ($curTask > 0) {
            $taskTitle = $this->getTaskTitle($curTask);
            $taskStartTime = $this->Config_c->User->Userinfo['User_StartTime'];
            echo json_encode(array("taskTitle" => $taskTitle, "startTime" => $taskStartTime));
        } else {
            echo json_encode("Pause/Stop");
        }
    }

    public function stopCurTask() {
        $getTrackSql = "SELECT Track_ID FROM ".DB_PREFIX."Track WHERE User_ID='".$_SESSION['Profile_ID']."' AND Track_EndTime='0' LIMIT 1";
        $getTrackQuery = $this->Config_c->DB->dbquery($getTrackSql);
        $getTrackCount = $this->Config_c->DB->dbcount($getTrackQuery);
        if ($getTrackCount == 1) {
            $stopTrack = $this->Config_c->DB->dbarray($getTrackQuery);
            $updateTrackSql = "UPDATE ".DB_PREFIX."Track SET Track_EndTime='".time()."' WHERE Track_ID='".$stopTrack['Track_ID']."'";
            $updateTrackQuery = $this->Config_c->DB->dbquery($updateTrackSql);

            $updateUserSql = "UPDATE ".DB_PREFIX."Users SET User_CurTask='', User_StartTime='' WHERE User_ID='".$_SESSION['Profile_ID']."'";
            $updateUserQuery = $this->Config_c->DB->dbquery($updateUserSql);
            echo json_encode("OK");
        } else {
            echo json_encode("Error");
        }
    }

}
?>