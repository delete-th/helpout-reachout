<?php
// controllers/PlatformManagerCreateCategoryController.php
require_once __DIR__ . '/../entities/Category.php';

class PlatformManagerCreateCategoryController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }
	
    public function CreateCategory($category) {
        $result = $this->entity->createCategory($category);

        return $result;
    }
}
