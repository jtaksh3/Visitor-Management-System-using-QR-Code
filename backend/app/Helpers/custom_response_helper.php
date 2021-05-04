<?php

if (! function_exists('custom_response_output'))
{
  function custom_response_output($message, $data = null)
  {
    return array(_MESSAGE_ => $message, _DATA => $data);
  }
}

if (! function_exists('custom_response_process'))
{
  function custom_response_process($status, $data = null, $response = null)
  {
    return array(_STATUS => $status, _DATA => $data, _RESPONSE => $response);
  }
}

