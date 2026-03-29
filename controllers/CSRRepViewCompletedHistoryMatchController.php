<?php
// controllers/CSRRepViewCompletedHistoryMatchController.php

require_once __DIR__ . '/../entities/VolunteerMatch.php';

class CSRRepViewCompletedHistoryMatchController {
    
    private $entity;

    public function __construct() {
        $this->entity = new VolunteerMatch();
    }


    public function CSRRepGetAllCompletedMatchesByCSRID($csrID) {
        $completedMatchesByCSRID = $this->entity->csrRepGetAllCompletedMatchesByCSRID($csrID);

        return $completedMatchesByCSRID;
    }

    public function CSRRepGetCompletedMatchByMID($mID) {
        $completedMatchByMID = $this->entity->csrRepGetCompletedMatchByMID($mID);

        return $completedMatchByMID;
    }
	
}
?>
