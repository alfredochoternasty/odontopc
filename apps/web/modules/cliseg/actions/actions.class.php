<?php

require_once dirname(__FILE__).'/../lib/clisegGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clisegGeneratorHelper.class.php';

/**
 * cliseg actions.
 *
 * @package    odontopc
 * @subpackage cliseg
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clisegActions extends autoClisegActions
{
  public function executeList_hecho(sfWebRequest $request){
    $this->redirect( 'cliseg/new?cid='.$this->getRequestParameter('id'));
  }
	
  public function executeNew(sfWebRequest $request)
  {
			if($request->hasParameter('cid')){
				$cid = $request->getParameter('cid');
				
				$cli_seg = Doctrine::getTable('ClienteSeguimiento')->find($cid);
				$cli_seg->setRealizada(1);
				$cli_seg->save();
				
				$NuevoCliSeg = new ClienteSeguimiento();
				$NuevoCliSeg->setClienteId($cli_seg->getClienteId());
				$NuevoCliSeg->setFecha(implode('/', array_reverse(explode('-', $cli_seg->getProxContacFecha()))));
				$NuevoCliSeg->setHora($cli_seg->getProxContacHora());
				$NuevoCliSeg->setTipoContactoId($cli_seg->getTipoContactoId());
				$NuevoCliSeg->setMotivoId($cli_seg->getMotivoId());
				$this->form = new ClienteSeguimientoForm($NuevoCliSeg);

				$w = new sfWidgetFormInputHidden();
				$this->form->setWidget('cliente_id', $w);
				$this->form->setWidget('fecha', $w);
				$this->form->setWidget('hora', $w);	
				$this->form->setWidget('tipo_contacto_id', $w);	
				$this->form->setWidget('motivo_id', $w);
				$this->cliente_seguimiento = $this->form->getObject();
				$this->setTemplate('cargar');
		} else{
			$this->form = $this->configuration->getForm();
			$this->cliente_seguimiento = $this->form->getObject();
		}    
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ClienteSeguimientoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('letter','landscape');
    $dompdf->render();
    $dompdf->stream("cliente_seguimiento.pdf");    
    return sfView::NONE;
  }
}
