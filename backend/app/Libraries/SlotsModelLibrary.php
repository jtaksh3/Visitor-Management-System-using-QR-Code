<?php

namespace App\Libraries;

class SlotsModelLibrary
{
  protected $slotsModelObj = null;
  private $responseObj = null;

  public function __construct()
  {
    $this->slotsModelObj = new \App\Models\SlotsModel();
    $this->responseObj = new CustomResponsesLibrary();
    helper('custom_response');
  }

  public function getSlot($slot_id)
  {
    return $this->slotsModelObj->find($slot_id);
  }

  public function getAllSlots($status)
  {

    if ($status == "all") {
      $slots = $this->slotsModelObj->findAll();
    } else {
      $slots = $this->slotsModelObj->where(_STATUS, $status)->findAll();
    }

    if (empty($slots)) {
      return custom_response_process(false, null, $this->responseObj->notFoundResponse(_SLOTS . _NOT_EXISTS_));
    }

    $data = [
      _SLOTS => $slots
    ];
    return custom_response_process(true, $data, $this->responseObj->successResponse(_SLOTS, $data));
  }

  public function getAllHostSlots($host_id, $status)
  {
    if ($status == "all") {
      $slots = $this->slotsModelObj->where(_HOST_ID, $host_id)->findAll();
    } else {
      $slots = $this->slotsModelObj->where(_HOST_ID, $host_id)->where(_STATUS, $status)->findAll();
    }

    if (empty($slots) || empty($host_id)) {
      return custom_response_process(false, null, $this->responseObj->notFoundResponse(_SLOTS . _NOT_EXISTS_));
    }

    $data = [
      _SLOTS => $slots
    ];
    return custom_response_process(true, $data, $this->responseObj->successResponse(_SLOTS, $data));
  }

  public function getAllVisitorSlots($visitor_id, $status)
  {
    if ($status == "all") {
      $slots = $this->slotsModelObj->where(_VISITOR_ID, $visitor_id)->findAll();
    } else {
      $slots = $this->slotsModelObj->where(_VISITOR_ID, $visitor_id)->where(_STATUS, $status)->findAll();
    }

    if (empty($slots) || empty($visitor_id)) {
      return custom_response_process(false, null, $this->responseObj->notFoundResponse(_SLOTS . _NOT_EXISTS_));
    }

    $data = [
      _SLOTS => $slots
    ];
    return custom_response_process(true, $data, $this->responseObj->successResponse(_SLOTS, $data));
  }

  public function isSlotAlreadyExists($visitor_id)
  {
    $slotRecord = $this->slotsModelObj->where(_STATUS, _ACTIVE)->where(_VISITOR_ID, $visitor_id)->find();
    if (!empty($slotRecord)) {
      return custom_response_process(true, null, $this->responseObj->alreadyExistsResponse(_SLOT . _ALREADY_EXISTS_));
    }
    return custom_response_process(false, null, null);
  }

  public function insertionSlot($insert)
  {
    $date = strtotime($insert[_MEETING_AT]);
    $insert[_MEETING_AT] = date('Y/m/d H:i:s', $date);
    $insert[_STATUS] = _PENDING;
    $slot_id = $this->slotsModelObj->insert($insert);

    $slot = $this->getSlot($slot_id);
    $data = [
      _SLOT => $slot,
    ];

    return custom_response_process(true, $data, $this->responseObj->createdResponse(_SLOT . _CREATED_SUCCESS_, $data));
  }

  public function updationSlot($slot_id, $status)
  {
    $update = [
      _STATUS => $status
    ];
    $this->slotsModelObj->update($slot_id, $update);

    $slot = $this->getSlot($slot_id);
    $data = [
      _SLOT => $slot,
    ];

    return custom_response_process(true, $data, $this->responseObj->successResponse(_SLOT . _UPDATED_SUCCESS_, $data));
  }
}
