<?php
	
class adminsActions extends sfActions
{
	
	private function backup_tables($host,$user,$pass,$name,$tablas_excluir='')
	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		$fecha_actual = date('Ymd');
		$sql_file = $fecha_actual.'_bak_'.$name.'.sql';
			
		$tablas = array();
		$result = mysql_query('SHOW TABLES');
		while($fila = mysql_fetch_row($result))
			if (!in_array($fila[0], $tablas_excluir) ) 
				$tablas[] = $fila[0];
		
		foreach ($tablas as $tabla) {
			$filas = mysql_query('SELECT * FROM '.$tabla);
			$cantidad = mysql_num_rows($filas);
			$campos = mysql_num_fields($filas);
			
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$tabla));
			file_put_contents($sql_file, $row2[1].";\n\n", FILE_APPEND);
			if ($cantidad > 0) {
				file_put_contents($sql_file, 'INSERT INTO '.$tabla.' VALUES '."\n", FILE_APPEND);
				$s_valores = '';
				for ($i = 0; $i < $cantidad; $i++)	{
						$valores = '';
						$fila = mysql_fetch_row($filas);
						for($j=0; $j < $campos; $j++) {
							$fila[$j] = addslashes($fila[$j]);
							$fila[$j] = str_replace("\n","\\n",$fila[$j]);
							if (isset($fila[$j]) && $fila[$j] != "") { 
								$valores[] = '"'.$fila[$j].'"'; 
							} else { 
								$valores[] = 'null'; 
							}
						}
						
						$s_valores .= "(".implode(',', $valores).")";
						
						if ($i == ($cantidad-1)) {
							$s_valores .= ';'."\n\n";
						} elseif (($i > 0) && ($i % 250) == 0) {
							$s_valores .= ';'."\n";
							$s_valores .= 'INSERT INTO '.$tabla.' VALUES '."\n";
						} else {
							$s_valores .= ','."\n";
						}
				}
				file_put_contents($sql_file, $s_valores, FILE_APPEND);
			}
		}
		
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
	
	private function crear_log($host,$user,$pass,$name,$tablas_excluir='')
	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		// $tables = array();
		// $result = mysql_query('SHOW TABLES');

		$tables = array('zona', 'usuario_zona', 'descuento_zona');
		while($row = mysql_fetch_row($result))
			if (!in_array($row[0], $tablas_excluir) && substr($row[0], 0, 4) != 'log_' )
				$tables[] = $row[0];
		
		foreach ($tables as $table) {
			$result = mysql_query('CREATE TABLE log_'.$table.' like '.$table.';');
			$result = mysql_query('ALTER TABLE log_'.$table.'	CHANGE COLUMN id id INT(11) NOT NULL FIRST,	DROP PRIMARY KEY;');
			$result = mysql_query('ALTER TABLE log_'.$table.'	ADD COLUMN log_id INT(11) NOT NULL AUTO_INCREMENT FIRST,	ADD COLUMN log_fecha DATETIME NOT NULL AFTER log_id,	ADD COLUMN log_operacion VARCHAR(50) NOT NULL AFTER log_fecha,	ADD PRIMARY KEY (log_id);');
		}
	}
	
	private function crear_triggers($host,$user,$pass,$name,$tablas_excluir='')
	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		
		while($row = mysql_fetch_row($result))
			if (!in_array($row[0], $tablas_excluir) && substr($row[0], 0, 4) != 'log_' )
				$tables[] = $row[0];

		$acciones = array('ti_' => 'INSERT', 'tu_' => 'UPDATE', 'td_' => 'DELETE');
		$sql = "
			DROP TRIGGER IF EXISTS {{nom_trigger}};
			DELIMITER $$
			CREATE TRIGGER {{nom_trigger}} AFTER {{operacion}} ON {{tabla}}
			FOR EACH ROW
			BEGIN
				INSERT INTO log_{{tabla}} (log_fecha, log_operacion, {{campos}})
				VALUES(NOW(), '{{operacion}}', {{valores}});
			END$$
			DELIMITER ;
		";
		$buscar = array('{{nom_trigger}}', '{{operacion}}', '{{tabla}}', '{{campos}}', '{{valores}}');
		
		foreach ($tables as $table) {
			$result = mysql_query('DESCRIBE '.$table.';');
			$campos = '';
			while($row = mysql_fetch_row($result)) {
				$campos[] = $row[0];
			}			
			foreach ($acciones as $pre => $accion) {
				$tiempo = $accion == 'DELETE'? 'OLD.':'NEW.';
				$reemplazar = array($pre.$table, $accion, $table, implode(', ', $campos), $tiempo.implode(', '.$tiempo, $campos));
				$ejecutar = str_replace($buscar, $reemplazar, $sql);
				$resultado = mysql_query($ejecutar);
				$file = fopen("triggers.sql", "a");
				fwrite($file, $ejecutar . PHP_EOL);
				fclose($file);
			}
		}
		return $resultado;
	}	
	
	public function executeIndex(sfWebRequest $request)
	{	
		$fecha_actual = date('Ymd');
		$sql_file = $fecha_actual.'_bak_'.$name.'.sql';
		
    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=ventas', 'root', '');
		$dump->start($sql_file);

		// borro el .zip anterior
		$fecha_backup_anterior = date('Ymd', strtotime($fecha_actual."- 1 days"));
		if(file_exists($fecha_backup_anterior.'_bak_'.$name.'.zip')) unlink($fecha_backup_anterior.'_bak_'.$name.'.zip');
		
		$zip = new ZipArchive();
		$filename = $fecha_actual.'_bak_'.$name.'.zip';
		$zip->open($filename, ZipArchive::CREATE);
		$zip->addFile($sql_file);
		$zip->close();
		
		if(file_exists($sql_file)) unlink($sql_file);		
		
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
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
			'ventas_zona',
			'vta_fact',
			'facturas_afip',
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
			'ventas_zona',
			'vta_fact',
			'facturas_afip',
			'lista_precio_detalle'
		);

		$entorno = sfConfig::get('sf_environment');
		if ($entorno == 'dev') {
			$this->result = $this->crear_triggers('localhost','root','','ventas', $tbl_excluir);
			$this->setTemplate('index');
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
