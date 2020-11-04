  public function executeVolver(sfWebRequest $request)
  {
		$this->redirect('@<?php echo $this->getUrlForAction('index') ?>');
  }
  
  public function executeListImprimirPagina(sfWebRequest $request)
  {
    $this->descargar_pdf(true);
  }

  public function executeListImprimirTodo(sfWebRequest $request)
  {
    $_hasFilters = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    if (empty($_hasFilters)) {
      $this->getUser()->setFlash('error', 'Para poder imprimir todo debe realizar un filtro');
      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    } else {
      $this->descargar_pdf(false);
    }
  }
  
  public function get_datos($p_imp_pagina=false)
  {
    $consulta = $this->buildQuery($this->getFilters());
    if ($p_imp_pagina) {
        $pagina = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.page', '1', 'admin_module')-1;
        $limit = <?php echo isset($this->config['list']['max_per_page']) ? (integer) $this->config['list']['max_per_page'] : 20 ?>;
        $consulta->limit($limit)->offset($pagina * $limit);
    }
    return $consulta->execute();
  }
  
  public function getModoImpresion()
  {
    return 'portrait';
  }
  
  public function descargar_pdf($imp_pag=false)
  {
    $datos = $this->get_datos($imp_pag);
    $dompdf = new DOMPDF();
    $_hasFilters = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $dompdf->load_html($this->getPartial("imp", array("<?php echo $this->getSingularName() ?>s" => $datos, 'configuration' => $this->configuration, 'filters' => $this->filters, 'hasFilters' => $_hasFilters)));
    $dompdf->set_paper('A4',$this->getModoImpresion());
    $dompdf->render();
    $dompdf->stream("<?php echo $this->getSingularName() ?>.pdf");    
    return sfView::NONE;
  }  
  

  public function executeListExcelTodo(sfWebRequest $request)
  {
    $this->descargar_excel(false);
    return sfView::NONE;
  }
  
  public function executeListExcelPagina(sfWebRequest $request)
  {
    $_hasFilters = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    if (empty($_hasFilters)) {
      $this->getUser()->setFlash('error', 'Para poder imprimir todo debe realizar un filtro');
      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    } else {
      $this->descargar_excel(true);
    }
    return sfView::NONE;
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
          $imprimir = $this->configuration->getValue('show.display');
          foreach ($this->configuration->getValue('list.display') as $name => $field) {
            if (in_array($name, $imprimir) || in_array('_'.$name, $imprimir)) {
              $titulos[] = $field->getConfig('label', '', true);
              $campos[] = $this->renderField($field);
            }
          }
        ?>		
        $titulos = array('<?php echo implode("', '", $titulos) ?>');
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial', 'I18N);');
        foreach($datos as $<?php echo $this->getSingularName() ?>){
          if (!$flag) {
              echo implode("\t", $titulos) . "\r\n";
              $flag = true;
          }			
          $fila_exp = array(<?php echo "strip_tags(".implode("), strip_tags(", $campos).")" ?>);
          $string = implode("\t", array_values($fila_exp));
          echo utf8_decode($string)."\r\n";
        }
    }
		return sfView::NONE;
  }
