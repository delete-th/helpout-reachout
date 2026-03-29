
<?php
require_once __DIR__ . '/../entities/Request.php';
require_once __DIR__ . '/../entities/Category.php';

class PINUpdateRequestController {
    private $requestEntity;
	private $categoryEntity;

    public function __construct() {
        $this->requestEntity = new Request();
		$this->categoryEntity = new Category();
    }

    public function GetRequestByID($rID) {
        return $this->requestEntity->getRequestByID($rID);
    }
	
    public function UpdateRequest($rID, $pinID, $cID, $description, $formattedDate, $location, $priority, $status) {
		
       return $this->requestEntity->updateRequest($rID, $pinID, $cID, $description, $formattedDate, $location, $priority, $status);
    }
	
	public function GetCategories() {
		return $this->categoryEntity->getCategories();
	}
}
?>