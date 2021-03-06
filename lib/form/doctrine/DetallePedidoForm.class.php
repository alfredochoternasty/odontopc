<?php

/**
 * DetallePedido form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetallePedidoForm extends BaseDetallePedidoForm
{
  public function configure()
  {
    parent::configure();
    
    $es_cliente = $this->getOption('es_cliente');
    if ($es_cliente) {
        unset($this['nro_lote']);
    } else {
        $q = Doctrine_Query::create()
          ->select('l.nro_lote, l.fecha_vto, l.stock')
          ->from('Lote l')
          ->where('l.producto_id = '.$this->getObject()->getProductoId())
          ->andWhere('l.stock > 0 ')
          ->andWhere("l.nro_lote not like 'er%'")
          ->andWhere('l.zona_id = 1 ')
          ->andWhere('l.fecha_vto is null or l.fecha_vto > '.date('Y-m-d'))
          ->orderBy('l.fecha_vto asc');
        $lotes = $q->fetchArray();
        $choices2 = array("" => "");
        foreach($lotes as $lote){
          $choices2[$lote['nro_lote']] = $lote['nro_lote'].' - Vto: '.implode('/', array_reverse(explode('-', $lote['fecha_vto']))).' - Stock: '.$lote['stock'];  
        }

        if(!$this->isNew()) {
          $this->widgetSchema['nro_lote'] = new sfWidgetFormChoice(array('choices' => $choices2));
          $this->validatorSchema['nro_lote'] =  new sfValidatorString(array('required' => true));
        }    
    }
    
    $this->widgetSchema['pedido_id'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));

    $this->widgetSchema['precio'] = new sfWidgetFormInput(array(), array('size' => 10, 'readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('size' => 10, 'readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    
    $this->widgetSchema['cantidad'] = new sfWidgetFormInput(array(), array('size' => 5));
    $this->validatorSchema['cantidad'] =  new sfValidatorNumber(array('required' => true));
    
    $this->validatorSchema['nro_lote'] =  new sfValidatorString(array('required' => false));
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();  
    
  }
}
