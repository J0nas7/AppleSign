<span class="pageHeader">Projects</span>
<div class="mainContent">
    <?php
    $sql = "SELECT * FROM ".DB_PREFIX."Projects WHERE Workspace_ID='".$this->User->Userinfo['Workspace_ID']."'";
    $query = $this->DB->dbquery($sql);
    ?>
    <ul class="readall-list">
        <?php
        while ($Project = $query->fetch_assoc()) {
        $Project = new Project($Project['Project_ID'], $Project['Workspace_ID'], $Project['Project_Title'], $Project['Project_Description']);
        ?>
            <li class="project">
                <a href="/projects?set=<?=$Project->getProject_ID();?>">
                    <strong><?=$Project->getProject_Title();?></strong>
                    <span> - <?=$Project->getProject_Description();?></span>
                </a>
            </li>
        <?
        }

        if (isset($_GET['set'])) {
            $Project_ID = $this->DB->res($_GET['set']);
            $this->User->enterProject($Project_ID, $this);
        }
        ?>
    </ul>
    <div class="bigCreateBtn">
        <a href="/projects?action=create" class="btn">+</a>
        <a href="/projects?action=create" class="txt">Create new project</a>
    </div>
</div>