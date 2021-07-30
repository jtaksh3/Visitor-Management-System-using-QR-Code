<?php

namespace App\Libraries;

class AuthenticationTokensModelLibrary
{
  protected $authenticationTokensModelObj = null;
  // private $usersModelLibraryObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->authenticationTokensModelObj = new \App\Models\AuthenticationTokensModel();
    // $this->usersModelLibraryObj = new UsersModelLibrary();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function generateToken($input)
  {
    return md5($input . time());
  }

  public function getAuthenticationTokenbyToken($token)
  {
    return $this->authenticationTokensModelObj->where(_TOKEN, $token)->first();
  }

  public function getAuthenticationTokenbyUserId($user_id, $email)
  {
    $auth = $this->authenticationTokensModelObj->where(_USER_ID, $user_id)->first();
    $update = [
      _TOKEN => $this->generateToken($email)
    ];
    $this->updateAuthenticationToken($auth[_ID], $update);

    return $this->authenticationTokensModelObj->find($auth[_ID]);
  }

  public function insertionAuthenticationToken($insert)
  {
    $insert[_TOKEN] = $this->generateToken($insert[_TOKEN]);

    return $this->authenticationTokensModelObj->insert($insert);
  }

  public function updateAuthenticationToken($authentication_token_id, $update)
  {
    $this->authenticationTokensModelObj->update($authentication_token_id, $update);
  }
}
