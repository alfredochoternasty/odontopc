<?php

require_once dirname(__FILE__).'/../lib/facafipGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/facafipGeneratorHelper.class.php';

/**
 * facafip actions.
 *
 * @package    odontopc
 * @subpackage facafip
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facafipActions extends autoFacafipActions
{
	
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new FacturasAfipFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $facturas = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("facturas" => $facturas)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("facturas_afip.pdf");
    return sfView::NONE;
  }
	
  public function executeListExportar(sfWebRequest $request){
    $filtro = new FacturasAfipFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $facturas = $consulta->execute();
			
    header("Content-Disposition: attachment; filename=\"factuas_afip.xls\"");
    header("Content-Type: application/vnd.ms-excel");
		
		if(!empty($facturas[0])){
			$flag = false;
			$titulos = array('Comprobante', 'Fecha', 'Cliente', 'IVA', 'Neto', 'Total');
			
			echo 'Listado de Facturas enviadas a la Afip' . "\r\n";
			foreach($facturas as $fila){
				if (!$flag) {
						echo implode("\t", $titulos) . "\r\n";
						$flag = true;
				}
				$multiplicador = $fila->tipofactura_id>4?-1:1; 
				$fila = array(
					$fila->getTipoFactura().' - '.str_pad($fila->pto_vta, 4, 0, STR_PAD_LEFT) .'-'.str_pad($fila->nro_factura, 8, 0, STR_PAD_LEFT),
					$fila->getFecha(), 
					trim($fila->getCliente()), 
					str_replace('.', ',', $fila->getIva() * $multiplicador), 
					str_replace('.', ',', $fila->getNeto() * $multiplicador), 
					str_replace('.', ',', $fila->getTotal() * $multiplicador), 
				);
				$string = implode("\t", array_values($fila));
				echo utf8_decode($string)."\r\n";					
			}
		}
				
    return sfView::NONE;
  }	
	
  public function executeVer(sfWebRequest $request){
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $cliente = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $this->facturas = Doctrine::getTable('FacturasAfip')->findByClienteId($cliente[0]->id);
    $this->setLayout('layout_app');
  }
	
  public function executeImprimir(sfWebRequest $request){
		$rid = $request->getParameter('rid');
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    $dompdf = new DOMPDF();
		$modelo_impresion = $resumen->getTipoFactura()->modelo_impresion;
    $dompdf->load_html($this->getPartial('detres/'.$modelo_impresion, array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream($resumen.".pdf");
		$this->forward('resumen', 'index');
    return sfView::NONE;
  }
}