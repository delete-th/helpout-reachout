
<?php
	// controllers/SearchRequestsController.php
	require_once __DIR__ . '/../entities/Request.php';

	class PINSearchRequestsController {
		private $entity;

		public function __construct() {
			$this->entity = new Request();
		}

		// Only handle searching
		public function SearchRequestsForPIN($pinID, $searchBy, $searchInput) {
			return $this->entity->searchRequestsForPIN($pinID, $searchBy, $searchInput);
		}
		
		public function GetAllRequests($pinID) {
		return $this->entity->getAllRequests($pinID);
	}
	}
?>