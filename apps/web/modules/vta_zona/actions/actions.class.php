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
		$total_todo = 0;
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
			$total_fmt = str_replace('.', ',', $total);
					
			$fila = array($vta->getFecha(), $vta->getResumen(), $vta->getCliente(), $vta->getProducto(), $vta->getZona(), $vta->getDetalleResumen()->getSubTotal(), $descuento, $total_fmt);
			$string = implode("\t", array_values($fila));
			echo utf8_decode($string)."\r\n"; 
		  $total_todo += $total;
    endforeach;
	
	$total_todo_fmt = str_replace('.', ',', $total_todo);
    $fila = array('', '', '', '', '', '', '', $total_todo_fmt);
    $string = implode("\t", array_values($fila));
    echo utf8_decode($string)."\r\n";
	
    return sfView::NONE;	
	}
	
  protected function executeBatchPagar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

		$q2 = Doctrine_Query::create()
			->from('VentasZona')
			->whereIn('id', $ids);
		$result = $q2->execute();
		
		$total_todo = 0;
		foreach ($result as $vta) {
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
			$total_todo += $total;
		}
		
    $zona_id = $this->getUser()->getAttribute('comision_zona');
		$zona = Doctrine::getTable('Zona')->find($zona_id);
		$cliente = $zona->cliente_id;

		$pago_comision = new PagoComision();
		$pago_comision->setFecha(date('Y-m-d'));
		$pago_comision->setRevendedorId($cliente);
		$pago_comision->setMonedaId(1);
		$pago_comision->setMonto($total_todo);
		$pago_comision->save();

    $count = Doctrine_Query::create()
      ->update('resumen')
			->set('pago_comision_id ', $pago_comision->id)
      ->where('id in (select resumen_id from detalle_resumen where id in ('.implode(', ', $ids).'))')
      ->execute();
		$this->redirect('pagocomis/edit?id='.$pago_comision->id);
  }	
}
