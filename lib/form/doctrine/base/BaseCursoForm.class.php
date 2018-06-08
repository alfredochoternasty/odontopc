<?php

/**
 * Curso form base class.
 *
 * @method Curso getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'nombre'         => new sfWidgetFormInputText(),
      'descripcion'    => new sfWidgetFormTextarea(),
      'fecha'          => new sfWidgetFormDate(),
      'hora'           => new sfWidgetFormInputText(),
      'lugar'          => new sfWidgetFormInputText(),
      'precio'         => new sfWidgetFormInputText(),
      'mostrar_precio' => new sfWidgetFormInputText(),
      'logo'           => new sfWidgetFormInputText(),
      'link_mapa'      => new sfWidgetFormTextarea(),
      'sitio_web'      => new sfWidgetFormInputText(),
      'ini_insc'       => new sfWidgetFormDate(),
      'fin_insc'       => new sfWidgetFormDate(),
      'habilitado'     => new sfWidgetFormInputText(),
      'permite_insc'   => new sfWidgetFormInputText(),
      'foto1'          => new sfWidgetFormInputText(),
      'foto2'          => new sfWidgetFormInputText(),
      'foto3'          => new sfWidgetFormInputText(),
      'foto4'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 100)),
      'descripcion'    => new sfValidatorString(array('required' => false)),
      'fecha'          => new sfValidatorDate(),
      'hora'           => new sfValidatorString(array('max_length' => 5)),
      'lugar'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'precio'         => new sfValidatorNumber(array('required' => false)),
      'mostrar_precio' => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'logo'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link_mapa'      => new sfValidatorString(array('required' => false)),
      'sitio_web'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ini_insc'       => new sfValidatorDate(),
      'fin_insc'       => new sfValidatorDate(),
      'habilitado'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'permite_insc'   => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'foto1'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'foto2'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'foto3'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'foto4'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Curso';
  }

}
