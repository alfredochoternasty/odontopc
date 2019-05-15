<?php

/**
 * Proveedor form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProveedorForm extends BaseProveedorForm
{
  public function configure()
  {
    parent::configure();
		
    $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
  }
}
