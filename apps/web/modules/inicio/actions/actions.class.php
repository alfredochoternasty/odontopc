<?php

require_once dirname(__FILE__).'/../lib/inicioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/inicioGeneratorHelper.class.php';

/**
 * inicio actions.
 *
 * @package    odontopc
 * @subpackage inicio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inicioActions extends autoInicioActions
{
   
  public function executeIndex(sfWebRequest $request)
  {
    parent::executeIndex($request);
    
    //borra los pedidos que iniciados y que no tienen detalle
    //el pedido su hay detalle se hace una cabecera, y despues se borra el detalle y la cabecera queda sola
    $q = Doctrine_Query::create()->delete()->from('pedido p')->where('p.id not in (select pedido_id from detalle_pedido)')->execute();
    
    $modulo_pedidos = $this->getUser()->getVarConfig('modulo_pedidos');
    if ($modulo_pedidos == 'S') {
      $q = Doctrine::getTable('Pedido')
        ->createQuery('p')
        ->where('p.vendido = 0')
        //->andWhere('p.finalizado = 1')
        ->orderBy('p.fecha DESC')
        ->limit('10');
      if($this->getUser()->getGuardUser()->es_cliente){
        $id_usuario = $this->getUser()->getGuardUser()->getId();
        $clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
        $id_cliente = $clientes[0]->getId();	
        $q->andWhere('p.cliente_id = ?', $id_cliente);
      }
      $this->pager2 = $q->execute();
    }
    
    $modulo_seguimiento_clientes = $this->getUser()->getVarConfig('modulo_seguimiento_clientes');
    if ($modulo_seguimiento_clientes == 'S') {
      $this->pager = $this->getPager();
      $this->sort = $this->getSort();
      $q2 = Doctrine::getTable('ClienteSeguimiento')->createQuery('cs')->where('cs.prox_contac_fecha >= \''.date("Y-m-d").'\'')->orderBy('cs.prox_contac_fecha DESC')->limit('20');
      $this->pager3 = $q2->execute();
    }

  }

 	public function executeListImprimirStockMinimo(sfWebRequest $request){ 
    $consulta = $this->buildQuery();
    $datos = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir_stock_minimo", array('datos' => $datos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("stock_mininmo.pdf");    
    return sfView::NONE;
  }
  
}
