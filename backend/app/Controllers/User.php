<?php

namespace App\Controllers;

class User extends \CodeIgniter\RESTful\ResourceController
{
  private $dataObj = null;
  private $usersInputObj = null;
  private $userModelLibraryObj = null;
  private $usersAdditionalDetailsModelLibraryObj = null;
  private $addressModelLibraryObj = null;

  public function __construct()
  {
    $this->dataObj = new \App\Libraries\DataLibrary();
    $this->usersInputObj = new \App\Libraries\UsersInputLibrary();
    $this->userModelLibraryObj = new \App\Libraries\UsersModelLibrary();
    $this->usersAdditionalDetailsModelLibraryObj = new \App\Libraries\UsersAdditionalDetailsModelLibrary();
    $this->addressModelLibraryObj = new \App\Libraries\AddressesModelLibrary();
  }

  public function create()
  {
    $get = $this->usersInputObj->getRegistrationInput();
    if (!$this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $user = $this->dataObj->getData($get, _USER);
    $user_additional_details = $this->dataObj->getData($get, _USER_ADDITIONAL_DETAILS);
    $address = $this->dataObj->getData($get, _ADDRESS);

    $get = $this->userModelLibraryObj->isUserAlreadyExists($user[_EMAIL]);
    if ($this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $user_additional_details[_ADDRESS_ID] = $this->addressModelLibraryObj->insertionAddress($address);
    $user[_USER_ADDITIONAL_DETAILS_ID] = $this->usersAdditionalDetailsModelLibraryObj->insertionUserAdditionalDetails(($user_additional_details));

    $get = $this->userModelLibraryObj->insertionUser($user);

    return $this->dataObj->getResponse($get);
  }
}
