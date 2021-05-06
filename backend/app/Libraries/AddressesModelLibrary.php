<?php

namespace App\Libraries;

class AddressesModelLibrary
{
  protected $usersAdditionalDetailsModelObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->addressModelObj = new \App\Models\AddressesModel();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function getAddress($address_id)
  {
    return $this->addressModelObj->find($address_id);
  }

  public function insertionAddress($insert)
  {
    $insert[_STATUS] = _ACTIVE;

    return $this->addressModelObj->insert($insert);
  }
}

