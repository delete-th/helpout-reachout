<?php
// controllers/PlatformManagerDeleteCategoryController.php
require_once __DIR__ . '/../entities/Category.php';

class PlatformManagerDeleteCategoryController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    public function DeleteCategory($cID) {
        return $this->entity->deleteCategory($cID);
    }
}
?>
