<?php

class sfValidatorEmail extends sfValidatorRegex
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', '"%value%" no es un email.');
  }
  
  protected function doClean($value)
  {
    $clean = trim($value);
    if (!filter_var($clean, FILTER_VALIDATE_EMAIL)) throw new sfValidatorError($this, 'invalid', array('value' => $clean));
    return $clean;
  }
}
