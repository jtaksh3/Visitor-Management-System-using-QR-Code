<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Hello extends ResourceController
{

  public function index()
  {
    return $this->respond('hello');
  }

}

