<?php

require_once dirname(__FILE__).'/../lib/stockajusteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stockajusteGeneratorHelper.class.php';

/**
 * stockajuste actions.
 *
 * @package    odontopc
 * @subpackage stockajuste
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockajusteActions extends autoStockajusteActions
{
	public function executeGet_lotes_producto(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    $zid = $request->getParameter('zid');
		$lotes = Doctrine::getTable('Lote')->getLotesProductoZona($pid, $zid);
		
		echo '<option value=""></option>';
		foreach ($lotes as $lote) {
			echo '<option value="'.$lote->nro_lote.'">'.$lote->nro_lote.'</option>';
		}

    return sfView::NONE;
	}

}