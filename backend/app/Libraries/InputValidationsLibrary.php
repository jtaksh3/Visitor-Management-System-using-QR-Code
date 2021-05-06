<?php namespace App\Libraries;

class InputValidationsLibrary
{

  public function __construct()
  {
    helper('custom_validation');
  }

  public function isInputEmpty($input, $value)
  {
    if(empty($input[$value]))
    {
      return true;
    }
    return false;
  }

  public function isEmptyArray($input, $value)
  {
    if(empty($input[$value][0]))
    {
      return true;
    }
    return false;    
  }

  public function getInput($input, $value)
  {
    if(empty($input[$value]))
    {
      return null;
    }
    return is_entered($input[$value]);
  }
  
}

