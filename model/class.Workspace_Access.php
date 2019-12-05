<?php
class Workspace_Access {
    
    private $Wspc_Access_ID;
    private $Wspc_User_ID;
    private $Wspc_Workspace_ID;
    private $Wspc_Level;
    private $Wspc_Assigned_Projects;

    public function __construct($Wspc_Access_ID, $Wspc_User_ID, $Wspc_Workspace_ID, $Wspc_Level, $Wspc_Assigned_Projects) {
        $this->Wspc_Access_ID           = $Wspc_Access_ID;
        $this->Wspc_User_ID             = $Wspc_User_ID;
        $this->Wspc_Workspace_ID        = $Wspc_Workspace_ID;
        $this->Wspc_Level               = $Wspc_Level;
        $this->Wspc_Assigned_Projects   = $Wspc_Assigned_Projects;
    }
}
?>