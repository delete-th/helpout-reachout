<?php
require_once __DIR__ . '/../entities/UserProfile.php';

class UpdateUserProfileController {
    private $entity;

    public function __construct() {
        $this->entity = new UserProfile();
    }

    public function GetUserProfileByID($pID) {
        return $this->entity->getUserProfileByID($pID);
    }

    public function UpdateUserProfile($pID, $name, $description, $status) {
        return $this->entity->updateUserProfile($pID, $name, $description, $status);
    }
}
?>
