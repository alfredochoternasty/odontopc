  public function executeListImprimirPagina(sfWebRequest $request)
  {
	$this->descargar_pdf(true);
  }

  public function executeListImprimirTodo(sfWebRequest $request)
  {
	$this->descargar_pdf(false);
  }
  
  public function get_datos($p_imp_pagina=false)
  {
    $clase_filtro = get_class($this->configuration->getFilterForm($this->getFilters()));
    $filtro = new $clase_filtro;
    $consulta = $filtro->buildQuery($this->getFilters());
	if ($p_imp_pagina) {
		$pagina = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.page', '1', 'admin_module')-1;
		$consulta->limit(50)->offset($pagina * 50);
	}
	return $consulta->execute();
  }
  
  public function descargar_pdf($imp_pag=false)
  {
	$datos = $this->get_datos($imp_pag);
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imp", array("<?php echo $this->getSingularName() ?>s" => $datos)));
    $dompdf->set_paper('A4','<?php echo empty($this->config['list']['paper_orientation'])? 'portrait' : $this->config['list']['paper_orientation'] ?>');
    $dompdf->render();
    $dompdf->stream("<?php echo $this->getSingularName() ?>.pdf");    
    return sfView::NONE;
  }  
  

  public function executeListExcelTodo(sfWebRequest $request)
  {
	$this->descargar_excel(false);
  }
  
  public function executeListExcelPagina(sfWebRequest $request)
  {
	$this->descargar_excel(true);
  }
    
  public function descargar_excel($imp_pag)
  {
	$datos = $this->get_datos($imp_pag);
    header("Content-Disposition: attachment; filename=\"<?php echo $this->getSingularName() ?>.xls\"");
    header("Content-Type: application/vnd.ms-excel");
		
	if(!empty($datos[0])){
		$flag = false;
		<?php 
			$titulos = $campos = array();
			foreach ($this->configuration->getValue('list.display') as $name => $field) {
				$titulos[] = $field->getConfig('label', '', true);
				$campos[] = '$this->'.$this->renderField($field, 'imp');
			}
		?>		
		$titulos = array('<?php echo implode("', '", $titulos) ?>');
		sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
		foreach($datos as $<?php echo $this->getSingularName() ?>){
			if (!$flag) {
					echo implode("\t", $titulos) . "\r\n";
					$flag = true;
			}			
			$fila_exp = array(<?php echo implode(", ", $campos) ?>);
			$string = implode("\t", array_values($fila_exp));
			echo utf8_decode($string)."\r\n";
		}
	}
				
    return sfView::NONE;
  }  