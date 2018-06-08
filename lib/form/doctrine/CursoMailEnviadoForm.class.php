<?php

/**
 * CursoMailEnviado form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoMailEnviadoForm extends BaseCursoMailEnviadoForm
{
  public function configure()
  {
    $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));    
    $this->widgetSchema['e_mail'] = new sfWidgetFormTextarea();
    $this->setDefault('fecha', date("Y-m-d"));
  }
}
