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
    $titulos = array('Fecha', 'Factura', 'Cliente', 'Producto', 'Zona', 'Neto', 'Porcentaje', 'Comision');
    $flag = false;
		$total_todo = 0;
    foreach($vtas as $vta):
			if (!$flag) {
					echo implode("\t", $titulos) . "\r\n";
					$flag = true;
			}
					
			$fila = array(
				$vta->getFecha(), 
				$vta->getResumen(), 
				$vta->getCliente(), 
				$vta->getProducto(), 
				$vta->getZona(), 
				$vta->getDetalleResumen()->getSubTotal(), 
				$vta->getPorcentajeComision().'%', 
				'$ '.number_format($vta->getComision(), 2, ',', '.')
			);
			$string = implode("\t", array_values($fila));
			echo utf8_decode($string)."\r\n"; 
		  $total_todo += $vta->getComision();
    endforeach;
	
		$total_todo_fmt = str_replace('.', ',', $total_todo);
    $fila = array('', '', '', '', '', '', '', $total_todo_fmt);
    $string = implode("\t", array_values($fila));
    // echo utf8_decode($string)."\r\n";
	
		$q = Doctrine_Core::getTable('DevProducto')->createQuery('d');
		foreach ($this->getFilters() as $name => $valor) {
			if ($name == 'fecha') {
				if (array_key_exists('from', $valor) && !empty($valor['from'])) $q->andWhere("d.fecha >= '".$valor['from']."'");
				if (array_key_exists('to', $valor) && !empty($valor['to'])) $q->andWhere("d.fecha <= '".$valor['to']."'");
			}
			if ($name == 'fecha_cobrado') {
				if (array_key_exists('from', $valor) && !empty($valor['from'])) $q->andWhere("d.fecha >= '".$valor['from']."'");
				if (array_key_exists('to', $valor) && !empty($valor['to'])) $q->andWhere("d.fecha <= '".$valor['to']."'");
			}
			if ($name == 'zona_id' && !empty($valor)) $q->andWhere("d.zona_id = $valor");
			if ($name == 'cliente_id' && !empty($valor)) $q->andWhere("d.cliente_id = $valor");
			if ($name == 'producto_id' && !empty($valor)) $q->andWhere("d.producto_id = $valor");
			if ($name == 'pagado') {
				if ($valor === 1) 
					$q->andWhere("d.pago_comision_id is not null");
				elseif ($valor === 0) 
					$q->andWhere("d.pago_comision_id is null");
			}
			// if ($name == 'grupoprod_id')
			if ($name == 'nro_lote' && !empty($valor['text'])) $q->andWhere("d.nro_lote = '".$valor['text']."'");
		}
		$q->orderBy('fecha DESC');
		$devueltos = $q->execute();

    echo 'Listado de devoluciones por zona' . "\r\n";
    $titulos = array('Fecha', 'Factura', 'Cliente', 'Producto', 'Zona', 'Neto', 'Porcentaje', 'Comision');
    $flag = false;
		$total_todo = 0;
    foreach($devueltos as $dev):
			if (!$flag) {
					echo implode("\t", $titulos) . "\r\n";
					$flag = true;
			}
			
			$fila = array(
				$dev->getFecha(), 
				$dev, 
				$dev->getCliente(), 
				$dev->getProducto(), 
				$dev->getZona(), 
				$dev->precio * $dev->cantidad, 
				$dev->getPorcentajeComision().'%', 
				'$ '.number_format($dev->getComision(), 2, ',', '.')
			);
			$string = implode("\t", array_values($fila));
			echo utf8_decode($string)."\r\n"; 
		  $total_todo += $dev->getComision();
    endforeach;
		
		$total_todo_fmt = str_replace('.', ',', $total_todo);
    $fila = array('', '', '', '', '', '', '', $total_todo_fmt);
    $string = implode("\t", array_values($fila));
    echo utf8_decode($string)."\r\n";
		
    return sfView::NONE;	
	}
	
  protected function executeBatchPagar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids')?:array(0);
		$q2 = Doctrine_Query::create()->from('VentasZona')->whereIn('id', $ids);
		$ventas = $q2->execute();
		
    $ids_dev = $request->getParameter('ids_dev');
		if (!empty($ids_dev)) {
			$q3 = Doctrine_Query::create()->from('DevProducto')->whereIn('id', $ids_dev);
			$devs = $q3->execute();
		}
		
		$total_todo = 0;
		foreach ($ventas as $vta) {
			$total_todo += $vta->getComision();
		}
		
		$total_todo_dev = 0;
		foreach ($devs as $dev) {
			$total_todo_dev += $dev->getComision();
		}

		$zona = Doctrine::getTable('Zona')->find($vta->zona_id?:$dev->zona_id);
		$cliente = $zona->cliente_id;

		$pago_comision = new PagoComision();
		$pago_comision->setFecha(date('Y-m-d'));
		$pago_comision->setRevendedorId($cliente);
		$pago_comision->setMonedaId(1);
		$pago_comision->setMonto($total_todo - $total_todo_dev);
		$pago_comision->save();

    $count = Doctrine_Query::create()
      ->update('Resumen')
			->set('pago_comision_id ', $pago_comision->id)
      ->where('id in (select resumen_id from detalle_resumen where id in ('.implode(', ', $ids).'))')
      ->execute();
		
		if (!empty($ids_dev)) {
			$count = Doctrine_Query::create()
				->update('DevProducto')
				->set('pago_comision_id ', $pago_comision->id)
				->where('id in ('.implode(', ', $ids_dev).')')
				->execute();
		}
		$this->redirect('pagocomis/edit?id='.$pago_comision->id);
  }
	
	public function executeIndex(sfWebRequest $request){
		parent::executeIndex($request);
		$this->zona_id = $this->getUser()->getGuardUser()->getZonaId();
	}
	
  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    // if (!$ids = $request->getParameter('ids'))
    // {
      // $this->getUser()->setFlash('error', 'You must at least select one item.');

      // $this->redirect('@ventas_zona');
    // }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@ventas_zona');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorDoctrineChoice(array('model' => 'VentasZona'));
    try
    {
      // validate ids
      //$ids = $validator->clean($ids);

      // execute batch
      $this->$method($request);
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
    }

    $this->redirect('@ventas_zona');
  }
}
