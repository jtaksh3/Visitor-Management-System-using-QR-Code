<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Hello extends ResourceController
{

  public function __construct()
  {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  }

  public function index()
  {
    return $this->respond('hello');
  }
}
