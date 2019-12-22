<span class="pageHeader">Workspaces</span>
<div class="mainContent">
    <?php
    $Wspcs = DB_PREFIX."Workspaces";
    $Wspcs_A = DB_PREFIX."Workspace_Access";
    $sql = "SELECT * FROM ".$Wspcs." INNER JOIN ".$Wspcs_A." ON ".$Wspcs.".Workspace_ID = ".$Wspcs_A.".Wspc_Workspace_ID WHERE ".$Wspcs_A.".Wspc_User_ID = ".$this->User->Userinfo['User_ID'];
    $query = $this->DB->dbquery($sql);
    ?>
    <ul class="readall-list">
        <?php
        while ($Workspace = $query->fetch_assoc()) {
        $Workspace = new Workspace($Workspace['Workspace_ID'], $Workspace['Workspace_Name'], $Workspace['Workspace_Description'], $Workspace['Workspace_Ext_Link'], $Workspace['Workspace_Superadmin']);
        ?>
            <li class="workspace">
                <span class="name_desc">
                    <a href="/?ref=wspLink&set=<?=$Workspace->getWorkspace_ID();?>">
                        <strong><?=$Workspace->getWorkspace_Name();?></strong>
                        <span> - <?=$Workspace->getWorkspace_Description();?></span>
                    </a>
                </span>
                <span class="actionWrapper">
                    <span class="actionTrigger">
                        <span class="trigger trigger1"></span>
                        <span class="trigger trigger2"></span>
                        <span class="trigger trigger3"></span>
                    </span>
                    <span class="actionGroup">
                        <a class="btn" href="/?ref=actW&action=edit&edit=<?=$Workspace->getWorkspace_ID();?>">&#x270E; Edit</a>
                        <a class="btn" href="/?ref=actW&del=<?=$Workspace->getWorkspace_ID();?>">x Delete</a>
                    </span>
                </span>
            </li>
        <?
        }

        if (isset($_GET['set'])) {
            $Workspace_ID = $this->DB->res($_GET['set']);
            $this->User->enterWorkspace($Workspace_ID, $this);
        }
        if (isset($_GET['del'])) {
            $Workspace_ID = $this->DB->res($_GET['del']);
            $this->User->deleteWorkspace($Workspace_ID, $this);
        }
        ?>
    </ul>
    <div class="bigCreateBtn">
        <a href="/?ref=bigBtn&action=create">
            <span class="btn">+</span>
            <span class="txt">Create new workspace</span>
        </a>
    </div>
</div>