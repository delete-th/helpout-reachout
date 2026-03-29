<?php
//controllers/SuspendUserAccountController.php

	require_once __DIR__ . '/../entities/UserAccount.php';

	class SuspendUserAccountController {
		private $entity;
		
		public function __construct() {
			$this->entity = new UserAccount();
		}
		
		public function suspendUserAccount($aID) {
			$result = $this->entity->suspendUserAccount($aID);
			return $result; 
		} 
	}
?>
