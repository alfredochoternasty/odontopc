<?php

require_once dirname(__FILE__).'/../lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfAdminThemejRollerPlugin');
    $this->enablePlugins('sfJQueryUIPlugin');
    $this->enablePlugins('acDompdfPlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
    $this->enablePlugins('sfJPGraphPlugin');
    $this->enablePlugins('sfMysqlDumpPlugin');
    
    sfValidatorBase::setDefaultMessage('required','Este campo debe tener un valor');
    sfValidatorBase::setDefaultMessage('invalid','El valor para el campo no es v&aacute;lido');
    sfValidatorInteger::setDefaultMessage('invalid','El valor "%value%" no es un n&uacute;mero');
  }
}
