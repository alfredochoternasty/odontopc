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
  public function executeAct_local(sfWebRequest $request){
    $statement = Doctrine_Manager::getInstance()->connection();  
    $sql =  'insert into traza2(producto_id, nro_lote, nro_venta, fecha_venta, cliente_id, cant_vendida) ';
    $sql .=  'select producto_id, nro_lote, nro_factura, fecha, cliente_id, cantidad from detalle_resumen dr join resumen r on dr.resumen_id = r.id ';
    $sql .=  'where producto_id in (select id from producto2) and nro_lote not like \'i0%\' and exportado = 0';    
    $results = $statement->execute($sql, array(1));
    
    $sql =  'update detalle_resumen set exportado = 1 where producto_id in (select id from producto2) and exportado = 0';
    $results = $statement->execute($sql, array(1));
/*    
    $sql = 'insert into compra2(numero, proveedor_id, fecha, producto_id, cantidad, nro_lote) ';
    $sql .= 'select c.numero, c.proveedor_id, c.fecha, dc.producto_id, dc.cantidad, dc.nro_lote ';
    $sql .= 'from detalle_compra dc join compra c on dc.compra_id = c.id ';
    $sql .= 'where dc.producto_id in (select id from producto2) and exportado = 0 and nro_lote not like \'i0%\'';
    $results = $statement->execute($sql, array(1));
    
    $sql =  'update detalle_compra set exportado = 1 where producto_id in (select id from producto2) and exportado = 0';
    $results = $statement->execute($sql, array(1));
*/
    $this->getUser()->setFlash('notice', 'Actualización correcta');
    $this->setTemplate('actualizar');
  }
  
  public function executeAct_exp(sfWebRequest $request){
    $statement = Doctrine_Manager::getInstance()->connection();  
    $sql = file_get_contents('http://ventas.ntiimplantes.com.ar/web/datos_traza.php');
    $sqls = explode('; ', $sql);
    foreach($sqls as $k => $v){
      $results = $statement->execute($v);
    }
    
    $this->getUser()->setFlash('notice', 'Actualización correcta');
    $this->setTemplate('actualizar');
  }
 
  public function executeIndex(sfWebRequest $request)
  {
		/*
    $entorno = sfConfig::get('sf_environment');
    if($entorno != 'dev'){
      if($this->getUser()->hasGroup('Blanco')){
        $filename = './bckp/ventas-'.date("Ymd", time()).'.sql.zip';
      }else{
        $filename = './bckp/ntiimplantes_db-'.date("Ymd", time()).'.sql.zip';
      }
      if(!file_exists ($filename)){
        $db = new Backup_Database();
        $db->backupTables();
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom(array('info@ntiimplantes.com.ar' => 'NTI implantes'));
        $mensaje->setTo(array('alfredochoternasty@gmail.com' => 'Backup Sistema'));
        if($this->getUser()->hasGroup('Blanco')){
          $mensaje->setSubject('backup blanco NTI');
        }else{
          $mensaje->setSubject('backup negro NTI');
        }
        $mensaje->setBody('aca esta el backup');
        $mensaje->attach(Swift_Attachment::fromPath($filename));
        $mensaje->setContentType("text/html");
        $this->getMailer()->send($mensaje);
      }	
    }

    
    $filename = './sql/nuevo.sql';
    if(file_exists ($filename)){
      $db = new Backup_Database();
      $db->ejecutar_archivo_sql($filename);
    }
    //borra los pedido sin detalle
    
    if ($request->getParameter('page')){
      $this->setPage($request->getParameter('page'));
    }	
    */
    parent::executeIndex($request);
    
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
  
  
}
