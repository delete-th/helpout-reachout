<?php
// controllers/CSRRepSearchCompletedMatchesHistoryController.php
require_once __DIR__ . '/../entities/VolunteerMatch.php';

class CSRRepSearchCompletedMatchesHistoryController {
    private $entity;

    public function __construct() {
        $this->entity = new VolunteerMatch();
    }

    public function CSRRepSearchHistoryMatches($csrID, $searchBy, $searchInput) {
        return $this->entity->csrRepSearchHistoryMatches($csrID, $searchBy, $searchInput);
    }
}
?>
