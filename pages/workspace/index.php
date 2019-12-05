<?php
$this->LoadModel("Workspace");
?>
<span class="pageHeader">Workspaces</span>
<div class="mainContent">
    <?php
    $Wspcs = DB_PREFIX."Workspaces";
    $Wspcs_A = DB_PREFIX."Workspace_Access";
    $sql = "SELECT * FROM ".$Wspcs." INNER JOIN ".$Wspcs_A." ON ".$Wspcs.".Workspace_ID = ".$Wspcs_A.".Wspc_Workspace_ID WHERE ".$Wspcs_A.".Wspc_User_ID = ".$this->User->Userinfo['User_ID'];
    $query = $this->DB->dbquery($sql);
    ?>
    <ul class="workspaces-list">
        <?php
        while ($Workspace = $query->fetch_assoc()) {
        $Workspace = new Workspace($Workspace['Workspace_ID'], $Workspace['Workspace_Name'], $Workspace['Workspace_Description'], $Workspace['Workspace_Ext_Link'], $Workspace['Workspace_Superadmin']);
        ?>
            <li class="workspace">
                <?php /*<a href="<?=$this->Utilities->makeLink(array("extra" => array("set" => $Workspace->getWorkspace_ID())));?>"> */ ?>
                <a href="/?set=<?=$Workspace->getWorkspace_ID();?>">
                    <strong><?=$Workspace->getWorkspace_Name();?></strong>
                    <span> - <?=$Workspace->getWorkspace_Description();?></span>
                </a>
            </li>
        <?
        }

        if (isset($_GET['set'])) {
            $Workspace_ID = $this->DB->res($_GET['set']);
            $this->User->enterWorkspace($Workspace_ID, $this);
        }
        ?>
    </ul>
    <div class="createWorkspace">
        <span class="btn">+</span>
        <span class="txt">Create new workspace</span>
    </div>
</div>