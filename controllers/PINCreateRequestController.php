
<?php
	// controllers/PINCreateRequestController.php
	require_once __DIR__ . '/../entities/Request.php';

	class PINCreateRequestController {
		private $requestEntity;

		public function __construct() {
			// Controller creates its own entity
			$this->requestEntity = new Request();
		}

		public function CreateRequest($pinID, $category, $description, $formattedDate, $location, $status, $priority) {
			$result = $this->requestEntity->createRequest($pinID, $category, $description, $formattedDate, $location, $status, $priority);
			
			return $result;

		}

	}
?>