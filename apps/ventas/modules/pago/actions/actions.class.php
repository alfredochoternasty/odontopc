<?php

require_once dirname(__FILE__).'/../lib/pagoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pagoGeneratorHelper.class.php';

/**
 * pago actions.
 *
 * @package    odontopc
 * @subpackage pago
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pagoActions extends autoPagoActions
{
  public function executeBuscarcompra(sfWebRequest $request){
    
    $resultado = '<div class="label ui-helper-clearfix"><label for="cobro_resumen_id">Resumen</label></div>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table>
  <thead class="ui-widget-header">
    <tr>
      <th class="sf_admin_text sf_admin_list_th_Cliente ui-state-default ui-th-column">Numero</th>
      <th class="sf_admin_text sf_admin_list_th_total ui-state-default ui-th-column">Fecha</th>
      <th class="sf_admin_text sf_admin_list_th_facturado ui-state-default ui-th-column">Total Compra</th>
      <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column">Pagado</th>
      <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column">Saldo</th>
    </tr>
  </thead>
  <tbody>';
  $suma_saldo = 0;
  $suma_compra = 0;
  $suma_pagado = 0;
  $proveedor = $request->getParameter('pid');
  $cuenta = $request->getParameter('cid');
  $Compras = Doctrine::getTable('Compra')->findByCuentaIdAndProveedorIdAndPagado($cuenta, $proveedor, 0);  
  foreach($Compras as $compra){
    $suma_pagado += $compra->getTotalPagado();
    $saldo = $compra->getTotal() - $compra->getTotalPagado();
    $suma_saldo += $saldo;
    $suma_compra += $compra->getTotal();
    
    $resultado .= '<tr class="sf_admin_row ui-widget-content  odd">';
    $resultado .= '<td class="sf_admin_text sf_admin_list_td_numero">'.$compra->getId().'</td>';
    $resultado .= '<td class="sf_admin_text sf_admin_list_td_numero">'.$compra->getFecha().'</td>';
    $resultado .= '<td class="sf_admin_text sf_admin_list_td_numero"> $ '.sprintf("%01.2f", $compra->getTotal()).'</td>';
    $resultado .= '<td class="sf_admin_text sf_admin_list_td_numero"> $ '.sprintf("%01.2f", $compra->getTotalPagado()).'</td>';
    $resultado .= '<td class="sf_admin_text sf_admin_list_td_numero"> $ '.sprintf("%01.2f", $saldo).'</td>';
    $resultado .= '</tr>';
  }
    
  $resultado .= '</tbody>
  <tfoot>
    <tr>
      <td></td>
      <td style="text-align:right;">Totales:&nbsp;</td>
      <td>&nbsp;$ '.sprintf("%01.2f", $suma_compra).'</td>
      <td>&nbsp;$ '.sprintf("%01.2f", $suma_pagado).'</td>
      <td>&nbsp;$ '.sprintf("%01.2f", $suma_saldo).'</td>
    </tr>
  </tfoot>
</table>
</div>';
/*echo $resultado;
return sfView::NONE;*/
return $this->renderText($resultado);
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Pago = $form->save(); //$request->getParameter('pago');
      $monto = $Pago->getMonto();
      
      $Compras = Doctrine::getTable('Compra')->findByProveedorIdAndPagado($Pago['proveedor_id'], 0);  
      foreach($Compras as $compra){
        $saldo = $compra->getTotal() - $compra->getTotalPagado();
        $objPago = new PagoCompra();
        $objPago->setPagoId($Pago->getId());
        $objPago->setCompraId($compra->getId());
        
        if($monto >= $saldo){
          $objPago->setMonto($saldo);
          $monto = $monto - $saldo;
          $compra->pagado = 1;
          $compra->save();
          $objPago->save();
        }else{
          $objPago->setMonto($monto);
          $objPago->save();
          break;
        }
      }

      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@pago_new');
      }else{
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('pago/index');
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeEdit(sfWebRequest $request)
  {
		$zid = $this->getUser()->getGuardUser()->getZonaId();
    $this->pago = $this->getRoute()->getObject();
		$parametros = array(
			'image_url' => !empty($this->pago->comprobante)?'GetImagen?img='.$this->pago->comprobante:''
		);
    $this->form = $this->configuration->getForm($this->pago, $parametros);
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $pago_compra = Doctrine::getTable('PagoCompra')->findByPagoId($this->getRoute()->getObject()->getId());
    foreach($pago_compra as $pc){
      $pc->delete(); 
      $compra = Doctrine::getTable('Compra')->find($pc->getCompra()->getId());
      $compra->pagado = 0;
      $compra->save();
    }
    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@pago');
  }    
}
