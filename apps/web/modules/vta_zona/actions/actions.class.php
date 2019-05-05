<?php

require_once dirname(__FILE__).'/../lib/vta_zonaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vta_zonaGeneratorHelper.class.php';

/**
 * vta_zona actions.
 *
 * @package    odontopc
 * @subpackage vta_zona
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vta_zonaActions extends autoVta_zonaActions
{
	
  public function executeListExcel(sfWebRequest $request){
    $filtro = new VentasZonaFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $vtas = $consulta->execute();
    
    header("Content-Disposition: attachment; filename=\"vtas_x_zona.xls\"");
    header("Content-Type: application/vnd.ms-excel");
    
    echo 'Listado de Ventas por zona' . "\r\n";
    $titulos = array('Fecha', 'Factura', 'Cliente', 'Producto', 'Zona', 'Neto', 'Descuento', 'Total');
    $flag = false;
    foreach($vtas as $vta):
          if (!$flag) {
              echo implode("\t", $titulos) . "\r\n";
              $flag = true;
          } 
					
					if (!empty($vta->grupo_porc_desc)) {
						$descuento = $vta->grupo_porc_desc.' %';
						$total = $vta->getDetalleResumen()->sub_total * $vta->grupo_porc_desc / 100;
					} elseif (!empty($vta->prod_porc_desc)) {
						$descuento = $vta->prod_porc_desc.' %';
						$total = $vta->getDetalleResumen()->sub_total * $vta->prod_porc_desc / 100;
					} elseif (!empty($vta->grupo_precio_desc)) {
						$descuento = $vta->grupo_precio_desc;
						$total = $vta->grupo_precio_desc;
					} elseif (!empty($vta->prod_precio_desc)) {
						$descuento = $vta->prod_precio_desc;
						$total = $vta->prod_precio_desc;
					} else {
						$descuento = 0;
						$total = 0;
					}
					$total = str_replace('.', ',', $total);					
					
          $fila = array($vta->getFecha(), $vta->getResumen(), $vta->getCliente(), $vta->getProducto(), $vta->getZona(), $vta->getDetalleResumen()->getSubTotal(), $descuento, $total);
          $string = implode("\t", array_values($fila));
          echo utf8_decode($string)."\r\n"; 
    endforeach;
    
    return sfView::NONE;	
	}
}
