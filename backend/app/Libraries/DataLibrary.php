<?php namespace App\Libraries;

class DataLibrary
{
  protected $request = null;

  public function __construct()
  {
    $this->request = service('Request');
  }

  public function getInputData()
  {
    return json_decode(file_get_contents('php://input'),true);
  }

  public function getGetData()
  {
    return $this->request->getGet();
  }

  public function getPostData()
  {
    return $this->request->getPost();
  }

  public function getFile($input)
  {
    return $this->request->getFile($input);
  }

  public function getStatus($get)
  {
  	return $get[_STATUS];
  }

  public function getResponse($get)
  {
  	return $get[_RESPONSE];
  }

  public function getData($get, $input)
  {
  	return $get[_DATA][$input];
  }

}

