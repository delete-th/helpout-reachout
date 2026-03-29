<?php
//controllers/SuspendUserProfileController.php

	require_once __DIR__ . '/../entities/UserProfile.php';

	class SuspendUserProfileController {
		private $entity;
		
		public function __construct() {
			$this->entity = new UserProfile();
		}
		
		public function suspendUserProfile($pID) {
			$result = $this->entity->suspendUserProfile($pID);
			return $result; 
		} 
	}

