<?php

namespace App\Libraries;

class UsersAdditionalDetailsModelLibrary
{
  protected $usersAdditionalDetailsModelObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->usersAdditionalDetailsModelObj = new \App\Models\UsersAdditionalDetailsModel();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function getUserAdditionalDetails($user_additional_details_id)
  {
    return $this->usersAdditionalDetailsModelObj->find($user_additional_details_id);
  }

  public function insertionUserAdditionalDetails($insert)
  {
    $insert[_STATUS] = _ACTIVE;

    return $this->usersAdditionalDetailsModelObj->insert($insert);
  }
}
