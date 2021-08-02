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

  public function updationUser($image, $user_id)
  {
    $image_name = $image->getRandomName();
    $image_file = imagecreatefromjpeg($image);
    $image_location = _FILE_DESTINATION . $image_name;
    imagejpeg($image_file, $image_location, 75);

    $update = [
      _IMAGE_LOCATION => $image_location
    ];
    $this->usersAdditionalDetailsModelObj->update($user_id, $update);

    return custom_response_process(true, null, $this->responseObj->successResponse(_USER_ADDITIONAL_DETAILS . _UPDATED_SUCCESS_, null));
  }
}
