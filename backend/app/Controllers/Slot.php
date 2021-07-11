<?php

namespace App\Controllers;

class Slot extends \CodeIgniter\RESTful\ResourceController
{
  private $dataObj = null;
  private $slotsInputObj = null;
  private $slotModelLibraryObj = null;
  private $userModelLibraryObj = null;

  public function __construct()
  {
    $this->dataObj = new \App\Libraries\DataLibrary();
    $this->slotsInputObj = new \App\Libraries\SlotsInputLibrary();
    $this->slotModelLibraryObj = new \App\Libraries\SlotsModelLibrary();
    $this->userModelLibraryObj = new \App\Libraries\UsersModelLibrary();
  }

  public function create()
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $get = $this->userModelLibraryObj->isUserAuthorized($token);
    if(!$this->dataObj->getStatus($get))
    {
      return $this->dataObj->getResponse($get);
    }

    $get = $this->slotsInputObj->getSlotInput();
    if (!$this->dataObj->getStatus($get)) {
      return $this->dataObj->getResponse($get);
    }
    $slot = $this->dataObj->getData($get, _SLOT);

    $get = $this->slotModelLibraryObj->insertionSlot($slot);

    return $this->dataObj->getResponse($get);
  }
}
