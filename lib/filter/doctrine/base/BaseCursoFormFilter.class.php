<?php

/**
 * Curso filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'    => new sfWidgetFormFilterInput(),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora'           => new sfWidgetFormFilterInput(),
      'lugar'          => new sfWidgetFormFilterInput(),
      'precio'         => new sfWidgetFormFilterInput(),
      'mostrar_precio' => new sfWidgetFormFilterInput(),
      'logo'           => new sfWidgetFormFilterInput(),
      'link_mapa'      => new sfWidgetFormFilterInput(),
      'sitio_web'      => new sfWidgetFormFilterInput(),
      'ini_insc'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fin_insc'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'     => new sfWidgetFormFilterInput(),
      'permite_insc'   => new sfWidgetFormFilterInput(),
      'foto1'          => new sfWidgetFormFilterInput(),
      'foto2'          => new sfWidgetFormFilterInput(),
      'foto3'          => new sfWidgetFormFilterInput(),
      'foto4'          => new sfWidgetFormFilterInput(),
      'cupo_max'       => new sfWidgetFormFilterInput(),
      'zona_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'         => new sfValidatorPass(array('required' => false)),
      'descripcion'    => new sfValidatorPass(array('required' => false)),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'hora'           => new sfValidatorPass(array('required' => false)),
      'lugar'          => new sfValidatorPass(array('required' => false)),
      'precio'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mostrar_precio' => new sfValidatorPass(array('required' => false)),
      'logo'           => new sfValidatorPass(array('required' => false)),
      'link_mapa'      => new sfValidatorPass(array('required' => false)),
      'sitio_web'      => new sfValidatorPass(array('required' => false)),
      'ini_insc'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fin_insc'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'habilitado'     => new sfValidatorPass(array('required' => false)),
      'permite_insc'   => new sfValidatorPass(array('required' => false)),
      'foto1'          => new sfValidatorPass(array('required' => false)),
      'foto2'          => new sfValidatorPass(array('required' => false)),
      'foto3'          => new sfValidatorPass(array('required' => false)),
      'foto4'          => new sfValidatorPass(array('required' => false)),
      'cupo_max'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'zona_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('curso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Curso';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'nombre'         => 'Text',
      'descripcion'    => 'Text',
      'fecha'          => 'Date',
      'hora'           => 'Text',
      'lugar'          => 'Text',
      'precio'         => 'Number',
      'mostrar_precio' => 'Text',
      'logo'           => 'Text',
      'link_mapa'      => 'Text',
      'sitio_web'      => 'Text',
      'ini_insc'       => 'Date',
      'fin_insc'       => 'Date',
      'habilitado'     => 'Text',
      'permite_insc'   => 'Text',
      'foto1'          => 'Text',
      'foto2'          => 'Text',
      'foto3'          => 'Text',
      'foto4'          => 'Text',
      'cupo_max'       => 'Number',
      'zona_id'        => 'ForeignKey',
    );
  }
}
