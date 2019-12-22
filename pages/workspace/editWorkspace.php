<?php
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $Workspace_ID = $this->DB->res($_GET['edit']);
    $workspaceSql = "SELECT * FROM ".DB_PREFIX."Workspaces WHERE Workspace_ID='".$Workspace_ID."' LIMIT 1";
    $workspaceQuery = $this->DB->dbquery($workspaceSql);
    $Workspace = $this->DB->dbarray($workspaceQuery);

    if (isset($_POST['Save'])) {
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
            $updateWorkspaceSql = "UPDATE ".DB_PREFIX."Workspaces SET Workspace_Name='".$Name."', Workspace_Description='".$Description."', Workspace_Ext_Link='".$Ext_Link."' WHERE Workspace_ID='".$Workspace_ID."'";
            if ($this->DB->dbquery($updateWorkspaceSql)) {
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
    <span class="pageHeader">Edit workspace:<br><?=$Workspace['Workspace_Name'];?></span>
    <div class="mainContent">
        <form class="CRUD" action="" method="post">
            <span class="label">Name:</span>
            <input class="inputField" type="text" name="Name" value="<?=$Workspace['Workspace_Name'];?>" placeholder="Name of workspace" />
            <span class="label">Link:</span>
            <input class="inputField" type="text" name="Ext_Link" value="<?=$Workspace['Workspace_Ext_Link'];?>" placeholder="Link to workspace website" />
            <span class="label">Description</span>
            <textarea class="inputTextarea" name="Description"><?=$Workspace['Workspace_Description'];?></textarea>
            <input class="button" type="submit" name="Save" value="Save and go back" />
            
            <?php if (isset($ErrorMsg)) { ?>
                <div class="ErrorMsg"><?=$ErrorMsg;?></div>
            <? } ?>
        </form>
    </div>
<?php
} else {
    echo "Workspace ID not valid";
}
?>