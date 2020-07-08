<?php

require_once dirname(__FILE__).'/../lib/resumenGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/resumenGeneratorHelper.class.php';

/**
 * resumen actions.
 *
 * @package    odontopc
 * @subpackage resumen
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resumenActions extends autoResumenActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detres/index?rid='.$this->getRequestParameter('id'));
  }
  
  public function executeListFactura(sfWebRequest $request){
    $this->redirect( 'detres/cae?rid='.$this->getRequestParameter('id'));
  }    
  
  public function executeListMail(sfWebRequest $request){
    $resumen = Doctrine::getTable('Resumen')->find($this->getRequestParameter('id'));
    
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
    $mensaje->setTo($resumen->getCliente()->getEmail());
    $mensaje->setSubject('Factura - NTI Implantes');

    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("detres/imprimir", array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
	
		$factura = $dompdf->output();
		$adjunto = new Swift_Attachment($factura, $resumen->getFactura().'.pdf', 'application/pdf');
		$mensaje->attach($adjunto);
    $this->getMailer()->send($mensaje);
    
    $this->getUser()->setFlash('notice', 'El mail se enviado correctamente a la direccion '.$resumen->getCliente()->getEmail());
    $this->redirect('resumen');    
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $resumen = $form->save();
			
      $id_pedido = $resumen->getPedidoId();
      if($id_pedido > 0){
        $detalle_pedido = Doctrine::getTable('DetallePedido')->findbyPedidoId($id_pedido);
        foreach($detalle_pedido as $detalle):
          $detalle_resumen = new DetalleResumen();
          $detalle_resumen->setResumenId($resumen->getId());
          $detalle_resumen->setProductoId($detalle->getProductoId());
          $detalle_resumen->setNroLote($detalle->getNroLote());
          $detalle_resumen->setPrecio($detalle->getPrecio());
          $detalle_resumen->setCantidad($detalle->getCantidad());
					$sub_total = $detalle->precio * $detalle->cantidad;
					$iva = $sub_total * 0.25;
					$total = $sub_total + $iva;
          $detalle_resumen->setSubTotal($sub_total);
          $detalle_resumen->setDescuento(0);
          $detalle_resumen->setIva($iva);
          $detalle_resumen->setTotal($total);
          $detalle_resumen->setObservacion($detalle->getObservacion());
          $detalle_resumen->save();
          $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
          Doctrine_Query::create()->update('Pedido p')->set('p.vendido', 1)->set('p.fecha_venta', date('Ymd'))->where('p.id = '.$id_pedido)->execute();
        endforeach;
        $this->redirect( 'detres/index?rid='.$resumen->getId());
      }
			if ($request->hasParameter('_save_and_add')) {
        $this->redirect( 'detres/new?rid='.$resumen->getId());
      } else {
				$this->redirect('@resumen');
			}
    }
  }
  
  
  public function executeGuardarnuevocliente(sfWebRequest $request){
    $objProd = new Cliente();
    $datos = $request->getParameter('cliente');
    
    $objProd->setTipoId($datos['tipo_id']);
    $objProd->setDni($datos['dni']);
    $objProd->setCuit($datos['cuit']);
    $objProd->setCondicionfiscalId($datos['condicionfiscal_id']);
    $objProd->setGeneraComision($datos['genera_comision']);
    $objProd->setSexo($datos['sexo']);
    $objProd->setApellido($datos['apellido']);
    $objProd->setNombre($datos['nombre']);
    $objProd->setFechaNacimiento($datos['fecha_nacimiento']);
    $objProd->setDomicilio($datos['domicilio']);
    $objProd->setLocalidadId($datos['localidad_id']);
    $objProd->setTelefono($datos['telefono']);
    $objProd->setCelular($datos['celular']);
    $objProd->setFax($datos['fax']);
    $objProd->setEmail($datos['email']);
    $objProd->setObservacion($datos['observacion']);
    $objProd->setZonaId($datos['zona_id']);
    
    $objProd->save();
    
    return $this->renderText(json_encode($objProd->getId()));
  }    
  
	public function executeNew(sfWebRequest $request){
    if ($this->getRequestParameter('pid')) {
      $this->pedido = Doctrine::getTable('Pedido')->find($this->getRequestParameter('pid'));
			$det_pedido = Doctrine::getTable('DetallePedido')->findByPedidoId($this->getRequestParameter('pid'));
			$todos_tienen_lote = '';
			
			foreach ($det_pedido as $det) {
				$nro_lote = $det->getNroLote();
				if (empty($nro_lote)) {
					$todos_tienen_lote = 'N';
					break;
				} else {
					$todos_tienen_lote = 'S';
				}
			}
			
			if ($todos_tienen_lote == 'S') {
				$this->getUser()->setFlash('notice', 'Esta por vender el Pedido Nº '.$this->pedido->id.' del cliente '.$this->pedido->getCliente(), false);
				$this->resumen = new Resumen();
				$this->resumen->setClienteId($this->pedido->cliente_id);
				$this->resumen->setPedidoId($this->pedido->id);
				
				$parametros_form = array(
					'modulo_factura' => $this->getUser()->getVarConfig('modulo_factura'),
					'zona_id' => $this->pedido->getCliente()->zona_id,
					'usuario_id' => $this->getUser()->getGuardUser()->getId(),
				);
				
				$cliente = Doctrine::getTable('Cliente')->find($this->pedido->cliente_id);
				$this->form = $this->configuration->getForm($this->resumen, $parametros_form);
				$this->form->setWidget('pedido_id', new sfWidgetFormInputHidden(array('default' => $this->pedido->id)));
				$this->form->setWidget('cliente_id', new sfWidgetFormInputHidden(array('default' => $cliente->id)));
				$this->form->setWidget('tipofactura_id', new sfWidgetFormChoice(array('choices' => $this->pedido->getCliente()->getTiposFacturas())));
			} elseif($todos_tienen_lote = 'N') {
				$this->getUser()->setFlash('error', 'No se puede vender este pedido, porque hay productos que no tienen lote cargado');
				$this->redirect('@pedido_pedidos');
			} else {
				$this->getUser()->setFlash('error', 'Este pedido no tiene productos');
				$this->redirect('@pedido_pedidos');
			}
			
    } else {
      parent::executeNew($request);
    }
  }
  
  public function executeVerdetalle(sfWebRequest $request){
    $rid = $this->getRequestParameter('rid');
    $this->resumen = Doctrine::getTable('Resumen')->find($rid);
    $rid=0;
    $this->setTemplate('ver');
  }
	
  public function executeDatoscliente(sfWebRequest $request){
    $cliente_id = $request->getParameter('cid');
    $cliente = Doctrine::getTable('Cliente')->find($cliente_id);
    $datos['cuit'] = $cliente->getCuit();
    $datos['afip'] = $cliente->getCondfiscal()->getNombre();
    $datos['saldo_pesos'] = $cliente->getSaldoCtaCte(1);
    $datos['saldo_dolar'] = $cliente->getSaldoCtaCte(2);
    return $this->renderText(json_encode($datos));
  }
	
	public function executeGettipofacli(sfWebRequest $request){
		$modulo_factura = $this->getUser()->getVarConfig('modulo_factura');
		$options = '';
		if ($modulo_factura == 'S') {
			$cliente = Doctrine::getTable('Cliente')->find($request->getParameter('cid'));
			$opciones = $cliente->getTiposFacturas();
			foreach ($opciones as $k => $v) $options .= '<option value="'.$k.'">'.$v.'</option>';
		} else {
			if ($cliente->zona_id > 1) {
				$options = '<option value="1">Venta</option>'; 
			} else {
				$options = '<option value="1">Venta</option>'; 
				$options .= '<option value="4">Remito</option>'; 
			}
		}
		return $this->renderText(json_encode($options));
	}
	
  public function executeGetnroremito(sfWebRequest $request){
    $q = Doctrine_Query::create()
          ->select('r.nro_factura, r.id, r.fecha')
          ->from('resumen r')
          ->where('r.tipofactura_id = 4')
          ->groupBy('r.id, r.fecha')
          ->limit('1');
		$max_nro_remito = $q->execute();
    $nro = $max_nro_remito[0]['nro_factura'];
    $nro += 1;
    return $this->renderText(json_encode($nro));
  }	
}
