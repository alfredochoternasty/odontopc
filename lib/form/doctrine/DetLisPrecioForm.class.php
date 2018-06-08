<?php

/**
 * DetLisPrecio form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetLisPrecioForm extends BaseDetLisPrecioForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['lista_id'] = new sfWidgetFormInputHidden();
    
    $choices = ProductoTable::getArrayActivos();
    $this->widgetSchema['producto_id'] = new sfWidgetFormChoice(array('choices' => $choices), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));        
  }
}
