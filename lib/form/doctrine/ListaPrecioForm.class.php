<?php

/**
 * ListaPrecio form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaPrecioForm extends BaseListaPrecioForm
{
  public function configure()
  {
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->widgetSchema['defecto'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    
    $this->validatorSchema['nombre'] = new sfValidatorString(array('required' => true)); 
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => true, 'choices' => array('', 1, 0)));    
    $this->validatorSchema['defecto'] = new sfValidatorChoice(array('required' => true, 'choices' => array('', 1, 0)));    
    
    $this->setDefault('activo', '1');
    $this->setDefault('defecto', 0);
  }
}
