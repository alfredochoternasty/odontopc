<?php

require_once dirname(__FILE__).'/../lib/ctacteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ctacteGeneratorHelper.class.php';

/**
 * ctacte actions.
 *
 * @package    odontopc
 * @subpackage ctacte
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ctacteActions extends autoCtacteActions
{
  public function executeFilter(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('saldo', '0');
    
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@ctacte');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      $this->hasFilters = $this->getUser()->getAttribute('ctacte.filters', $this->configuration->getFilterDefaults(), 'admin_module');
      //$this->redirect('@ctacte');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    
    $this->getUser()->setAttribute('cta_imprimir', $this->getPager()->getResults());
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctacte.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new CtaCteFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $consulta->orderBy('moneda_id asc');
    $consulta->addOrderBy('fecha asc');
    $cta_cte = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("cta_cte" => $cta_cte)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("ctacte.pdf");    
    return sfView::NONE;
  }
  
  public function executeListMail(sfWebRequest $request){
    $filtro = new CtaCteFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $cta_cte = $consulta->execute();
    
    if($cta_cte[0]->getCliente()->getEmail() != ''){
      $mensaje = Swift_Message::newInstance();
      $mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
      $mensaje->setTo($cta_cte[0]->getCliente()->getEmail());
      $mensaje->setSubject('Detalle Cuenta Corriente');
      $mensaje->setBody($this->getPartial("imprimir", array("cta_cte" => $cta_cte)));
      $mensaje->setContentType("text/html");
      $this->getMailer()->send($mensaje);
      $this->getUser()->setFlash('notice', 'El mail se enviado correctamente a la direccion '.$cta_cte[0]->getCliente()->getEmail());
      $this->redirect('ctacte');
    }else{
      $this->getUser()->setFlash('error', 'El cliente no tiene definida una direccion de Email');
      $this->redirect('ctacte');      
    }    
  }
  
  public function executeVer(sfWebRequest $request){
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $id_cliente = $clientes[0]->getId();
    $this->saldo = $clientes[0]->getSaldoCtaCte(1, null, true);
    $this->ctacte = Doctrine_Core::getTable('CtaCte')->createQuery('c')->where('cliente_id = '.$id_cliente)->orderBy('c.fecha DESC')->execute();
    $this->setLayout('layout_app');
  }
}
