<?php namespace App\Libraries;

use CodeIgniter\API\ResponseTrait;

class CustomResponsesLibrary
{
  use ResponseTrait;
  protected $response = null;

  public function __construct()
  {
    $this->response = service('Response');
    $this->response->setContentType(_CONTENT_TYPE);
    helper('custom_response');
  }

  public function unauthorizedResponse($message)
  {
    return $this->failUnauthorized($message);
  }

  public function failResponse($message, $data = null)
  {
    return $this->fail(custom_response_output($message, $data));
  }

  public function createdResponse($message, $data)
  {
    return $this->respondCreated(custom_response_output($message, $data));
  }

  public function successResponse($message, $data)
  {
    return $this->respond(custom_response_output($message, $data));
  }

  public function deletedResponse($message, $data)
  {
    return $this->respondDeleted(custom_response_output($message, $data));
  }

  public function AlreadyExistsResponse($message)
  {
    return $this->failResourceExists($message);
  }

}

