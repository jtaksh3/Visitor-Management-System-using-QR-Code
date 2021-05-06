<?php

namespace App\Libraries;

class UsersInputLibrary
{
  private $dataObj = null;
  private $validationObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->dataObj = new DataLibrary();
    $this->validationObj = new InputValidationsLibrary();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function getRegistrationInput()
  {
    $input = $this->dataObj->getInputData();
    if (
      $this->validationObj->isInputEmpty($input, _USER)
      || $this->validationObj->isInputEmpty($input[_USER], _USER_ADDITIONAL_DETAILS)
      || $this->validationObj->isInputEmpty($input[_USER][_USER_ADDITIONAL_DETAILS], _ADDRESS)
    ) {
      return custom_response_process(false, null, $this->responseObj->failResponse(_NO_INPUTS_));
    }
    $input = $input[_USER];
    $email = $this->validationObj->getInput($input, _EMAIL);
    $password = $this->validationObj->getInput($input, _PASSWORD);
    $role = $this->validationObj->getInput($input, _ROLE);
    $input = $input[_USER_ADDITIONAL_DETAILS];
    $full_name = $this->validationObj->getInput($input, _FULL_NAME);
    $designation = $this->validationObj->getInput($input, _DESIGNATION);
    $organization = $this->validationObj->getInput($input, _ORGANIZATION);
    $phone_no = $this->validationObj->getInput($input, _PHONE_NO);
    $input = $input[_ADDRESS];
    $address_line_1 = $this->validationObj->getInput($input, _ADDRESS_LINE_1);
    $address_line_2 = $this->validationObj->getInput($input, _ADDRESS_LINE_2);
    $address_line_3 = $this->validationObj->getInput($input, _ADDRESS_LINE_3);
    $city = $this->validationObj->getInput($input, _CITY);
    $state = $this->validationObj->getInput($input, _STATE);
    $country = $this->validationObj->getInput($input, _COUNTRY);
    $pincode = $this->validationObj->getInput($input, _PINCODE);
    if (
      !$email || !$password || !$role || !$full_name || !$designation || !$organization || !$phone_no
      || !$address_line_1 || !$city || !$state || !$country || !$pincode
    ) {
      return custom_response_process(false, null, $this->responseObj->failResponse(_MISSING_FIELDS_));
    }
    $user = [
      _EMAIL => $email,
      _PASSWORD => $password,
      _ROLE => $role
    ];
    $user_additonal_details = [
      _FULL_NAME => $full_name,
      _DESIGNATION => $designation,
      _ORGANIZATION => $organization,
      _PHONE_NO => $phone_no
    ];
    $address = [
      _ADDRESS_LINE_1 => $address_line_1,
      _ADDRESS_LINE_2 => $address_line_2,
      _ADDRESS_LINE_3 => $address_line_3,
      _CITY => $city,
      _STATE => $state,
      _COUNTRY => $country,
      _PINCODE => $pincode
    ];
    $data = [
      _USER => $user,
      _USER_ADDITIONAL_DETAILS => $user_additonal_details,
      _ADDRESS => $address
    ];
    return custom_response_process(true, $data, null);
  }

  //   public function getLoginInput($input, $value)
  //   {
  //     if($this->validationObj->isInputEmpty($input, $value))
  //     {
  //       return custom_response_process(false, null, $this->responseObj->failResponse(_NO_INPUTS_));
  //     }
  //     $input = $input[$value];
  //     $username = $this->validationObj->getInput($input, _EMAIL);
  //     $password = $this->validationObj->getInput($input, _PASSWORD);
  //     if(!$username || !$password)
  //     {
  //       return custom_response_process(false, null, $this->responseObj->failResponse(_MISSING_FIELDS_, $input));
  //     }
  //     return custom_response_process(true, [_USERNAME => $username, _PASSWORD => $password], null);
  //   }

}
