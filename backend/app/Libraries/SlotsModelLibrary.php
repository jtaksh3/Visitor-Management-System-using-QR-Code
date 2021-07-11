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

  public function getSlot($slot_id) {
    return $this->slotsModelObj->find($slot_id);
  }

  public function isSlotAlreadyExists($visitor_id)
  {
    $slotRecord = $this->slotsModelObj->where(_VISITOR_STATUS, _ACTIVE)->where(_HOST_STATUS, _ACTIVE)->where(_VISITOR_ID, $visitor_id)->find();
    if (!empty($slotRecord)) {
      return custom_response_process(true, null, $this->responseObj->alreadyExistsResponse(_SLOT . _ALREADY_EXISTS_));
    }
    return custom_response_process(false, null, null);
  }

  public function insertionSlot($insert)
  {
    $date = strtotime($insert[_MEETING_AT]);
    $insert[_MEETING_AT] = date('Y/m/d H:i:s', $date);
    $insert[_VISITOR_STATUS] = _ACTIVE;
    $slot_id = $this->slotsModelObj->insert($insert);

    $slot = $this->getSlot($slot_id);
    $data = [
        _SLOT => $slot,
    ];

    return custom_response_process(true, $data, $this->responseObj->createdResponse(_SLOT . _CREATED_SUCCESS_, $data));
  }
}
