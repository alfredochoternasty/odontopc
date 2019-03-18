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
				$fila = array(
					$fila->getResumen()->getFactura(), 
					$fila->getFecha(), 
					trim($fila->getCliente()), 
					str_replace('.', ',', $fila->getIva()), 
					str_replace('.', ',', $fila->getNeto()), 
					str_replace('.', ',', $fila->getTotal()), 
				);
				$string = implode("\t", array_values($fila));
				echo utf8_decode($string)."\r\n";					
			}
		}
				
    return sfView::NONE;
  }	
	
}