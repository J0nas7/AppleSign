<?php
if (isset($_POST['Create'])) {
    $Error = false;
    $ErrorMsg = "";
    if (empty($_POST['Title']) || empty($_POST['Description'])) {
        $Error = true;
        $ErrorMsg .= "- You need to fill all fields.<br>";
    }

    if (!$Error) {
        $Title = $this->DB->res($_POST['Title']);
        $Description = $this->DB->res($_POST['Description']);
        $insertProjectSql = "INSERT INTO ".DB_PREFIX."Projects (Project_Title, Project_Description, Workspace_ID) VALUES ";
        $insertProjectSql .= "('".$Title."', '".$Description."', '".$this->User->Userinfo['Workspace_ID']."')";
        if ($this->DB->dbquery($insertProjectSql)) {
            $ProjectID = $this->DB->getInsertID();
            $this->Utilities->redirect("/projects");
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
<span class="pageHeader">Create new project</span>
<div class="mainContent">
    <form class="CRUD" action="" method="post">
        <span class="label">Title:</span>
        <input class="inputField" type="text" name="Title" value="" placeholder="Title of project" />
        <span class="label">Description</span>
        <textarea class="inputTextarea" name="Description"></textarea>
        <input class="button" type="submit" name="Create" value="Create project" />
        
        <?php if (isset($ErrorMsg)) { ?>
            <div class="ErrorMsg"><?=$ErrorMsg;?></div>
        <? } ?>
    </form>
</div>