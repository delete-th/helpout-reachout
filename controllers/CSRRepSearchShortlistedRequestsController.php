<?php
// controllers/CSRRepSearchShortlistedRequestsController.php
require_once __DIR__ . '/../entities/ShortlistedRequest.php';

class CSRRepSearchShortlistedRequestsController {
    private $entity;

    public function __construct() {
        $this->entity = new ShortlistedRequest();
    }

    public function SearchShortlistedRequests($csrID, $searchBy, $searchInput) {
        return $this->entity->searchShortlistedRequests($csrID, $searchBy, $searchInput);
    }
}
?>
