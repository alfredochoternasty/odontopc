<?php

/**
 * CursoInscripcion form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoInscripcionForm extends BaseCursoInscripcionForm
{
  public function configure()
  {
    unset(
        $this['tipo_insc_id'], 
        $this['cliente_id'], 
        $this['es_cliente'], 
        $this['asistio'], 
        $this['pago'], 
        $this['mas_info'], 
        $this['compro'], 
        $this['observacion']
    );
    
		$curso_id = $this->getOption('curso_id');
		$zona_id = $this->getOption('curso_id');
    
    $this->setDefault('curso_id', $curso_id);
    $this->setDefault('fecha', date('Y-m-d'));
    
    // $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array('public_key' => 'CLAVE_PUBLICA_DE_RECAPTCHA'));
    $this->widgetSchema['fecha'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['curso_id'] = new sfWidgetFormInputHidden();
    // $this->widgetSchema['curso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true, 'order_by' => array('nombre', 'asc'), 'method' => 'getLocConProvincia', 'table_method' => 'retrieveConJoins'), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->widgetSchema['dni'] = new sfWidgetFormInputNumber(array(), array('size' => 30));
    $this->validatorSchema['dni'] =  new sfValidatorNumber();
    $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['localidad'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['telefono'] = new sfWidgetFormInputNumber(array(), array('size' => 30));
    $this->validatorSchema['telefono'] =  new sfValidatorNumber();
    $this->widgetSchema['correo'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['comentario'] = new sfWidgetFormTextarea(array(), array('cols' => 29, 'rows' => 5));
    
  }
}
