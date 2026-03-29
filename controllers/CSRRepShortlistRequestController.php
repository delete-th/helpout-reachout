<?php
// controllers/CSRRepShortlistRequestController.php
require_once __DIR__ . '/../entities/ShortlistedRequest.php';
require_once __DIR__ . '/../entities/Request.php';

class CSRRepShortlistRequestController {
    private $shortlistEntity;
    private $requestEntity;

    public function __construct() {
        $this->shortlistEntity = new ShortlistedRequest();
        $this->requestEntity = new Request();
    }

    public function ShortlistRequest($rID, $csrID) {
        // Copy full request data into shortlistedrequest
        $this->shortlistEntity->addShortlistedRequest($rID, $csrID);
        $this->requestEntity->incrementSavedCount($rID);
        return true;
    }
}
?>
