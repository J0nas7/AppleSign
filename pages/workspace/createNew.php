<?php
if (isset($_POST['Create'])) {
    $Error = false;
    $ErrorMsg = "";
    if (empty($_POST['Name']) || empty($_POST['Ext_Link']) || empty($_POST['Description'])) {
        $Error = true;
        $ErrorMsg .= "- You need to fill all fields.<br>";
    } else {
        if (!filter_var($_POST['Ext_Link'], FILTER_VALIDATE_URL)) {
            $Error = true;
            $ErrorMsg .= "- Link to workspace is not valid.<br>";
        }
    }

    if (!$Error) {
        $Name = $this->DB->res($_POST['Name']);
        $Description = $this->DB->res($_POST['Description']);
        $Ext_Link = $this->DB->res($_POST['Ext_Link']);
        $insertWorkspaceSql = "INSERT INTO ".DB_PREFIX."Workspaces (Workspace_Name, Workspace_Description, Workspace_Ext_Link, Workspace_Superadmin) VALUES ";
        $insertWorkspaceSql .= "('".$Name."', '".$Description."', '".$Ext_Link."', '".$this->User->Userinfo['User_ID']."')";
        if ($this->DB->dbquery($insertWorkspaceSql)) {
            $WorkspaceID = $this->DB->getInsertID();
            $insertAccessSql = "INSERT INTO ".DB_PREFIX."Workspace_Access (Wspc_User_ID, Wspc_Workspace_ID, Wspc_Level) VALUES ";
            $insertAccessSql .= "('".$this->User->Userinfo['User_ID']."', '".$WorkspaceID."', '3')";
            $insertAccessQuery = $this->DB->dbquery($insertAccessSql);
            $this->Utilities->redirect("/");
        } else {
            $Error = true;
            $ErrorMsg = "- There was a database error creating the workspace.<br>";
        }
    }
    if ($Error) {
        $this->FooterbarMsg = "Formular is not correctly filled in.";
        $this->FooterbarType = "Error";
    }
}
?>
<span class="pageHeader">Create new workspace</span>
<div class="mainContent">
    <form class="CRUD" action="" method="post">
        <span class="label">Name:</span>
        <input class="inputField" type="text" name="Name" value="" placeholder="Name of workspace" />
        <span class="label">Link:</span>
        <input class="inputField" type="text" name="Ext_Link" value="" placeholder="Link to workspace website" />
        <span class="label">Description</span>
        <textarea class="inputTextarea" name="Description"></textarea>
        <input class="button" type="submit" name="Create" value="Create workspace" />
        
        <?php if (isset($ErrorMsg)) { ?>
            <div class="ErrorMsg"><?=$ErrorMsg;?></div>
        <? } ?>
    </form>
</div>