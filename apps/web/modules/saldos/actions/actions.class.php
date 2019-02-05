<?php

require_once dirname(__FILE__).'/../lib/saldosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/saldosGeneratorHelper.class.php';

/**
 * saldos actions.
 *
 * @package    odontopc
 * @subpackage saldos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class saldosActions extends autoSaldosActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ClienteSaldoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    if ($this->getSort()) $consulta->orderBy(implode(' ', $this->getSort()));
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial('imprimir' , array('saldos' => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("saldos.pdf");    
	
	/*
	  
    $filtro = new ClienteFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('saldos.page', '1', 'admin_module')-1;
		$consulta->orderBy('apellido, nombre')->limit(50)->offset($pagina * 50);
    $saldos = $consulta->execute();
		
		$dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("saldos" => $saldos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("saldos.pdf");
		
	
    header("Content-Disposition: attachment; filename=\"clientes.xls\"");
    header("Content-Type: application/vnd.ms-excel");
    
    echo 'Listado de Saldos' . "\r\n";
    $titulos = array('Tipo', 'Apellido', 'Nombre', 'Saldo');
    $flag = false;

    foreach($saldos as $saldo):
          if (!$flag) {
              echo implode("\t", $titulos) . "\r\n";
              $flag = true;
          }  
          $fila = array($saldo->getTipo(), $saldo->getApellido(), $saldo->getNombre(), '$ '.sprintf("%01.2f", $saldo->getSaldoCtaCte()));
          $string = implode("\t", array_values($fila));
          echo utf8_decode($string)."\r\n"; 
    endforeach;
		*/
    
		return sfView::NONE;
  }
	
}
