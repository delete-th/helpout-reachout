<?php
// controllers/UpdateUserAccountController.php
require_once __DIR__ . '/../entities/UserAccount.php';

class UpdateUserAccountController {
    private $entity;

    public function __construct() {
        $this->entity = new UserAccount();
    }

    public function GetUserAccountByID($aID) {
        return $this->entity->getUserAccountByID($aID);
    }

    public function UpdateUserAccount($aID, $name, $password, $phoneNumber, $address, $dob, $userProfile, $status) {
        return $this->entity->updateUserAccount($aID, $name, $password, $phoneNumber, $address, $dob, $userProfile, $status);
    }
}
?>
