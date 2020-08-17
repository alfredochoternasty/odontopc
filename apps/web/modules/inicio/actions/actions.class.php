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
    // $q = Doctrine_Query::create()->delete()->from('pedido p')->where('p.id not in (select pedido_id from detalle_pedido)')->execute();
    $zona_id = $this->getUser()->getGuardUser()->getZonaId();
    $modulo_pedidos = $this->getUser()->getVarConfig('modulo_pedidos');
    if ($modulo_pedidos == 'S') {
      $q = Doctrine::getTable('Pedido')
        ->createQuery('p')
        ->andWhere('p.vendido = 0')
        ->andWhere('p.finalizado = 1')
        ->andWhere('p.zona_id = ?', $zona_id)
        ->orderBy('p.fecha ASC');
        
      if ($this->getUser()->getGuardUser()->es_cliente){
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
    
    $modulo_tablero = 'S'; //$this->getUser()->getVarConfig('modulo_tablero');
    if ($modulo_tablero == 'S') {
        $this->ventas = Doctrine::getTable('Categoria')->findAll();
        $this->clientes = array();
        $this->clientes['nuevos'] = Doctrine::getTable('Cliente')->getNuevos($zona_id);
        $this->clientes['anterior'] = Doctrine::getTable('Cliente')->getNuevosAnt($zona_id);
        $this->clientes['total'] = count(Doctrine::getTable('Cliente')->findByActivoAndZonaId(1, $zona_id));
        $this->tipo_ventas = array();
        $this->tipo_ventas['ventas'] = Doctrine::getTable('Resumen')->getVentas($zona_id);
        $this->tipo_ventas['pedidos'] = Doctrine::getTable('Resumen')->getVentasPedidos($zona_id);
    }
    $this->zona_id = $zona_id;
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
