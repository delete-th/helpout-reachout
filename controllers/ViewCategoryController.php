
<?php
 // controllers/ViewCategoryController.php
 require_once __DIR__ . '/../entities/Category.php';
 
 class ViewCategoryController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    public function GetCategories() {
        return $this->entity->getCategories();
    }
	
	public function GetCategoryByID($cID) {
        return $this->entity->getCategoryByID($cID);
    }
	
	public function GetCategoryByType($category) {
		return $this->entity->getCategoryByType($category);
	}
}
 
 ?>