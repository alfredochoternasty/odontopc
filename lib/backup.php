<?php
class Backup_Database {
    var $host = '';
    var $username = '';
    var $passwd = '';
    var $dbName = '';
    var $charset = '';
 
    function Backup_Database($charset = 'utf8'){
        $this->host     = 'localhost';
        $this->username = 'odosis';
        $this->passwd   = 'maf/2826';
        $this->dbName   = 'ntiimplantes_db';
        $this->charset  = $charset;
        $this->initializeDatabase();
    }
 
    protected function initializeDatabase(){
        $conn = mysql_connect($this->host, $this->username, $this->passwd);
        mysql_select_db($this->dbName, $conn);
        if (! mysql_set_charset ($this->charset, $conn)){
            mysql_query('SET NAMES '.$this->charset);
        }
    }
 
    function ejecutar_archivo_sql($file_sql){
      $sqls = explode(';', file_get_contents($file_sql));
      try{      
          foreach($sqls as $sql){
          $logs[] = $sql;
          $logs[] = "; -- -> ";          
          $logs[] = mysql_query($sql);
          $logs[] = mysql_num_rows();
          $logs[] = mysql_affected_rows();
          $logs[] = mysql_info();
      }
          $filename = './log/log_sql_'.date("Ymd", time()).'.txt';
          $handle = fopen($filename, 'w+');
          $log = implode('', $logs);
          fwrite($handle, $log);
          fclose($handle);
          unlink($file_sql);
      }
      catch (Exception $e){
          $filename = './log/log_sql_'.date("Ymdhis", time()).'.txt';
          $handle = fopen($filename, 'w+');
          fwrite($handle, $e->getMessage());
          fclose($handle); 
          unlink($file_sql);
      }
    }
    
    public function backupTables($outputDir = './bckp'){
        try{
            $tables = 'banco, cliente, cliente_seguimiento, cobro, cobro_resumen, compra, condicion_fiscal, cuenta_compras, curso, curso_inscripcion, curso_mail_enviado, det_fact_compra, det_lis_precio, detalle_compra, detalle_pedido, detalle_presupuesto, detalle_resumen, detalle_venta, dev_producto, fact_compra, grupoprod, lista_precio, localidad, lote, pago, pago_compra, parametros, pedido, presupuesto, producto, proveedor, provincia, resumen, sf_guard_forgot_password, sf_guard_group, sf_guard_group_permission, sf_guard_permission, sf_guard_remember_key, sf_guard_user, sf_guard_user_group, sf_guard_user_permission, tipo_cliente, tipo_cobro_pago, tipo_contacto, tipo_factura, tipo_inscripcion, tipo_moneda, tipo_respuesta, tipo_tiempo_contac, venta';
            $tables = is_array($tables) ? $tables : explode(', ',$tables);
 
            $sql = 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.";\n\n";
            $sql .= 'USE '.$this->dbName.";\n\n";
 
            foreach($tables as $table){
 
                $result = mysql_query('SELECT * FROM '.$table);
                $numFields = mysql_num_fields($result);
 
                $sql .= 'DROP TABLE IF EXISTS '.$table.';';
                $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
                $sql.= "\n\n".$row2[1].";\n\n";
 
                for ($i = 0; $i < $numFields; $i++){
                    while($row = mysql_fetch_row($result)){
                        $sql .= 'INSERT INTO '.$table.' VALUES(';
                        for($j=0; $j<$numFields; $j++){
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                            if (isset($row[$j]) && $row[$j] != ''){
                                $sql .= '"'.$row[$j].'"' ;
                            }else{
                                $sql.= 'null';
                            }
 
                            if ($j < ($numFields-1)){
                                $sql .= ',';
                            }
                        }
                         $sql.= ");\n";
                    }
                }
                $sql.="\n\n\n"; 
            }
        }
        catch (Exception $e){
            var_dump($e->getMessage());
            return false;
        }
 
        return $this->saveFile($sql, $outputDir);
    }
 
    protected function saveFile(&$sql, $outputDir = '.'){
        if (!$sql) return false;
 
        try{
            $filename = $outputDir.'/'.$this->dbName.'-'.date("Ymd", time()).'.sql';
            $handle = fopen($filename, 'w+');
            fwrite($handle, $sql);
            fclose($handle);
            $zipname = $filename.'.zip';
            $zip = new ZipArchive();
            if($zip->open($zipname,ZIPARCHIVE::CREATE)===true){
              $zip->addFile($filename);
              $zip->close();
              unlink($filename);
            }
        }
        catch (Exception $e){
            $filename = $outputDir.'/'.$this->dbName.'-'.date("Ymdhis", time()).'.sql';
            $handle = fopen($filename, 'w+');
            fwrite($handle, $e->getMessage());
            fclose($handle); 
            return false;
        }
 
        return true;
    }
}

?>