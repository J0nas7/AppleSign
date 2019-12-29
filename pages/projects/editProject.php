<?php
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $Project_ID = $this->DB->res($_GET['edit']);
    $projectSql = "SELECT * FROM ".DB_PREFIX."Projects WHERE Project_ID='".$Project_ID."' LIMIT 1";
    $projectQuery = $this->DB->dbquery($projectSql);
    $Project = $this->DB->dbarray($projectQuery);

    if (isset($_POST['Save'])) {
        $Error = false;
        $ErrorMsg = "";
        if (empty($_POST['Title']) || empty($_POST['Description'])) {
            $Error = true;
            $ErrorMsg .= "- You need to fill all fields.<br>";
        }
    
        if (!$Error) {
            $Title = $this->DB->res($_POST['Title']);
            $Description = $this->DB->res($_POST['Description']);
            $updateProjectSql = "UPDATE ".DB_PREFIX."Projects SET Project_Title='".$Title."', Project_Description='".$Description."' WHERE Project_ID='".$Project_ID."'";
            if ($this->DB->dbquery($updateProjectSql)) {
                $this->Utilities->redirect("/projects");
            } else {
                $Error = true;
                $ErrorMsg = "- There was a database error updating the project.<br>";
            }
        }
        if ($Error) {
            $this->FooterbarMsg = "Formular is not correctly filled in.";
            $this->FooterbarType = "Error";
        }
    }
    ?>
    <span class="pageHeader">Edit project:<br><?=$Project['Project_Title'];?></span>
    <div class="mainContent">
        <form class="CRUD" action="" method="post">
            <span class="label">Title:</span>
            <input class="inputField" type="text" name="Title" value="<?=$Project['Project_Title'];?>" placeholder="Title of project" />
            <span class="label">Description</span>
            <textarea class="inputTextarea" name="Description"><?=$Project['Project_Description'];?></textarea>
            <input class="button" type="submit" name="Save" value="Save and go back" />
            
            <?php if (isset($ErrorMsg)) { ?>
                <div class="ErrorMsg"><?=$ErrorMsg;?></div>
            <? } ?>
        </form>
    </div>
<?php
} else {
    echo "Project ID not valid";
}
?>