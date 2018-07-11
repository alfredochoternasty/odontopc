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
		$sql_file = date('Ymd').'_bak_'.$name.'.sql';
		$handle = fopen($sql_file,'w+');
		fwrite($handle,$return);
		fclose($handle);
		
		$zip = new ZipArchive();
		$filename = date('Ymd').'_bak_'.$name.'.zip';
		$zip->open($filename, ZipArchive::CREATE);
		$zip->addFile($sql_file);
		$zip->close();
		
		unlink($sql_file);
		
		return $filename;
	}	
	
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
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
			'vta_fact'
		);
				
		//$filename_1 = $this->backup_tables('localhost','odosis','maf/2826','ntiimplantes_db', $tbl_excluir);
		$filename_1 = $this->backup_tables('localhost','root','','ntiimplantes_db', $tbl_excluir);
		//$filename_2 = $this->backup_tables('localhost','ventas','maf/2826','ventas', $tbl_excluir);
		$filename_2 = $this->backup_tables('localhost','root','','ventas', $tbl_excluir);
		
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array('alfredochoternasty@gmail.com' => 'NTI implantes'));
		$mensaje->setTo(array('alfredochoternasty@gmail.com' => 'Backup Sistema'));
		$mensaje->setBody('aca esta el backup');
		$mensaje->attach(Swift_Attachment::fromPath($filename_1));
		$mensaje->attach(Swift_Attachment::fromPath($filename_2));
		$mensaje->setContentType("text/html");
		$this->getMailer()->send($mensaje);
  }
}
