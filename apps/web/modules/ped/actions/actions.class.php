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

    if ($request->getParameter('sort')) {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    $this->hasFilters = $this->getUser()->getAttribute('ped.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    
    if ($request->getParameter('page')) {
      $this->setPage($request->getParameter('page'));
    }
    
    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    $this->pager->getQuery()->from('pedido p')->where('p.cliente_id = ?', $id_cliente)->andWhere('p.vendido = ?', 0);
    
    $this->hasFilters = $this->getUser()->getAttribute('ped.filters', $this->configuration->getFilterDefaults(), 'admin_module');    
  }  
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $pedido = $form->save();
      $pedido->setFinalizado(1);
			$pedido = $form->save();
			$this->EnviarPedidoMail($pedido->getId());
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pedido)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@pedido_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $pedido->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          $this->redirect('@pedido');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
  function EnviarPedidoMail($pid){
		$detpedidos = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array('implantesnti@gmail.com' => 'Sistemas de Pedidos'));
		$mensaje->setTo(array('implantesnti@gmail.com' => 'NTI NTI'));
		$mensaje->setSubject('Nuevo Pedido');
		$mensaje->setBody($this->getPartial("imprimir", array("detalles" => $detpedidos)));
		$mensaje->setContentType("text/html");
		$this->getMailer()->send($mensaje);
		$this->getUser()->setFlash('notice', 'Pedido Enviado!');
  }
	
}
