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
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j < ($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}		
		
		$fecha_actual = date('Ymd');
		
		$sql_file = 'bckp/'.$fecha_actual.'_bak_'.$name.'.sql';
		$handle = fopen($sql_file,'w+');
		fwrite($handle,$return);
		fclose($handle);
		
		// borro el .zip anterior
		$fecha_backup_anterior = date('Ymd', strtotime($fecha_actual."- 1 days"));
    unlink('bckp/'.$fecha_backup_anterior.'_bak_'.$name.'.zip');		
		
		$zip = new ZipArchive();
		$filename = 'bckp/'.$fecha_actual.'_bak_'.$name.'.zip';
		$zip->open($filename, ZipArchive::CREATE);
		$zip->addFile($sql_file);
		$zip->close();
		
		unlink($sql_file);		
		
		return $filename;
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
		$mensaje->setBody('aca esta el backup');
		if ($sdb == 'ventas') {
			$mensaje->setSubject('backup blanco NTI');
		} else {
			$mensaje->setSubject('backup negro NTI');
		}
		$mensaje->attach(Swift_Attachment::fromPath($filename));
		$mensaje->setContentType("text/html");
		$this->getMailer()->send($mensaje);
  }
}
