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
                <span class="name_desc">
                    <a href="/projects?set=<?=$Project->getProject_ID();?>">
                        <strong><?=$Project->getProject_Title();?></strong>
                        <span> - <?=$Project->getProject_Description();?></span>
                    </a>
                </span>
                <span class="actionWrapper">
                    <span class="actionTrigger">
                        <span class="trigger trigger1"></span>
                        <span class="trigger trigger2"></span>
                        <span class="trigger trigger3"></span>
                    </span>
                    <span class="actionGroup">
                        <a class="btn" href="/projects?ref=actP&action=edit&edit=<?=$Project->getProject_ID();?>">&#x270E; Edit</a>
                        <a class="btn" href="/projects?ref=actP&del=<?=$Project->getProject_ID();?>">x Delete</a>
                    </span>
                </span>
            </li>
        <?
        }

        if (isset($_GET['set'])) {
            $Project_ID = $this->DB->res($_GET['set']);
            $this->User->enterProject($Project_ID, $this);
        }
        if (isset($_GET['del'])) {
            $Project_ID = $this->DB->res($_GET['del']);
            $this->User->deleteProject($Project_ID, $this);
        }
        ?>
    </ul>
    <div class="bigCreateBtn">
        <a href="/projects?action=create" class="btn">+</a>
        <a href="/projects?action=create" class="txt">Create new project</a>
    </div>
</div>