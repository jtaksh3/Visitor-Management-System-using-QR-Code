<?php

namespace App\Libraries;

class SlotsInputLibrary
{
    private $dataObj = null;
    private $validationObj = null;
    private $responseObj = null;

    public function __construct()
    {
        $this->dataObj = new DataLibrary();
        $this->validationObj = new InputValidationsLibrary();
        $this->responseObj = new CustomResponsesLibrary();
        helper('custom_response');
    }

    public function getSlotInput()
    {
        $input = $this->dataObj->getInputData();
        if (
            $this->validationObj->isInputEmpty($input, _SLOT)
        ) {
            return custom_response_process(false, null, $this->responseObj->failResponse(_NO_INPUTS_));
        }
        $input = $input[_SLOT];
        $visitor_id = $this->validationObj->getInput($input, _VISITOR_ID);
        $host_id = $this->validationObj->getInput($input, _HOST_ID);
        $meeting_at = $this->validationObj->getInput($input, _MEETING_AT);
        if (
            !$visitor_id || !$host_id || !$meeting_at) {
            return custom_response_process(false, null, $this->responseObj->failResponse(_MISSING_FIELDS_));
        }
        $slot = [
            _VISITOR_ID => $visitor_id,
            _HOST_ID => $host_id,
            _MEETING_AT => $meeting_at
        ];
        $data = [
            _SLOT => $slot
        ];
        return custom_response_process(true, $data, null);
    }
}
