<?php

class sfWidgetFormInputNumber extends sfWidgetFormInput
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    $this->setOption('type', 'number');
  }
}
