<?php

/**
 * Pago form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PagoForm extends BasePagoForm
{
  public function configure()
  {
    parent::configure();
    
    $image_url = $this->getOption('image_url');
    
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['proveedor_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true, 'order_by' => array('razon_social', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['proveedor_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor')));    
    
    $this->widgetSchema['banco_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['banco_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'required' => false));
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['comprobante'] = new sfWidgetFormInputFileEditable(array(
                                      'label' => 'Comprobante Pago',
                                      'file_src' => $image_url,
                                      'is_image' => true,
                                      'edit_mode' => !empty($image_url)?true:false,
                                      'with_delete' => !empty($image_url)?true:false,
                                      'delete_label' => 'Borrar esta imagen?',
                                      'template' => '<div>%input%<br>%file%<br>%delete_label%&nbsp;%delete%</div>',
                                  ));
																	
    $this->validatorSchema['comprobante'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/pagos/',
    ));
  }
}
