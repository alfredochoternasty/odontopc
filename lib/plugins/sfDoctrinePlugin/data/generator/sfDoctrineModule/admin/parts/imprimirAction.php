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
    header("Content-Disposition: attachment; filename=\"<?php echo $this->getSingularName() ?>.xls\"");
    header("Content-Type: application/vnd.ms-excel");
		
	if(!empty($datos[0])){
		$flag = false;
		<?php 
			$titulos = $campos = array();
			foreach ($this->configuration->getValue('list.display') as $name => $field) {
				$titulos[] = $field->getConfig('label', '', true);
				$campos[] = $this->renderField($field);
			}
		?>		
		$titulos = array('<?php echo implode("', '", $titulos) ?>');
		
		echo '<?php echo $this->getI18NString('list.title') ?>' . "\r\n";
		foreach($datos as $fila){
			if (!$flag) {
					echo implode("\t", $titulos) . "\r\n";
					$flag = true;
			}			
			$fila_exp = array(<?php echo implode("', '", $campos) ?>);
			$string = implode("\t", array_values($fila));
			echo utf8_decode($string)."\r\n";
		}
	}
				
    return sfView::NONE;
  }  