<?php

class adminsActions extends sfActions
{
	
	private function backup_tables($host,$user,$pass,$name,$tables_exclude='')
	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
			if (!in_array($row[0], $tables_exclude) ) 
				$tables[] = $row[0];
		
		$return = '';
		foreach($tables as $table)
		{
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysql_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j < $num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j]) && $row[$j] != "") { $return.= '"'.$row[$j].'"' ; } else { $return.= 'null'; }
						if ($j < ($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}		
		
		$fecha_actual = date('Ymd');
		
		$sql_file = $fecha_actual.'_bak_'.$name.'.sql';
		$handle = fopen($sql_file,'w+');
		fwrite($handle,$return);
		fclose($handle);
		
		// borro el .zip anterior
		$fecha_backup_anterior = date('Ymd', strtotime($fecha_actual."- 1 days"));
    if(file_exists($fecha_backup_anterior.'_bak_'.$name.'.zip')) unlink($fecha_backup_anterior.'_bak_'.$name.'.zip');		
		
		$zip = new ZipArchive();
		$filename = $fecha_actual.'_bak_'.$name.'.zip';
		$zip->open($filename, ZipArchive::CREATE);
		$zip->addFile($sql_file);
		$zip->close();
		
		if(file_exists($sql_file)) unlink($sql_file);		
		
		return $filename;
	}	
	
	private function crear_log($host,$user,$pass,$name,$tables_exclude='')
	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		
		while($row = mysql_fetch_row($result))
			if (!in_array($row[0], $tables_exclude) && substr($row[0], 0, 4) != 'log_' )
				$tables[] = $row[0];
		
		foreach ($tables as $table) {
			$result = mysql_query('CREATE TABLE log_'.$table.' like '.$table.';');
			$result = mysql_query('ALTER TABLE log_'.$table.'	CHANGE COLUMN id id INT(11) NOT NULL FIRST,	DROP PRIMARY KEY;');
			$result = mysql_query('ALTER TABLE log_'.$table.'	ADD COLUMN log_id INT(11) NOT NULL AUTO_INCREMENT FIRST,	ADD COLUMN log_fecha DATETIME NOT NULL AFTER log_id,	ADD COLUMN log_operacion VARCHAR(50) NOT NULL AFTER log_fecha,	ADD PRIMARY KEY (log_id);');
		}
	}
	
	private function crear_triggers($host,$user,$pass,$name,$tables_exclude='')
	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		
		while($row = mysql_fetch_row($result))
			if (!in_array($row[0], $tables_exclude) && substr($row[0], 0, 4) != 'log_' )
				$tables[] = $row[0];
		
		foreach ($tables as $table) {
			$result = mysql_query('DESCRIBE '.$table.';');
			$campos = '';
			while($row = mysql_fetch_row($result)) {
				$campos[] = $row[0];
			}
			
			$sql = "
				CREATE TRIGGER {{nom_trigger}} AFTER {{operacion}} ON {{tabla}}
				FOR EACH ROW
				BEGIN
					INSERT INTO log_{{tabla}} (log_fecha, log_operacion, {{campos}})
					VALUES(NOW(), '{{operacion}}', {{valores}});
				END;
			";
			
			$buscar = array('{{nom_trigger}}', '{{operacion}}', '{{tabla}}', '{{campos}}', '{{valores}}');
			$reemplazar = array('ti_'.$table, 'INSERT', $table, implode(', ', $campos), 'NEW.'.implode(', NEW.', $campos));

			$result = mysql_query(str_replace($buscar, $reemplazar, $sql));
			
			$buscar = array('{{nom_trigger}}', '{{operacion}}', '{{tabla}}', '{{campos}}', '{{valores}}');
			$reemplazar = array('tu_'.$table, 'UPDATE', $table, implode(', ', $campos), 'OLD.'.implode(', OLD.', $campos));
			$result = mysql_query(str_replace($buscar, $reemplazar, $sql));
			
			$buscar = array('{{nom_trigger}}', '{{operacion}}', '{{tabla}}', '{{campos}}', '{{valores}}');
			$reemplazar = array('td_'.$table, 'DELETE', $table, implode(', ', $campos), 'OLD.'.implode(', OLD.', $campos));
			$result = mysql_query(str_replace($buscar, $reemplazar, $sql));
		}
	}	
	
  public function executeIndex(sfWebRequest $request)
  {		
		$tbl_excluir = array(
			'cliente_saldo', 
			'cliente_ultima_compra', 
			'comp_fact', 'control_stock', 
			'cta_cte', 
			'cta_cte_prov', 
			'listado_cobros', 
			'listado_compras', 
			'listado_ventas', 
			'producto_traza', 
			'vta_fact',
			'lista_precio_detalle'
		);

    $entorno = sfConfig::get('sf_environment');
    if ($entorno == 'dev') {
			$filename = $this->backup_tables('localhost','root','','ntiimplantes_db', $tbl_excluir);
		} else {
			$oCurrentConnection = Doctrine_Manager::getInstance()->getCurrentConnection();
			list($host, $db) = explode(';', $oCurrentConnection->getOption('dsn'));
			list($aux, $sdb) = explode('=', $db);
			$user = $oCurrentConnection->getOption('username');
			$pwd = $oCurrentConnection->getOption('password');
			
			$filename = $this->backup_tables('localhost', $user, $pwd, $sdb, $tbl_excluir);
		}
		
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array('alfredochoternasty@gmail.com' => 'NTI implantes'));
		$mensaje->setTo(array('alfredochoternasty@gmail.com' => 'Backup Sistema'));
		if(file_exists($filename)){
			$mensaje->attach(Swift_Attachment::fromPath($filename));
			if ($sdb == 'ventas') {
				$mensaje->setSubject('backup blanco NTI');
				$mensaje->setBody('aca esta el backup blanco');
			} else {
				$mensaje->setSubject('backup negro NTI');
				$mensaje->setBody('aca esta el backup negro');
			}
		} else {
				$mensaje->setSubject('error en backup NTI');
				$mensaje->setBody('no se hizo el backup de '.$sdb);
		}
		$mensaje->setContentType("text/html");
		$this->getMailer()->send($mensaje);
  }  

	public function executeLog(sfWebRequest $request)
  {		
		$tbl_excluir = array(
			'cliente_saldo', 
			'cliente_ultima_compra', 
			'comp_fact', 'control_stock', 
			'cta_cte', 
			'cta_cte_prov', 
			'listado_cobros', 
			'listado_compras', 
			'listado_ventas', 
			'producto_traza', 
			'vta_fact',
			'lista_precio_detalle'
		);

    $entorno = sfConfig::get('sf_environment');
    if ($entorno == 'dev') {
			$filename = $this->crear_log('localhost','root','','ventas', $tbl_excluir);
		} else {
			$oCurrentConnection = Doctrine_Manager::getInstance()->getCurrentConnection();
			list($host, $db) = explode(';', $oCurrentConnection->getOption('dsn'));
			list($aux, $sdb) = explode('=', $db);
			$user = $oCurrentConnection->getOption('username');
			$pwd = $oCurrentConnection->getOption('password');
			
			$filename = $this->crear_log('localhost', $user, $pwd, $sdb, $tbl_excluir);
		}
  }
	
	public function executeTriggers(sfWebRequest $request)
  {		
		$tbl_excluir = array(
			'cliente_saldo', 
			'cliente_ultima_compra', 
			'comp_fact', 'control_stock', 
			'cta_cte', 
			'cta_cte_prov', 
			'listado_cobros', 
			'listado_compras', 
			'listado_ventas', 
			'producto_traza', 
			'vta_fact',
			'lista_precio_detalle'
		);

    $entorno = sfConfig::get('sf_environment');
    if ($entorno == 'dev') {
			$filename = $this->crear_triggers('localhost','root','','ventas', $tbl_excluir);
		} else {
			$oCurrentConnection = Doctrine_Manager::getInstance()->getCurrentConnection();
			list($host, $db) = explode(';', $oCurrentConnection->getOption('dsn'));
			list($aux, $sdb) = explode('=', $db);
			$user = $oCurrentConnection->getOption('username');
			$pwd = $oCurrentConnection->getOption('password');
			
			$filename = $this->crear_triggers('localhost', $user, $pwd, $sdb, $tbl_excluir);
		}
  }
	
}
