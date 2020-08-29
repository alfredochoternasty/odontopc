<?php

/**
 * Grupoprod form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoprodForm extends BaseGrupoprodForm
{
  public function configure()
  {
    $productos = $this->getOption('productos');
    $base_url = $this->getOption('base_url');
    
    $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array(), array('size' => 50, 'style' => 'font-size:16pt;'));
    
    $this->widgetSchema['operacion'] = new sfWidgetFormChoice(array('choices' => array('' => 'Seleccione una Opcion', 'precio' => 'Precio Fijo', 'aumento' => 'Aumentar un % sobre el valor actual', 'descuento' => 'Disminuir un % sobre el valor actual')));
    $this->widgetSchema['precio_vta'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('style' =>'font-weight: bold; font-size:16px; color:#FF0000'));
    $this->widgetSchema['porcentaje'] = new sfWidgetFormInput(array(), array('style' =>'font-weight: bold; font-size:16px; color:#FF0000'));
    $this->widgetSchema['productos'] = new sfWidgetFormChoice(array('expanded' => true, 'multiple' => true, 'choices' => $productos));
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
    $this->validatorSchema->setOption('allow_extra_fields', true);
  }
}
