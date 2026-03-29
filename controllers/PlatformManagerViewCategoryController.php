<?php
// controllers/PlatformManagerViewCategoryController.php

require_once __DIR__ . '/../entities/Category.php';

class PlatformManagerViewCategoryController {
    
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }


    public function GetAllCategories() {
        $completedMatchesByCSRID = $this->entity->getCategories();

        return $completedMatchesByCSRID;
    }

    public function GetCategoryByCID($cID) {
        $completedMatchByMID = $this->entity->getCategoryByCID($cID);

        return $completedMatchByMID;
    }
	
}
?>
