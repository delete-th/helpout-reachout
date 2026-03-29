<?php
// controllers/PINViewVolunteerMatchController.php
//require_once __DIR__ . '/../entities/Request.php';
//require_once __DIR__ . '/../entities/Category.php';
require_once __DIR__ . '/../entities/VolunteerMatch.php';

class PINViewVolunteerMatchController {
    private $matchEntity;
	private $requestEntity;

    public function __construct() {
        // Controller creates its own entity
        $this->matchEntity = new VolunteerMatch();
		//$this->requestEntity = new Request();
    }
	
	public function GetMatch($pinID,$rID) {
		return $this->matchEntity->getMatch($pinID,$rID);
	}
	
	/*public function GetRequestByID($rID) {
        return $this->requestEntity->getRequestByID($rID);
    }*/
}
?>