<?php
// controllers/PlatformManagerSearchCategoriesController.php
require_once __DIR__ . '/../entities/Category.php';

class PlatformManagerSearchCategoriesController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    public function SearchCategories($searchBy, $searchInput) {
        return $this->entity->searchCategories($searchBy, $searchInput);
    }
}
?>
