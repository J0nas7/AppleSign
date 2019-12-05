<?php
class Workspace {
    private $Workspace_ID;
    private $Workspace_Name;
    private $Workspace_Description;
    private $Workspace_Ext_Link;
    private $Workspace_Superadmin;

    public function __construct($Workspace_ID, $Workspace_Name, $Workspace_Description, $Workspace_Ext_Link, $Workspace_Superadmin) {
        $this->Workspace_ID             = $Workspace_ID;
        $this->Workspace_Name           = $Workspace_Name;
        $this->Workspace_Description    = $Workspace_Description;
        $this->Workspace_Ext_Link       = $Workspace_Ext_Link;
        $this->Workspace_Superadmin     = $Workspace_Superadmin;
    }

    public function getWorkspace_ID() {
        return $this->Workspace_ID;
    }

    public function setWorkspace_ID($Workspace_ID) {
        $this->Workspace_ID = $Workspace_ID;
    }

    public function getWorkspace_Name() {
        return $this->Workspace_Name;
    }

    public function setWorkspace_Name($Workspace_Name) {
        $this->Workspace_Name = $Workspace_Name;
    }

    public function getWorkspace_Description() {
        return $this->Workspace_Description;
    }

    public function setWorkspace_Description($Workspace_Description) {
        $this->Workspace_Description = $Workspace_Description;
    }

    public function getWorkspace_Ext_Link() {
        return $this->Workspace_Ext_Link;
    }

    public function setWorkspace_Ext_Link($Workspace_Ext_Link) {
        $this->Workspace_Ext_Link = $Workspace_Ext_Link;
    }

    public function getWorkspace_Superadmin() {
        return $this->Workspace_Superadmin;
    }

    public function setWorkspace_Superadmin($Workspace_Superadmin) {
        $this->Workspace_Superadmin = $Workspace_Superadmin;
    }
}
?>