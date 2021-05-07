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

  public function generateToken($input) {
    return password_hash($input . time(), PASSWORD_BCRYPT);
  }

  public function getAuthenticationToken($user_id, $email)
  {
    $authentication_token_id = $this->authenticationTokensModelObj->select([_ID])->where(_USER_ID, $user_id)->first();
    $update = [ 
      _TOKEN => $this->generateToken($email)
    ];
    $this->updateAuthenticationToken($authentication_token_id, $update);

    return $this->authenticationTokensModelObj->find($authentication_token_id);
  }

  public function insertionAuthenticationToken($insert)
  {
    $insert[_TOKEN] = $this->generateToken($insert[_TOKEN]);

    return $this->authenticationTokensModelObj->insert($insert);
  }

  public function updateAuthenticationToken($authentication_token_id, $update) {
    $this->authenticationTokensModelObj->update($authentication_token_id, $update);
  }
}
