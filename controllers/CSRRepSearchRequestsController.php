<?php
// controllers/CSRRepSearchRequestsController.php
require_once __DIR__ . '/../entities/Request.php';

class CSRRepSearchRequestsController {
    private $entity;

    public function __construct() {
        $this->entity = new Request();
    }

    // Only handle searching
    public function SearchRequests($searchBy, $searchInput) {
        return $this->entity->searchRequests($searchBy, $searchInput);
    }
}
?>
