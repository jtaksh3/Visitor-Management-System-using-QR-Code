<?php

if (! function_exists('is_entered'))
{
  function is_entered($input)
  {
    if(empty(trim($input)))
    {
      return null;
    }
    return trim($input);
  }
}

if (! function_exists('if_null'))
{
  function if_null($input, $value)
  {
    if(empty($input))
    {
      return $value;
    }
    return $input;
  }
}

