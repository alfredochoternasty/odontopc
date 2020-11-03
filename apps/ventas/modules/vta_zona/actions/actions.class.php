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
		$clientes_compartidos = array(808, 803, 810, 806, 793, 708, 791, 792, 813, 800, 788, 802, 657, 811, 805, 777, 675, 812, 797, 769, 655, 736, 801, 782, 770, 790, 798, 840, 784, 796, 671, 804, 785, 789, 756, 786, 724, 719, 746, 722, 698, 781, 767);
		$clintes_sin_comision = array(795, 783, 778, 709, 779, 787, 671, 682, 780);
		$tot_descuento = 0;
		$zona_id = 0;
		$array_devueltos = array();
    foreach($vtas as $vta):
			if (!$flag) {
					echo implode("\t", $titulos) . "\r\n";
					$flag = true;
			} 
					
			if (in_array($vta->cliente_id, $clientes_compartidos)) {
				// si es algun cliente compartido la comision es de 10%
				$total = $descuento = ($vta->getDetalleResumen()->sub_total) * 10 / 100;
				$porc = '10%';
			} elseif (in_array($vta->cliente_id, $clintes_sin_comision)) {
				// si es algun cliente compartido la comision es de 0%
				$total = $descuento = 0;
				$porc = '0%';
			} elseif (!empty($vta->grupo_porc_desc)) {
				$total = $descuento = ($vta->getDetalleResumen()->sub_total) * $vta->grupo_porc_desc / 100;
				$porc = $vta->grupo_porc_desc.'%';
			} elseif (!empty($vta->prod_porc_desc)) {
				$total = $descuento = ($vta->getDetalleResumen()->sub_total)  * $vta->prod_porc_desc / 100;
				$porc = $vta->prod_porc_desc.'%';
			} elseif (!empty($vta->grupo_precio_desc)) {
				$total = $descuento = $vta->grupo_precio_desc;
				$porc = $vta->grupo_precio_desc.'%';
			} elseif (!empty($vta->prod_precio_desc)) {
				$total = $descuento = $vta->prod_precio_desc;
				$porc = $vta->prod_precio_desc.'%';
			} else {
				$total = $descuento = 0;
			}
			$total_fmt = str_replace('.', ',', $total);
					
			$fila = array(
				$vta->getFecha(), 
				$vta->getResumen(), 
				$vta->getCliente(), 
				$vta->getProducto(), 
				$vta->getZona(), 
				$vta->getDetalleResumen()->getSubTotal(), 
				$porc, 
				$total_fmt
			);
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
    $ids = $request->getParameter('ids')?:array(0);
		$q2 = Doctrine_Query::create()->from('VentasZona')->whereIn('id', $ids);
		$ventas = $q2->execute();
		
    $ids_dev = $request->getParameter('ids_dev');
		if (!empty($ids_dev)) {
			$q3 = Doctrine_Query::create()->from('DevProducto')->whereIn('id', $ids_dev);
			$devs = $q3->execute();
		}
		
		$clientes_compartidos = array(808, 664, 803, 810, 806, 793, 708, 791, 792, 813, 800, 788, 802, 657, 811, 805, 777, 675, 812, 797, 769, 655, 736, 801, 782, 770, 790, 798, 840, 784, 796, 671, 804, 785, 789, 756, 786, 724, 719, 746, 722, 698, 781, 767);
		$clintes_sin_comision = array(795, 783, 778, 709, 779, 787, 671, 682, 780);
		
		$total_todo = 0;
		foreach ($ventas as $vta) {
			if (in_array($vta->cliente_id, $clientes_compartidos)) {
				$total = $vta->getDetalleResumen()->sub_total * 10/100;
			} elseif (in_array($vta->cliente_id, $clintes_sin_comision)) {
				$total = 0;
			} elseif (!empty($vta->grupo_porc_desc)) {
				$total = $vta->getDetalleResumen()->sub_total * $vta->grupo_porc_desc / 100;
			} elseif (!empty($vta->prod_porc_desc)) {
				$total = $vta->getDetalleResumen()->sub_total * $vta->prod_porc_desc / 100;
			} elseif (!empty($vta->grupo_precio_desc)) {
				$total = $vta->grupo_precio_desc;
			} elseif (!empty($vta->prod_precio_desc)) {
				$total = $vta->prod_precio_desc;
			} else {
				$total = 0;
			}
			$total_todo += $total;
		}
		
		$total_todo_dev = 0;
		foreach ($devs as $dev) {
			$grupoprod_id = Doctrine_Core::getTable('Producto')->find($dev->producto_id)->grupoprod_id;
			$desc_zona_grupo = Doctrine_Core::getTable('DescuentoZona')->findByZonaIdAndGrupoprodId($dev->zona_id, $dev->getProducto()->grupoprod_id);
			$desc_zona_prod = Doctrine_Core::getTable('DescuentoZona')->findByZonaIdAndProductoId($dev->zona_id, $dev->producto_id);
			if (in_array($dev->cliente_id, $clientes_compartidos)) {
				$total_dev = ($dev->precio * $dev->cantidad) * 10/100;
			} elseif (in_array($dev->cliente_id, $clintes_sin_comision)) {
				$total_dev = 0;
			} elseif (!empty($desc_zona_grupo[0]->porc_desc)) {
				$total_dev = ($dev->precio * $dev->cantidad) * ($desc_zona_grupo[0]->porc_desc/100);
			} elseif (!empty($desc_zona_prod[0]->porc_desc)) {
				$total_dev = ($dev->precio * $dev->cantidad) * ($desc_zona_prod[0]->porc_desc/100);
			} else {
				$total_dev = 0;
			}

			$total_todo_dev += $total_dev;
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
