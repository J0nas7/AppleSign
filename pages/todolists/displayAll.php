<?php
$projectSql = "SELECT * FROM ".DB_PREFIX."Projects WHERE Project_ID='".$this->User->Userinfo['Project_ID']."' LIMIT 1";
$projectQuery = $this->DB->dbquery($projectSql);
$projectCount = $this->DB->dbcount($projectQuery);
if ($projectCount) {
    $theProject = $this->DB->dbarray($projectQuery);
    ?>
    <span class="pageHeader">
        <span class="title"><?=$theProject['Project_Title'];?></span>
        <a href="?action=timespent" class="stopwatch project">
            <span class="txt">See time spent on the project</span>
        </a>
    </span>
    <span class="pageHeader">Work</span>
    <div class="mainContent mostused">
        <div class="mostused-controllers">
            <span class="actions">
                <span class="txt">Actions</span>
                <span class="fltRght close">X</span>
            </span>
            <strong class="title">Todo title</strong>
            
            <span class="control">Start timer</span>
            <span class="control">Move up list</span>
            <span class="control">Move down list</span>
            <span class="control">Reset to bottom of list</span>
            <span class="control">Remove from list</span>
        </div>
        <strong>Most Used</strong>
        <?php
        $Work = DB_PREFIX."Work";
        $Task = DB_PREFIX."Tasks";
        $sql = "SELECT * FROM ".$Work." INNER JOIN ".$Task." ON ".$Work.".Task_ID = ".$Task.".Task_ID WHERE ".$Task.".Project_ID = '".$this->User->Userinfo['Project_ID']."' ";
        $sql .= "AND User_ID='".$this->User->Userinfo['User_ID']."' ORDER BY Work_Counter DESC";
        $query = $this->DB->dbquery($sql);
        ?>
        <ul class="readall-list mostused">
            <?php
            while ($Work = $query->fetch_assoc()) {
            ?>
                <li class="todo">
                    <span>
                        <strong class="task_title"><?=$Work['Task_Title'];?></strong>
                        <small class="task_counter">(<?=$Work['Work_Counter'];?>)</small>
                        <small class="task_desc">- <?=$Work['Task_Description'];?></small>
                        <span class="clrBth fltLft"></span>
                    </span>
                    <span class="clrBth fltLft"></span>
                </li>
            <?
            }
            ?>
        </ul>
        <div class="clrBth"></div>
    </div>
    <span class="pageHeader">Tasks</span>
    <div class="mainContent">
        <?php
        $sql = "SELECT * FROM ".DB_PREFIX."TodoLists WHERE Project_ID='".$this->User->Userinfo['Project_ID']."'";
        $query = $this->DB->dbquery($sql);
        $count = $this->DB->dbcount($query);
        while ($TodoList = $query->fetch_assoc()) {
            ?>
            <div class="todolist">
                <span class="listtitle">
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == "editL" && isset($_GET['edit']) && $_GET['edit'] == $TodoList['Todolist_ID']) {
                        ?>
                        <form class="smallUpdate list" action="" method="post">
                            <input class="inputField" type="text" name="Title" value="<?=$TodoList['Todolist_Title'];?>" placeholder="Title of todolist" />
                            <input class="button" type="submit" name="Save" value="Ok" />
                        </form>
                        <?
                        if (isset($_POST['Save'])) {
                            $Title = $this->DB->res($_POST['Title']);
                            if (!empty($Title)) {
                                $updateTodolistSql = "UPDATE ".DB_PREFIX."TodoLists SET Todolist_Title='".$Title."' WHERE Todolist_ID='".$TodoList['Todolist_ID']."'";
                                $updateTodolistQuery = $this->DB->dbquery($updateTodolistSql);

                            }
                            $this->Utilities->redirect("/todolists");
                        }
                    } else if (isset($_GET['delL']) && $_GET['delL'] == $TodoList['Todolist_ID']) {
                        $deleteTodolistSql = "DELETE FROM ".DB_PREFIX."TodoLists WHERE Todolist_ID='".$TodoList['Todolist_ID']."'";
                        $deleteTodolistQuery = $this->DB->dbquery($deleteTodolistSql);
                        $this->Utilities->redirect("/todolists");
                    } else {
                    ?>
                    <strong><?=$TodoList['Todolist_Title'];?></strong>
                    <? } ?>
                    <span class="actionWrapper">
                        <span class="actionTrigger">
                            <span class="trigger trigger1"></span>
                            <span class="trigger trigger2"></span>
                            <span class="trigger trigger3"></span>
                        </span>
                        <span class="actionGroup">
                            <a class="btn" href="/todolists?ref=actT&action=editL&edit=<?=$TodoList['Todolist_ID'];?>">&#x270E; Edit</a>
                            <a class="btn" href="/todolists?ref=actT&delL=<?=$TodoList['Todolist_ID'];?>">x Delete</a>
                        </span>
                    </span>
                </span>
                <?php
                $taskSql = "SELECT * FROM ".DB_PREFIX."Tasks WHERE Project_ID='".$this->User->Userinfo['Project_ID']."' AND Todolist_ID='".$TodoList['Todolist_ID']."' ORDER BY Task_ID ASC";
                $taskQuery = $this->DB->dbquery($taskSql);
                ?>
                <ul class="readall-list">
                    <?php
                    while ($Task = $taskQuery->fetch_assoc()) {
                    ?>
                        <li class="todo">
                            <span class="workable">
                                <span class="ctrlBtn play"></span>
                                <input type="hidden" class="taskID" value="<?=$Task['Task_ID'];?>" />
                                <?php
                                if (isset($_GET['action']) && $_GET['action'] == "editT" && isset($_GET['edit']) && $_GET['edit'] == $Task['Task_ID']) {
                                    ?>
                                    <form class="smallUpdate task" action="" method="post">
                                        <input type="submit" class="button" name="Save" value="Ok" />
                                        <input type="text" class="inputField" name="Title" value="<?=$Task['Task_Title'];?>" placeholder="Title of task" />
                                        <input type="text" class="inputField" name="Description" value="<?=$Task['Task_Description'];?>" placeholder="Optional description" />
                                    </form>
                                    <?
                                    if (isset($_POST['Save'])) {
                                        $Title = $this->DB->res($_POST['Title']);
                                        $Description = $this->DB->res($_POST['Description']);
                                        if (!empty($Title)) {
                                            $updateTaskSql = "UPDATE ".DB_PREFIX."Tasks SET Task_Title='".$Title."', Task_Description='".$Description."' WHERE Task_ID='".$Task['Task_ID']."'";
                                            $updateTaskQuery = $this->DB->dbquery($updateTaskSql);
            
                                        }
                                        $this->Utilities->redirect("/todolists");
                                    }
                                } else if (isset($_GET['delT']) && $_GET['delT'] == $Task['Task_ID']) {
                                    $deleteTaskSql = "DELETE FROM ".DB_PREFIX."Tasks WHERE Task_ID='".$Task['Task_ID']."'";
                                    $deleteTaskQuery = $this->DB->dbquery($deleteTaskSql);
                                    $this->Utilities->redirect("/todolists");
                                } else {
                                ?>
                                <strong class="work_title"><?=$Task['Task_Title'];?></strong>
                                <small><?=($Task['Task_Description'] ? " - ".$Task['Task_Description'] : "");?></small>
                                <? } ?>
                                <span class="actionWrapper">
                                    <span class="actionTrigger">
                                        <span class="trigger trigger1"></span>
                                        <span class="trigger trigger2"></span>
                                        <span class="trigger trigger3"></span>
                                    </span>
                                    <span class="actionGroup">
                                        <a class="btn" href="/todolists?ref=actT&action=editT&edit=<?=$Task['Task_ID'];?>">&#x270E; Edit</a>
                                        <a class="btn" href="/todolists?ref=actT&delT=<?=$Task['Task_ID'];?>">x Delete</a>
                                    </span>
                                </span>
                            </span>
                        </li>
                    <?
                    }
                    ?>
                </ul>
                <?php
                $displayBtn = true;
                if (isset($_GET['action']) && $_GET['action'] == "createTask") {
                    if (isset($_GET['listId']) && $_GET['listId'] == $TodoList['Todolist_ID']) {
                        $displayBtn = false;
                        require_once "createTask.php";
                    }
                }

                if ($displayBtn) {
                ?>
                <div class="smallCreateBtn">
                    <a href="/todolists?action=createTask&listId=<?=$TodoList['Todolist_ID'];?>" class="btn">+</a>
                    <a href="/todolists?action=createTask&listId=<?=$TodoList['Todolist_ID'];?>" class="txt">Create new task</a>
                </div>
                <?php
                }
                ?>
            </div>
            <?
        }
        ?>
        <div class="clrBth"></div>
        <div class="bigCreateBtn">
            <a href="/todolists?action=create" class="btn">+</a>
            <a href="/todolists?action=create" class="txt">Create new todolist</a>
        </div>
        <div class="clrBth"></div>
    </div>
<?
} else {
    $this->Utilities->redirect("/projects");
}
?>