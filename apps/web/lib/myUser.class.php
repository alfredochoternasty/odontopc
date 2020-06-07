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
	
	public function EsCliente($u_id)
	{
		// return false;
		$clientes = Doctrine::getTable('Cliente')->findByUsuarioId($u_id);
		if (!empty($clientes[0]))
			return true;
		else
			return false;
	}
}
