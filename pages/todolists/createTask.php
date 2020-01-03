<?php
if (isset($_POST['Create'])) {
    $Error = false;
    $ErrorMsg = "";
    if (empty($_POST['Task'])) {
        $Error = true;
        $ErrorMsg .= "- You need to write a title.<br>";
    }

    if (!$Error) {
        $Task = $this->DB->res($_POST['Task']);
        $Description = $this->DB->res($_POST['Description']);
        $insertTaskSql = "INSERT INTO ".DB_PREFIX."Tasks (Task_Title, Task_Description, Project_ID, Todolist_ID, Task_Status) VALUES ";
        $insertTaskSql .= "('".$Task."', '".$Description."', '".$this->User->Userinfo['Project_ID']."', '".$TodoList['Todolist_ID']."', '1')";
        if ($this->DB->dbquery($insertTaskSql)) {
            $this->Utilities->redirect("/todolists?action=createTask&listId=".$TodoList['Todolist_ID']);
        } else {
            $Error = true;
            $ErrorMsg = "- There was a database error creating the project.<br>";
        }
    }
    if ($Error) {
        $this->FooterbarMsg = "Formular is not correctly filled in.";
        $this->FooterbarType = "Error";
    }
}
?>
<form class="CRUD createTask" action="" method="post">
    <span class="label">Task:</span>
    <input class="inputField Task" type="text" name="Task" value="" placeholder="Title of task" />
    <input class="inputField" type="text" name="Description" value="" placeholder="Optional description" />
    <input class="button" type="submit" name="Create" value="Create task" />
    <span class="taskAbortLink">Or <a href="<?=APP_URL;?>/todolists">I'm done adding tasks.</a></span>
    
    <?php if (isset($ErrorMsg)) { ?>
        <div class="ErrorMsg"><?=$ErrorMsg;?></div>
    <? } ?>
    <div class="clrBth"></div>
</form>