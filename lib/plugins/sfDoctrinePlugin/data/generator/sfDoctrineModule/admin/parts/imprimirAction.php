  public function executeImprimirPagina(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.page', '1', 'admin_module')-1;
		$consulta->limit(50)->offset($pagina * 50);
    $datos = $consulta->execute();
		$this->descargar_pdf($datos);
  }

  public function executeImprimirTodo(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
    $datos = $consulta->execute();
		$this->descargar_pdf($datos);
  }
  
  public function descargar_pdf($datos)
  {    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imp", array("<?php echo $this->getSingularName() ?>" => $datos)));
    $dompdf->set_paper('A4','<?php echo empty($this->config['list']['paper_orientation'])? 'portrait' : $this->config['list']['paper_orientation'] ?>');
    $dompdf->render();
    $dompdf->stream("<?php echo $this->getSingularName() ?>.pdf");    
    return sfView::NONE;
  }  
  

  public function executeExcelTodo(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
    $datos = $consulta->execute();
    $this->descargar_excel($datos);
  }
  
  public function executeExcelPagina(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.page', '1', 'admin_module')-1;
		$consulta->limit(50)->offset($pagina * 50);	
    $datos = $consulta->execute();
		$this->descargar_excel($datos);
  }
    
  public function descargar_excel($datos)
  {

  }  