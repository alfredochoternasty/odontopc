<?php

require_once dirname(__FILE__).'/../lib/detpedGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detpedGeneratorHelper.class.php';

/**
 * detped actions.
 *
 * @package    odontopc
 * @subpackage detped
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detpedActions extends autoDetpedActions
{
  public function executeActprecio(sfWebRequest $request){
    $producto = $request->getParameter('pid');
    $pedido = $this->getUser()->getAttribute('pid');
    $lista_precio = Doctrine::getTable('Pedido')->find($pedido)->getCliente()->getListaId();
    //$lista_precio = $this->getUser()->setAttribute('lid');
    if(empty($lista_precio)){
      $lista_precio = 1;
    }
    $prec_prod = Doctrine::getTable('Producto')->find($producto)->getPrecioFinal($lista_precio);
    return $this->renderText(json_encode(sprintf("%01.2f", $prec_prod)));
  }
  
  public function executeLote(sfWebRequest $request){
    $prod = null;
    $prod = $request->getParameter('pid');
    if(!empty($prod)){
      $q = Doctrine_Query::create()
          ->from('lote l')
          ->where('l.producto_id = ?', $prod)
					->andWhere("l.nro_lote not like 'er%'")
          ->andWhere('l.stock > 0')
          ->andWhere('l.fecha_vto > ?', date("Y-m-d"))
          ->orderBy('fecha_vto desc');
      $lotes = $q->execute();
      $nro_lote = '#';
      foreach($lotes as $lote){
        $nro_lote = $lote->getNroLote().' == '.$lote->getStock();
      }
    }else{
      $nro_lote = '#';
    }
    return $this->renderText(json_encode($nro_lote));
  } 
  
  public function executeList_volver(sfWebRequest $request){
    $this->redirect('@pedido');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $detped = new DetallePedido();
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    $detped->setPedidoId($pid);
    $this->form = new DetallePedidoForm($detped);
    $this->detalle_pedido = $this->form->getObject();
    
    $this->pager2 = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
    $this->getUser()->setAttribute('pid', $pid);
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }    
    $this->detalle_pedido = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->detalle_pedido);
    
    $this->pager2 = Doctrine::getTable('DetallePedido')->createQuery('dp')->where('pedido_id = ?', $pid)->andWhere('id <> ?', $request->getParameter('id'))->execute();
    $this->getUser()->setAttribute('pid', $pid);    
  }  
  
  public function executeUpdate(sfWebRequest $request)
  {
    parent::executeUpdate($request);
    $pid = $this->getUser()->getAttribute('pid');
    $this->pager2 = Doctrine::getTable('DetallePedido')->createQuery('dp')->where('pedido_id = ?', $pid)->andWhere('id <> ?', $request->getParameter('id'))->execute();   
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
	$this->setFilters(array("pedido_id" => $pid));
	$this->getUser()->setAttribute('pid', $pid);
	parent::executeIndex($request);
  }  
    
  public function executeNuevo(sfWebRequest $request)
  {
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $id_cliente = $clientes[0]->getId();
    $pedido = new Pedido();
    $pedido->setFecha(date('Y-m-d'));
    $pedido->setClienteId($id_cliente);
    $pedido->save();
    $id_ped = $pedido->getId();
    $this->getUser()->setAttribute('pid', $id_ped);
    $this->redirect('detped/new?pid='.$id_ped);
  }  
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $detalle_pedido = $form->save();
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@detalle_pedido_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $detalle_pedido->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          $this->redirect('ped/edit?id='.$detalle_pedido->getPedidoId());
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $obj = $this->getRoute()->getObject();
    $relations = $obj->getTable()->getRelations();
    
    $borrar = true;
    foreach ($relations as $name => $relation) {
        if($relation->getType() == 1){
          $rel = $relation->getTable()->findOneBy($relation->getForeign(), $obj->get($relation->getLocal()));
          if($rel){
            $borrar = false;
            break;
          }
        }
    }
        
    if($borrar){
      $this->getRoute()->getObject()->delete();
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }else{
      $this->getUser()->setFlash('error', 'No se puede borrar, el registro esta siendo referenciado.');
    }
		$this->redirect('@detalle_pedido_new');
  }  
  
  public function executeList_imprimir(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 1);
    $detpedidos = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("detalles" => $detpedidos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("pedido_nro_$pid.pdf");    
    return sfView::NONE;
  }
  
  function EnviarPedidoMail($pid){
		$detpedidos = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
		$mensaje->setTo(array('implantesnti@gmail.com' => 'NTI NTI'));
		$mensaje->setSubject('Nuevo Pedido');
		$mensaje->setBody($this->getPartial("imprimir", array("detalles" => $detpedidos)));
		$mensaje->setContentType("text/html");
		$this->getMailer()->send($mensaje);
		$this->getUser()->setFlash('notice', 'Pedido Enviado!');
  }
  
  function executeListFinalizar(sfWebRequest $request){
		$pid = $this->getUser()->getAttribute('pid', 1);
    if($entorno != 'dev'){
      $this->EnviarPedidoMail($pid);
    }else{
      $this->getUser()->setFlash('notice', 'dev: Simula Pedido Enviado!');
    }
		$this->redirect('ped/edit?id='.$pid);
  }
}
