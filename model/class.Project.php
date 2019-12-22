<?php
class Project {
    private $Project_ID;
    private $Workspace_ID;
    private $Project_Title;
    private $Project_Description;

    public function __construct($Project_ID, $Workspace_ID, $Project_Title, $Project_Description) {
        $this->Project_ID           = $Project_ID;
        $this->Workspace_ID         = $Workspace_ID;
        $this->Project_Title        = $Project_Title;
        $this->Project_Description  = $Project_Description;
    }

    public function getProject_ID() {
        return $this->Project_ID;
    }

    public function setProject_ID($Project_ID) {
        $this->Project_ID = $Project_ID;
    }

    public function getWebsite_ID() {
        return $this->Website_ID;
    }

    public function setWebsite_ID($Website_ID) {
        $this->Website_ID = $Website_ID;
    }

    public function getProject_Title() {
        return $this->Project_Title;
    }

    public function setProject_Title($Project_Title) {
        $this->Project_Title = $Project_Title;
    }

    public function getProject_Description() {
        return $this->Project_Description;
    }

    public function setProject_Description($Project_Description) {
        $this->Project_Description = $Project_Description;
    }
}
?>