<?php

namespace App\Libraries;

class AuthenticationTokensModelLibrary
{
  protected $authenticationTokensModelObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->authenticationTokensModelObj = new \App\Models\AuthenticationTokensModel();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function getAuthenticationToken($user_id)
  {
    return $this->authenticationTokensModelObj->where(_USER_ID, $user_id)->first();
  }

  public function insertionAuthenticationToken($insert)
  {
    $insert[_TOKEN] = password_hash($insert[_TOKEN], PASSWORD_BCRYPT);

    return $this->authenticationTokensModelObj->insert($insert);
  }
}
