
<?php
//controllers/PINDeleteRequestController.php

	require_once __DIR__ . '/../entities/Request.php';

	class PINDeleteRequestController {
		private $entity;
		
		public function __construct() {
			$this->entity = new Request();
		}
		
		public function DeleteRequest($rID) {
			$result = $this->entity->deleteRequest($rID);
			return $result; 
		} 
	}
?>