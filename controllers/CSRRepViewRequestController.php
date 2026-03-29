<?php
// controllers/CSRRepViewRequestController.php
require_once __DIR__ . '/../entities/Request.php';

class CSRRepViewRequestController {
    private $entity;

    public function __construct() {
        $this->entity = new Request();
    }

    public function GetAllRequests() {
        $profiles = $this->entity->csrRepGetAllRequests();
        return $profiles;
    }

    public function GetRequestByID($rID) {
        return $this->entity->getRequestByID($rID);
    }

    public function IncrementRequestViewCount($rID) {
        return $this->entity->incrementRequestViewCount($rID);
    }
}
?>
