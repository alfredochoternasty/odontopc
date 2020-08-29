<?php

/**
 * Producto form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoForm extends BaseProductoForm
{
  public function configure()
  {
    parent::configure();
    unset($this['mueve_stock'], $this['moneda_id'], $this['genera_comision'], $this['stock_actual'], $this['ctr_fact_grupo'], $this['grupo2'], $this['grupo3'], $this['descripcion']);
    $base_url = $this->getOption('base_url');
    $modulo_factura = $this->getOption('modulo_factura');
        
    $this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => false, 'order_by' => array('nombre', 'asc')));    
    
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));

    $this->widgetSchema['foto'] = new sfWidgetFormInputFileEditable(array(
                                      'label' => ' ',
                                      'file_src' => $base_url.'/uploads/productos/'.$this->getObject()->getFotoChica(),
                                      'is_image' => true,
                                      'edit_mode' => true,
                                      'with_delete' => true,
                                      'delete_label' => 'Borrar esta imagen?',
                                      'template' => '<div>%input%<br>%file%<br>%delete_label%&nbsp;%delete%</div>',
                                  ));
                                  
    $ruta = sfConfig::get('sf_upload_dir').'/productos/';
    $this->validatorSchema['foto'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => $ruta,
      'mime_types' => 'web_images',
    ));
    
    if ($modulo_factura == 'S') {
      $this->widgetSchema['precio_vta'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
      $this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
      $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('style' =>'font-weight: bold; font-size:16px; color:#FF0000'));
      $this->validatorSchema->setOption('allow_extra_fields', true);
    } else {
      unset($this['iva'], $this['total']);
      $this->widgetSchema['precio_vta'] = new sfWidgetFormInput();
    }
    
    $this->widgetSchema['foto_chica'] = new sfWidgetFormInputHidden();
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
  }
}
