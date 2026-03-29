<?php
// controllers/SearchUserAccountsController.php
require_once __DIR__ . '/../entities/UserAccount.php';

class SearchUserAccountsController {
    private $entity;

    public function __construct() {
        $this->entity = new UserAccount();
    }

    // Only handle searching
    public function SearchUserAccounts($searchBy, $searchInput) {
        return $this->entity->searchUserAccounts($searchBy, $searchInput);
    }
}
?>