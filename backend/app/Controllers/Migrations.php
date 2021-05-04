<?php namespace App\Controllers;

class Migrations extends \CodeIgniter\RESTful\ResourceController
{

  public function index()
  {
    $migrate = \Config\Services::migrations();
    // $seeder = \Config\Database::seeder();

    try
    {
      $migrate->latest();

      return $this->respond([_MESSAGE_ => _SUCCESS_]);
    }
    catch (\Exception $e)
    {
      return $this->fail(_FAILED_);
    }
  }

}

