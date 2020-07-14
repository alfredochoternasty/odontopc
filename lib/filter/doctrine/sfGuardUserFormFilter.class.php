<?php

/**
 * sfGuardUser filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserFormFilter extends BasesfGuardUserFormFilter
{
  public function configure()
  {
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    
    $this->widgetSchema['es_cliente'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['es_cliente'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));        
  }
}
