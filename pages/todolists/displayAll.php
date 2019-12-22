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
            <strong class="listtitle"><?=$TodoList['Todolist_Title'];?></strong>
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
                            <strong class="work_title"><?=$Task['Task_Title'];?></strong>
                            <input type="hidden" class="taskID" value="<?=$Task['Task_ID'];?>" />
                            <small><?=($Task['Task_Description'] ? " - ".$Task['Task_Description'] : "");?></small>
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