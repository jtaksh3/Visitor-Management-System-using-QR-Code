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
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 86400");
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

  public function update($slot_id = null) {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $get1 = $this->userModelLibraryObj->isAuthorizedAdmin($token);
    $get2 = $this->userModelLibraryObj->isAuthorizedHost($token);

    if($this->dataObj->getStatus($get1) || $this->dataObj->getStatus($get2))
    {
      $get = $this->slotsInputObj->getSlotStatusInput();
      if (!$this->dataObj->getStatus($get)) {
        return $this->dataObj->getResponse($get);
      }
      $status = $this->dataObj->getData($get, _STATUS);

      $get = $this->slotModelLibraryObj->updationSlot($slot_id, $status);

      return $this->dataObj->getResponse($get);
    }

    return $this->dataObj->getResponse($get1);
  }

  public function index()
  {
    $token = $this->request->getHeaderLine(_AUTHORIZATION);
    $query = $this->dataObj->getQueryData();
    $get1 = $this->userModelLibraryObj->isAuthorizedAdmin($token);
    $get2 = $this->userModelLibraryObj->isAuthorizedHost($token);
    $get3 = $this->userModelLibraryObj->isUserAuthorized($token);
    if($this->dataObj->getStatus($get1))
    {
      $get = $this->slotModelLibraryObj->getAllSlots($query[_STATUS]);

      return $this->dataObj->getResponse($get);
    }
    if($this->dataObj->getStatus($get2))
    {
      $get = $this->slotModelLibraryObj->getAllHostSlots($query[_ID], $query[_STATUS]);

      return $this->dataObj->getResponse($get);
    }
    if($this->dataObj->getStatus($get3))
    {
      $get = $this->slotModelLibraryObj->getAllVisitorSlots($query[_ID], $query[_STATUS]);

      return $this->dataObj->getResponse($get);
    }

    return $this->dataObj->getResponse($get1);
  }

}
