<?php
	echo '<div id="filtro_utilizado" style="text-align:center"> Filtro utilizado: ';
	foreach ($configuration->getFormFilterFields($filters) as $name => $field) {
		@$valor = $hasFilters->getRaw($name);
		@$tipo = $field->getType();
		if (isset($valor)) {
			switch($tipo){
				case 'ForeignKey':
					if (!empty($valor)) {
						$opciones = $filters->getWidget($name)->getOptions();
						$valor = Doctrine::getTable($opciones['model'])->find($valor);
					}
					break;
				case 'Date':
					if (is_array($valor) && array_key_exists('from', $valor)) {
						$desde = implode('/', array_reverse(explode('-', $valor['from'])));
						$h = explode(' ', $valor['to']);
						$hasta = implode('/', array_reverse(explode('-', $h[0])));
						if (empty($hasta)) 
							$valor = $desde;
						else 
							$valor = "desde: $desde hasta $hasta";
					} else{
						$valor = implode('/', array_reverse(explode('-', $valor)));
					}
					break;
				case 'Text':
					if (!empty($valor['text']))
						$valor = $valor['text'];
					else 
						$valor = null;
					break;
				case 'Boolean':
					$valor = $valor==1?'Si':'No';
					break;
			}
			if (isset($valor)) {
				$tag = empty($filters[$name]->renderLabel())?$name:$filters[$name]->renderLabel();
				echo $tag.' = '.$valor.' - ';
			}
		}
	}
	echo '</div>';		
?>