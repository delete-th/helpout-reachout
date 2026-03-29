<?php
// controllers/SearchUserProfilesController.php
require_once __DIR__ . '/../entities/UserProfile.php';

class SearchUserProfilesController {
    private $entity;

    public function __construct() {
        $this->entity = new UserProfile();
    }

    // Only handle searching
    public function searchUserProfile($searchBy, $searchInput) {
        return $this->entity->searchUserProfile($searchBy, $searchInput);
    }
}
?>
