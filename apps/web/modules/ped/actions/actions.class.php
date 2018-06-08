<?php

require_once dirname(__FILE__).'/../lib/pedGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pedGeneratorHelper.class.php';

/**
 * ped actions.
 *
 * @package    odontopc
 * @subpackage ped
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pedActions extends autoPedActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detped/index?pid='.$this->getRequestParameter('id'));
  }
  
  public function executeIndex(sfWebRequest $request)
  {
	$q = Doctrine_Query::create()->delete()->from('pedido p')->where('p.id not in (select pedido_id from detalle_pedido)')->execute();
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $id_cliente = $clientes[0]->getId();

    if ($request->getParameter('sort'))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // has filters? (usefull for activate reset button)
    $this->hasFilters = $this->getUser()->getAttribute('ped.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    
    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }
    
    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    $this->pager->getQuery()->from('pedido p')->where('p.cliente_id = ?', $id_cliente)->andWhere('p.vendido = ?', 0);
    
    // has filters? (usefull for activate reset button)
    $this->hasFilters = $this->getUser()->getAttribute('ped.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    
  }  
}
