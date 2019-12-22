<?php
if (isset($_POST['Create'])) {
    $Error = false;
    $ErrorMsg = "";
    if (empty($_POST['Title'])) {
        $Error = true;
        $ErrorMsg .= "- You need to fill all fields.<br>";
    }

    if (!$Error) {
        $Title = $this->DB->res($_POST['Title']);
        $insertTodolistSql = "INSERT INTO ".DB_PREFIX."TodoLists (Todolist_Title, Project_ID) VALUES ";
        $insertTodolistSql .= "('".$Title."', '".$this->User->Userinfo['Project_ID']."')";
        if ($this->DB->dbquery($insertTodolistSql)) {
            $this->Utilities->redirect("/todolists");
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
<span class="pageHeader">Create new todolist</span>
<div class="mainContent">
    <form class="CRUD" action="" method="post">
        <span class="label">Title:</span>
        <input class="inputField" type="text" name="Title" value="" placeholder="Title of todolist" />
        <input class="button" type="submit" name="Create" value="Create todolist" />
        
        <?php if (isset($ErrorMsg)) { ?>
            <div class="ErrorMsg"><?=$ErrorMsg;?></div>
        <? } ?>
    </form>
</div>