<?php
// controllers/CSRRepUnShortlistRequestController.php
require_once __DIR__ . '/../entities/ShortlistedRequest.php';
require_once __DIR__ . '/../entities/Request.php';

class CSRRepUnshortlistRequestController {
    private $shortlistEntity;
    private $requestEntity;

    public function __construct() {
        $this->shortlistEntity = new ShortlistedRequest();
        $this->requestEntity = new Request();
    }

    public function UnshortlistRequest($rID, $csrID) {
        $this->shortlistEntity->removeShortlistedRequest($rID, $csrID);
        $this->requestEntity->decrementSavedCount($rID);
        return true;
    }
}

?>
