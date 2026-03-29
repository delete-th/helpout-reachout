<?php
// controllers/CreateUserProfileController.php
require_once __DIR__ . '/../entities/UserProfile.php';

class CreateUserProfileController {
    private $userProfileEntity;

    public function __construct() {
        // Controller creates its own entity
        $this->userProfileEntity = new UserProfile();
    }

	public function CreateUserProfile($name, $description, $status) {
		
		return $this->userProfileEntity->createUserProfile($name, $description, $status);
		
			
		
	}

}
?>