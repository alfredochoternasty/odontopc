<?php

class myUser extends sfGuardSecurityUser
{
  public function getVarConfig($p_var)
  {
    $valor = $this->getAttribute($p_var, '');
    if (empty($valor)) {
      $obj = Doctrine::getTable('Configuracion')->find($p_var);
			if (!empty($obj)) {
				$valor = $obj->valor;
				$this->setAttribute($p_var, $valor);
			}
    }
		return $valor;
  }
	
}
