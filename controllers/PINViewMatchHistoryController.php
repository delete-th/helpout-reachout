<?php
// controllers/PINViewMatchHistoryController.php
//require_once __DIR__ . '/../entities/Request.php';
//require_once __DIR__ . '/../entities/Category.php';
require_once __DIR__ . '/../entities/VolunteerMatch.php';

class PINViewMatchHistoryController {
    private $entity;

    public function __construct() {
        // Controller creates its own entity
        //$this->entity = new Request();
		$this->entity = new VolunteerMatch();
    }
	
	public function GetPINMatchHistory($pinID) {
		return $this->entity->getPINMatchHistory($pinID);
	}

}
?>