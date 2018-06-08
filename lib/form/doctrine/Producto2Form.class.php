<?php

/**
 * Producto2 form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Producto2Form extends BaseProducto2Form
{
  public function configure()
  {
    $this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => false, 'order_by' => array('nombre', 'asc')));    
  }
}
