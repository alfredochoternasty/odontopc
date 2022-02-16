<?php

/**
 * Curso form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoForm extends BaseCursoForm
{
  public function configure()
  {
    unset($this['sitio_web']);
	
    $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array(), array('size' => 100));
    $this->widgetSchema['lugar'] = new sfWidgetFormInputText(array(), array('size' => 100));
	
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));

    $this->widgetSchema['ini_insc'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['ini_insc'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));

    $this->widgetSchema['fin_insc'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fin_insc'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['habilitado'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));    
    $this->widgetSchema['permite_insc'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));
    $this->widgetSchema['mostrar_precio'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));
    
    $ruta = sfConfig::get('sf_upload_dir').'/cursos/';
    $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array(
                                      'label' => ' ',
                                      'file_src' => $ruta.$this->getObject()->getLogo(),
                                      'is_image' => true,
                                      'edit_mode' => true,
                                      'template' => '<div>%input%<br>%file%</div>',
                                  ));
    $this->validatorSchema['logo'] = new sfValidatorFile(array('mime_types' => 'web_images','path' => sfConfig::get('sf_upload_dir').'/cursos/','required' => false));
        
    $this->widgetSchema['foto1'] = new sfWidgetFormInputFile();
    $this->validatorSchema['foto1'] = new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/cursos','required' => false,));
    
    $this->widgetSchema['foto2'] = new sfWidgetFormInputFile();
    $this->validatorSchema['foto2'] = new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/cursos','required' => false,));
    
    $this->widgetSchema['foto3'] = new sfWidgetFormInputFile();
    $this->validatorSchema['foto3'] = new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/cursos','required' => false,));
    
    $this->widgetSchema['foto4'] = new sfWidgetFormInputFile();
    $this->validatorSchema['foto4'] = new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/cursos','required' => false,));
  }
}
