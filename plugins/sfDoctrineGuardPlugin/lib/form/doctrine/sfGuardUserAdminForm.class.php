<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
		unset($this['groups_list']);
	  $this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona')));
	  $this->widgetSchema['usuario_zona'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => $this->getRelatedModelName('Zona'), 'expanded' => true), array('size' => '20'));
    $this->validatorSchema['usuario_zona'] = new sfValidatorChoice(array('choices' => array(1,2,3,4), 'multiple' => true, 'required' => false));    
	  $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'expanded' => true), array('size' => '20'));
    $this->validatorSchema->setOption('allow_extra_fields', true);
  }
	
	public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['usuario_zona']))
    {
      $this->setDefault('usuario_zona', $this->object->UsuarioZona->getPrimaryKeys());
    }
  }

  protected function doSave($con = null)
  {
    $this->saveUsuariosZonas($con);
    parent::doSave($con);
  }

  public function saveUsuariosZonas($con = null)
  {
    if (!$this->isValid()) throw $this->getErrorSchema();
    if (!isset($this->widgetSchema['usuario_zona'])) return;
    if (null === $con) $con = $this->getConnection();

    $existing = $this->object->UsuarioZona->getPrimaryKeys();
    $values = $this->getValue('usuario_zona');
    if (!is_array($values)) $values = array();

    $unlink = array_diff($existing, $values);
    if (count($unlink)) $this->object->unlink('UsuarioZona', array_values($unlink));

    $link = array_diff($values, $existing);
    if (count($link)) $this->object->link('UsuarioZona', array_values($link));
  }

}
