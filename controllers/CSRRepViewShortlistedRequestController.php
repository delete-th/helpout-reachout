<?php
// controllers/CSRRepViewShortlistedRequestController.php

require_once __DIR__ . '/../entities/ShortlistedRequest.php';

class CSRRepViewShortlistedRequestController {
    
    private $shortlistedRequestEntity;

    public function __construct() {
        $this->shortlistedRequestEntity = new ShortlistedRequest();
    }

    /**
     * Get all requests shortlisted by a specific CSR
     * Returns an array of full request details
     */
    public function GetShortlistedRequestsByCSR($csrID) {
        // Fetch the shortlist rows for this CSR
        $shortlistedRequestsByCSRRep = $this->shortlistedRequestEntity->getShortlistedRequestsByCSR($csrID);

        return $shortlistedRequestsByCSRRep;
    }

    public function GetShortlistedRequestByRID($rID) {
        // Fetch the shortlist row for this a specific rID
        $shortlistedRequestByRID = $this->shortlistedRequestEntity->getShortlistedRequestByRID($rID);

        return $shortlistedRequestByRID;
    }
	
}
?>
