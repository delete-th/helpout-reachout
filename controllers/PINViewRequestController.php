<?php
// controllers/PINViewRequestController.php
require_once __DIR__ . '/../entities/Request.php';


class PINViewRequestController {
    private $requestEntity;

    public function __construct() {
        // Controller creates its own entity
        $this->requestEntity = new Request();
    }

    public function GetRequestByID($rID) {
        return $this->requestEntity->getRequestByID($rID);
    }
	
	public function GetAllRequests($pinID) {
		return $this->requestEntity->getAllRequests($pinID);
	}
	
	public function UpdateStatus($rID, $effectiveStatus) {
		return $this->requestEntity->updateStatus($rID, $effectiveStatus);
	}	

}
?>