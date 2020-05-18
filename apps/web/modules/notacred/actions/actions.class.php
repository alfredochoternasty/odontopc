<?php

require_once dirname(__FILE__).'/../lib/notacredGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/notacredGeneratorHelper.class.php';

/**
 * notacred actions.
 *
 * @package    odontopc
 * @subpackage notacred
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class notacredActions extends autoNotacredActions
{
	public function executeNew(sfWebRequest $request)
  {
		
		$parametros_form = array(
			'modulo_factura' => $this->getUser()->getVarConfig('modulo_factura'),
			'usuario_id' => $this->getUser()->getGuardUser()->getId(),
			'nota_manual' => true,
		);
		
    $this->form = $this->configuration->getForm(null, $parametros_form);
    $this->dev_producto = $this->form->getObject();
  }
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $dev_producto = $form->save();
			
			$dev_producto->zona_id = $dev_producto->getCliente()->zona_id;
			$dev_producto->cantidad = 1;
			$dev_producto->iva = 0;
			if (!empty($dev_producto->resumen_id)) {
				$tipo_fact_asoc = $dev_producto->getResumen()->tipofactura_id;
				if ($tipo_fact_asoc == 1) $dev_producto->iva = $dev_producto->total/1.21;
			}
			$dev_producto->precio = $dev_producto->total - $dev_producto->iva;
			$dev_producto->save();
			
			if (!empty($dev_producto->resumen_id) && $dev_producto->getResumen()->tipofactura_id != 4) {
				$cobro = new Cobro();
				$cobro->setFecha(date('Y-m-d'));
				$cobro->setClienteId($dev_producto->getClienteId());
				$cobro->setResumenId($dev_producto->getResumenId());			
				$detalle_resumen = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($dev_producto->getResumenId(), $dev_producto->getProductoId());			
				$cobro->setMonedaId($detalle_resumen[0]->getMonedaId());
				$cobro->setMonto($dev_producto->getTotal());
				$cobro->setTipoId(5);
				$cobro->setDevprodId($dev_producto->getId());
				$cobro->save();
			}
			
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@dev_producto_notacred_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $dev_producto->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          $this->redirect('@dev_producto_notacred');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
  public function executeListImprimir(sfWebRequest $request){
    $rid = $request->getParameter('id');
    $dev_producto = Doctrine::getTable('DevProducto')->find($rid);
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("dev_producto" => $dev_producto)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream($dev_producto.".pdf");    
		$this->forward('nota_credito', 'index');
    return sfView::NONE;
  }
	
  public function executeGet_vtas_cliente(sfWebRequest $request){
  
    $q = Doctrine_Query::create()
			->select('res.id, t.nombre, res.pto_vta, res.nro_factura, res.fecha, dr.nro_lote')
      ->from('Resumen res')
      ->leftJoin('res.Detalle dr')
      ->leftJoin('res.TipoFactura t')
      ->where('res.cliente_id = '.$request->getparameter('cid'))
      ->orderBy('res.fecha desc');
     
		$vtas = $q->execute(null, Doctrine::HYDRATE_NONE);
    $options[] = '<option value=""></option>';	
    foreach ($vtas as $vta) {
			if (empty($options[$vta[0]])) {
				$options[$vta[0]] = '<option value="'.$vta[0].'">'.$vta[5].'-'.$vta[1].'-'.str_pad($vta[2], 8, 0,STR_PAD_LEFT).' - Fecha: '.implode('/', array_reverse(explode('-', $vta[3]))).' - Nro_lote:'.$vta[4].'</option>';
			}
    }
    echo implode($options);
    return sfView::NONE;
  }
}
