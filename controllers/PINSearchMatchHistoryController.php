<?php
	// controllers/PINSearchMatchHistoryController.php
	//require_once __DIR__ . '/../entities/Request.php';
	require_once __DIR__ . '/../entities/VolunteerMatch.php';

	class PINSearchMatchHistoryController {
		private $entity;

		public function __construct() {
			//$this->entity = new Request();
			$this->entity = new VolunteerMatch();
		}

		// Only handle searching
		public function SearchMatchHistory($pinID, $searchBy, $searchInput) {
			return $this->entity->searchMatchHistory($pinID, $searchBy, $searchInput);
		}
		
		public function GetPINMatchHistory($pinID) {
			return $this->entity->getPINMatchHistory($pinID);
		}
	}
?>