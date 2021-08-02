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
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Max-Age: 86400");
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

  public function login()
  {
    $get = $this->usersInputObj->getLoginInput();
    if (!$this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $email = $this->dataObj->getData($get, _EMAIL);
    $password = $this->dataObj->getData($get, _PASSWORD);
    $get = $this->userModelLibraryObj->isCorrectCredentials($email, $password);
    if (!$this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $user_id = $this->dataObj->getData($get, _ID);
    $get = $this->userModelLibraryObj->loginUser($user_id);

    return $this->dataObj->getResponse($get);
  }

  public function isAuthorizedAdmin()
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $get = $this->userModelLibraryObj->isAuthorizedAdmin($token);

    return $this->dataObj->getResponse($get);
  }

  public function isAuthorizedHost()
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $get = $this->userModelLibraryObj->isAuthorizedHost($token);

    return $this->dataObj->getResponse($get);
  }

  public function isAuthorizedVisitor()
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $get = $this->userModelLibraryObj->isAuthorizedVisitor($token);

    return $this->dataObj->getResponse($get);
  }

  public function show($user_id = null)
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $get = $this->userModelLibraryObj->isUserAuthorized($token);
    if (!$this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $get = $this->userModelLibraryObj->getIndividualUser($user_id);

    return $this->dataObj->getResponse($get);
  }

  public function index()
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $query = $this->dataObj->getQueryData();
    $get = $this->userModelLibraryObj->isUserAuthorized($token);
    if (!$this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $get = $this->userModelLibraryObj->getAllUsers($query[_ROLE]);

    return $this->dataObj->getResponse($get);
  }

  public function image($user_id = null)
  {
    $get = $this->usersInputObj->getImageInput();
    if(!$this->dataObj->getStatus($get))
    {
      return $this->dataObj->getResponse($get);
    }
    $image = $this->dataObj->getData($get, _IMAGE);
    $get = $this->usersAdditionalDetailsModelLibraryObj->updationUser($image, $user_id);

    return $this->dataObj->getResponse($get);
  }
}
