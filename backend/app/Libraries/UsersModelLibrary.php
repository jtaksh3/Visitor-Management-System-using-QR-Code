<?php

namespace App\Libraries;

class UsersModelLibrary
{
  protected $usersModelObj = null;
  private $usersAdditionalDetailsModelLibraryObj = null;
  private $addressModelLibraryObj = null;
  private $authenticationTokensModelObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->usersModelObj = new \App\Models\UsersModel();
    $this->usersAdditionalDetailsModelLibraryObj = new UsersAdditionalDetailsModelLibrary();
    $this->addressModelLibraryObj = new AddressesModelLibrary();
    $this->authenticationTokensModelObj = new AuthenticationTokensModelLibrary();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function isAuthorizedAdmin($token)
  {
    $auth = $this->authenticationTokensModelObj->getAuthenticationTokenbyToken($token);

    if (empty($auth) || empty($token) || $this->getUser($auth[_USER_ID])[_ROLE] != _ADMIN) {
      return custom_response_process(false, null, $this->responseObj->unauthorizedResponse(_UNAUTHORIZED_));
    }

    return custom_response_process(true, null, $this->responseObj->successResponse(_AUTHORIZED_, null));
  }

  public function isAuthorizedHost($token)
  {
    $auth = $this->authenticationTokensModelObj->getAuthenticationTokenbyToken($token);

    if (empty($auth) || empty($token) || $this->getUser($auth[_USER_ID])[_ROLE] != _HOST) {
      return custom_response_process(false, null, $this->responseObj->unauthorizedResponse(_UNAUTHORIZED_));
    }

    return custom_response_process(true, null, $this->responseObj->successResponse(_AUTHORIZED_, null));
  }

  public function isAuthorizedVisitor($token)
  {
    $auth = $this->authenticationTokensModelObj->getAuthenticationTokenbyToken($token);

    if (empty($auth) || empty($token) || $this->getUser($auth[_USER_ID])[_ROLE] != _VISITOR) {
      return custom_response_process(false, null, $this->responseObj->unauthorizedResponse(_UNAUTHORIZED_));
    }

    return custom_response_process(true, null, $this->responseObj->successResponse(_AUTHORIZED_, null));
  }

  public function isUserAuthorized($token)
  {
    $auth = $this->authenticationTokensModelObj->getAuthenticationTokenbyToken($token);

    if (empty($auth) || empty($token)) {
      return custom_response_process(false, null, $this->responseObj->unauthorizedResponse(_UNAUTHORIZED_));
    }

    return custom_response_process(true, null, $this->responseObj->successResponse(_AUTHORIZED_, null));
  }

  public function isAuthorizedUser($user_id, $token)
  {
    $auth = $this->authenticationTokensModelObj->getAuthenticationTokenbyToken($token);

    if (empty($auth) || empty($user_id) || empty($token) || $user_id != $auth[_USER_ID]) {
      return custom_response_process(false, null, $this->responseObj->unauthorizedResponse(_UNAUTHORIZED_));
    }

    return custom_response_process(true, null, null);
  }

  public function isUserAlreadyExists($email)
  {
    $userRecord = $this->usersModelObj->where(_EMAIL, $email)->find();
    if (!empty($userRecord)) {
      return custom_response_process(true, null, $this->responseObj->alreadyExistsResponse(_USER . _ALREADY_EXISTS_));
    }
    return custom_response_process(false, null, null);
  }

  public function isUserExists($user_id)
  {
    $user = $this->usersModelObj->find($user_id);
    if (empty($user) || empty($user_id)) {
      return false;
    }
    return true;
  }

  public function getUser($user_id)
  {
    if (!$this->isUserExists($user_id)) {
      return false;
    }
    $user = $this->usersModelObj->find($user_id);
    unset($user[_PASSWORD]);

    return $user;
  }

  public function getIndividualUser($user_id)
  {
    $user = $this->getUser($user_id);
    if (empty($user) || empty($user_id)) {
      return custom_response_process(false, null, $this->responseObj->notFoundResponse(_USER . _NOT_EXISTS_));
    }

    $user[_USER_ADDITIONAL_DETAILS] = $this->usersAdditionalDetailsModelLibraryObj->getUserAdditionalDetails(($user[_USER_ADDITIONAL_DETAILS_ID]));
    $user[_USER_ADDITIONAL_DETAILS][_ADDRESS] = $this->addressModelLibraryObj->getAddress($user[_USER_ADDITIONAL_DETAILS][_ADDRESS_ID]);
    $data = [
      _USER => $user
    ];

    return custom_response_process(true, $data, $this->responseObj->successResponse(_USER_ID . ' ' . $user_id, $data));
  }

  public function getAllUsers($role)
  {
    $users = $this->usersModelObj->where(_ROLE, $role)->findAll();

    if (empty($users)) {
      return custom_response_process(false, null, $this->responseObj->notFoundResponse(_NOT_EXISTS_));
    }

    $i = 0;
    while (!empty($users[$i])) {
      unset($users[$i][_PASSWORD]);
      $users[$i][_USER_ADDITIONAL_DETAILS] = $this->usersAdditionalDetailsModelLibraryObj->getUserAdditionalDetails(($users[$i][_USER_ADDITIONAL_DETAILS_ID]));
      $users[$i][_USER_ADDITIONAL_DETAILS][_ADDRESS] = $this->addressModelLibraryObj->getAddress($users[$i][_USER_ADDITIONAL_DETAILS][_ADDRESS_ID]);
      $i++;
    }
    $data = [
      _USERS => $users
    ];
    return custom_response_process(true, $data, $this->responseObj->successResponse(_USERS, $data));
  }

  public function insertionUser($insert)
  {
    $insert[_PASSWORD] = password_hash($insert[_PASSWORD], PASSWORD_BCRYPT);
    $insert[_STATUS] = _ACTIVE;
    $user_id = $this->usersModelObj->insert($insert);

    $auth = [
      _USER_ID => $user_id,
      _TOKEN => $insert[_EMAIL]
    ];
    $this->authenticationTokensModelObj->insertionAuthenticationToken($auth);

    $get = $this->getIndividualUser($user_id);
    $data = $get[_DATA];

    return custom_response_process(true, $data, $this->responseObj->createdResponse(_USER . _CREATED_SUCCESS_, $data));
  }

  public function isCorrectCredentials($email, $password)
  {
    $user = $this->usersModelObj->select([_ID, _PASSWORD])->where(_STATUS, _ACTIVE)->where(_EMAIL, $email)->first();
    if (empty($user) || !password_verify($password, $user[_PASSWORD])) {
      return custom_response_process(false, null, $this->responseObj->unauthorizedResponse(_INCORRECT_CREDENTIALS_));
    }
    $data = [
      _ID => $user[_ID]
    ];
    return custom_response_process(true, $data, null);
  }

  public function loginUser($user_id)
  {
    $get = $this->getIndividualUser($user_id);
    $data = $get[_DATA];
    $data[_USER][_TOKEN] = $this->authenticationTokensModelObj->getAuthenticationTokenbyUserId($user_id, $data[_USER][_EMAIL]);

    return custom_response_process(true, $data, $this->responseObj->successResponse(_LOGIN_SUCCESS_, $data));
  }
}
