<?php
// controllers/ViewUserProfileController.php
require_once __DIR__ . '/../entities/UserProfile.php';

class ViewUserProfileController {
    private $userProfileEntity;

    public function __construct() {
        // Controller creates its own entity
        $this->userProfileEntity = new UserProfile();
    }

    public function GetUserProfiles() {
        $profiles = $this->userProfileEntity->viewUserProfiles();
        return $profiles;
    }

    public function GetUserProfileByID($pID) {
        return $this->userProfileEntity->getUserProfileByID($pID);
    }

}
?>
