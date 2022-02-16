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
	
	public function verificarUsuario($p_usuario)
	{
		$query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
			->where('u.username = ?', $p_usuario)
			->addWhere('u.is_active = 1')
			->addWhere('u.es_cliente = 1');

		return $query->fetchOne();
	}
	
}
