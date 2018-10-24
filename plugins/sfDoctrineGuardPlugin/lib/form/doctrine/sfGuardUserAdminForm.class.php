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
	  $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission'), array('size' => '20'));
	  $this->widgetSchema['groups_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup'), array('size' => '10'));
  }
}
