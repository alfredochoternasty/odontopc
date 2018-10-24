<?php

require_once dirname(__FILE__).'/../lib/trazaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/trazaGeneratorHelper.class.php';

/**
 * traza actions.
 *
 * @package    odontopc
 * @subpackage traza
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class trazaActions extends autoTrazaActions
{
	
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ProductoTrazaFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('traza.page', '1', 'admin_module')-1;
		$consulta->limit(50)->offset($pagina * 50);
    $traza = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("traza" => $traza)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("traza.pdf");    
    return sfView::NONE;
  }
	
  public function executeListExcel(sfWebRequest $request){
    $filtro = new ProductoTrazaFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('traza.page', '1', 'admin_module')-1;
		$consulta->limit(50)->offset($pagina * 50);		
    $traza = $consulta->execute();
			
    header("Content-Disposition: attachment; filename=\"traza_pagina.xls\"");
    header("Content-Type: application/vnd.ms-excel");
		
		if(!empty($traza[0])){
			$flag = false;
			$titulos = array('Fecha', 'Cliente', 'Proveedor', 'Marca', 'Codigo', 'Descripcion', 'Lote', 'Factura', 'Vencimiento', 'Cantidad');
			
			echo 'Traza de Productos' . "\r\n";
			foreach($traza as $fila){
				if (!$flag) {
						echo implode("\t", $titulos) . "\r\n";
						$flag = true;
				}
				$fila = array($fila->getFechaVenta(), trim($fila->getCliente()), trim($fila->getProveedor()), 'NTI', trim($fila->getProducto()->getCodigo()), trim($fila->getProducto()), trim($fila->getNroLote()), trim($fila->getNumero()), $fila->getFechaVto(), $fila->getCantVendida());
				$string = implode("\t", array_values($fila));
				echo utf8_decode($string)."\r\n";					
			}
		}
				
    return sfView::NONE;
  }
	
  public function executeListExcelTodo(sfWebRequest $request){
    $filtro = new ProductoTrazaFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $traza = $consulta->execute();
			
    header("Content-Disposition: attachment; filename=\"traza_todo.xls\"");
    header("Content-Type: application/vnd.ms-excel");
		
		if(!empty($traza[0])){
			$flag = false;
			$titulos = array('Fecha', 'Cliente', 'Proveedor', 'Marca', 'Codigo', 'Descripcion', 'Lote', 'Factura', 'Vencimiento', 'Cantidad');
			
			echo 'Traza de Productos' . "\r\n";
			foreach($traza as $fila){
				if (!$flag) {
						echo implode("\t", $titulos) . "\r\n";
						$flag = true;
				}
				$fila = array($fila->getFechaVenta(), trim($fila->getCliente()), trim($fila->getProveedor()), 'NTI', trim($fila->getProducto()->getCodigo()), trim($fila->getProducto()), trim($fila->getNroLote()), trim($fila->getNumero()), $fila->getFechaVto(), $fila->getCantVendida());
				$string = implode("\t", array_values($fila));
				echo utf8_decode($string)."\r\n";					
			}
		}
				
    return sfView::NONE;
  }	
	
}
