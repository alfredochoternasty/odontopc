<?php
	echo '<div style="text-align:center"> Filtro utilizado: ';
	foreach ($configuration->getFormFilterFields($filters) as $name => $field) {
		@$valor = $hasFilters->getRaw($name);
		$tipo = $field->getType();
		switch($tipo){
			case 'ForeignKey':
				if (!empty($valor))
					$valor = Doctrine::getTable(ucfirst(str_replace('_id', '', $name)))->find($valor);
				break;
			case 'Date':
				if (array_key_exists('from', $valor)) {
					$desde = implode('/', array_reverse(explode('-', $valor['from'])));
					$h = explode(' ', $valor['to']);
					$hasta = implode('/', array_reverse(explode('-', $h[0])));
					if (empty($hasta)) 
						$valor = $desde;
					else 
						$valor = "desde: $desde hasta $hasta";
				}
				break;
			case 'Text':
				if (!empty($valor['text']))
					$valor = $valor['text'];
				else 
					$valor = '';
				break;
			case 'Boolean':
				$valor = $valor==1?'Si':'No';
				break;
		}
		if (!empty($valor)) {
			$tag = empty($filters[$name]->renderLabel())?$name:$filters[$name]->renderLabel();
			echo $tag.' = '.$valor.' - ';
		}
	}
	echo '</div>';		
?>