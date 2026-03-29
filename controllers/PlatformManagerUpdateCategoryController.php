<?php
// controllers/PlatformManagerUpdateCategoryController.php
require_once __DIR__ . '/../entities/Category.php';

class PlatformManagerUpdateCategoryController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    // Get a category by its ID
    public function GetCategoryByCID($cID) {
        return $this->entity->getCategoryByCID($cID);
    }

    // Update a category's name
    public function UpdateCategory($cID, $category) {
        return $this->entity->updateCategory($cID, $category);
    }
}
?>
