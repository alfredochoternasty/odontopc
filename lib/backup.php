<?php
/**
 * This file contains the Backup_Database class wich performs
 * a partial or complete backup of any given MySQL database
 * @author Daniel López Azaña <http://www.daniloaz.com>
 * @version 1.0
 */
 
// Report all errors
error_reporting(E_ALL);
 
/**
 * Define database parameters here
 */
define("DB_USER", 'odosis');
define("DB_PASSWORD", 'maf/2826');
define("DB_NAME", 'ntiimplantes_db');
define("DB_HOST", 'localhost');
define("OUTPUT_DIR", './bckp');
define("TABLES", 'lote,banco,cliente,cobro,cobro_resumen,compra,condicion_fiscal,cuenta_compras,det_fact_compra,det_lis_precio,detalle_compra,detalle_presupuesto,detalle_resumen,detalle_venta,dev_producto,fact_compra,grupoprod,lista_precio,localidad,pago,pago_compra,presupuesto,producto,proveedor,provincia,resumen,sf_guard_forgot_password,sf_guard_group,sf_guard_group_permission,sf_guard_permission,sf_guard_remember_key,sf_guard_user,sf_guard_user_group,sf_guard_user_permission,tipo_cliente,tipo_cobro_pago,tipo_factura,tipo_moneda,venta,pedido,detalle_pedido,grupoprod2,producto2,traza2');
 
/**
 * Instantiate Backup_Database and perform backup
 */
$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$status = $backupDatabase->backupTables(TABLES, OUTPUT_DIR) ? 'OK' : 'KO';
echo "<br /><br /><br />Backup result: ".$status;
 
/**
 * The Backup_Database class
 */
class Backup_Database {
    /**
     * Host where database is located
     */
    var $host = '';
 
    /**
     * Username used to connect to database
     */
    var $username = '';
 
    /**
     * Password used to connect to database
     */
    var $passwd = '';
 
    /**
     * Database to backup
     */
    var $dbName = '';
 
    /**
     * Database charset
     */
    var $charset = '';
 
    /**
     * Constructor initializes database
     */
    function Backup_Database($host, $username, $passwd, $dbName, $charset = 'utf8')
    {
        $this->host     = $host;
        $this->username = $username;
        $this->passwd   = $passwd;
        $this->dbName   = $dbName;
        $this->charset  = $charset;
 
        $this->initializeDatabase();
    }
 
    protected function initializeDatabase()
    {
        $conn = mysql_connect($this->host, $this->username, $this->passwd);
        mysql_select_db($this->dbName, $conn);
        if (! mysql_set_charset ($this->charset, $conn))
        {
            mysql_query('SET NAMES '.$this->charset);
        }
    }
 
    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'
     * @param string $tables
     */
    public function backupTables($tables = '*', $outputDir = '.')
    {
        try
        {
            /**
            * Tables to export
            */
            if($tables == '*')
            {
                $tables = array();
                $result = mysql_query('SHOW TABLES');
                while($row = mysql_fetch_row($result))
                {
                    $tables[] = $row[0];
                }
            }
            else
            {
                $tables = is_array($tables) ? $tables : explode(',',$tables);
            }
 
            $sql = 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.";\n\n";
            $sql .= 'USE '.$this->dbName.";\n\n";
 
            /**
            * Iterate tables
            */
            foreach($tables as $table)
            {
                echo "Backing up ".$table." table...";
 
                $result = mysql_query('SELECT * FROM '.$table);
                $numFields = mysql_num_fields($result);
 
                $sql .= 'DROP TABLE IF EXISTS '.$table.';';
                $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
                $sql.= "\n\n".$row2[1].";\n\n";
 
                for ($i = 0; $i < $numFields; $i++)
                {
                    while($row = mysql_fetch_row($result))
                    {
                        $sql .= 'INSERT INTO '.$table.' VALUES(';
                        for($j=0; $j<$numFields; $j++)
                        {
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                            if (isset($row[$j]) && $row[$j] != '')
                            {
                                $sql .= '"'.$row[$j].'"' ;
                            }
                            else
                            {
                                $sql.= 'null';
                            }
 
                            if ($j < ($numFields-1))
                            {
                                $sql .= ',';
                            }
                        }
 
                        $sql.= ");\n";
                    }
                }
 
                $sql.="\n\n\n";
 
                echo " OK" . "<br />";
            }
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }
 
        return $this->saveFile($sql, $outputDir);
    }
 
    /**
     * Save SQL to file
     * @param string $sql
     */
    protected function saveFile(&$sql, $outputDir = '.')
    {
        if (!$sql) return false;
 
        try
        {
            //$filename = $outputDir.'/'.$this->dbName.'-'.date("Ymd", time()).'.sql','w+';
            $filename = $outputDir.'/'.$this->dbName.'-'.date("Ymd", time()).'.sql';
            $handle = fopen($filename, 'w+');
            fwrite($handle, $sql);
            fclose($handle);
            $zipname = $filename.'.zip';
            $zip = new ZipArchive();
            if($zip->open($zipname,ZIPARCHIVE::CREATE)===true) {
              $zip->addFile($filename);
              $zip->close();
              unlink($filename);
            }
        }
        catch (Exception $e)
        {
            //var_dump($e->getMessage());
            //$filename = $outputDir.'/'.$this->dbName.'-'.date("Ymd", time()).'.sql','w+';
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