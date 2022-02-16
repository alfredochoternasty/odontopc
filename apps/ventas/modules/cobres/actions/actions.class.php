<?php

require_once dirname(__FILE__).'/../lib/cobresGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cobresGeneratorHelper.class.php';

/**
 * cobres actions.
 *
 * @package    odontopc
 * @subpackage cobres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cobresActions extends autoCobresActions
{
	public function executeIndex(sfWebRequest $request){
    if ($request->hasParameter('resumen_id')) {
        $filtros = array('resumen_id' => $request->getParameter('resumen_id'));
        $this->setFilters($filtros);
        $this->total_cobros = 0;
        $cobros = Doctrine::getTable('CobroResumen')->findByResumenId($request->getParameter('resumen_id'));
        foreach ($cobros as $cobro) $this->total_cobros += $cobro->getCobro()->getMonto();
    }
    if ($request->hasParameter('cobro_id')) {
        $filtros = array('cobro_id' => $request->getParameter('cobro_id'));
        $this->setFilters($filtros);
    }
    parent::executeIndex($request);
  }  
}
