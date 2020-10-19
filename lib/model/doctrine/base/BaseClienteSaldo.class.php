<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ClienteSaldo', 'doctrine');

/**
 * BaseClienteSaldo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $apellido
 * @property string $nombre
 * @property integer $moneda_id
 * @property decimal $saldo
 * @property integer $zona_id
 * @property date $ult_cobro
 * @property date $ult_venta
 * @property TipoMoneda $Moneda
 * @property Zona $Zona
 * 
 * @method integer      getId()        Returns the current record's "id" value
 * @method string       getApellido()  Returns the current record's "apellido" value
 * @method string       getNombre()    Returns the current record's "nombre" value
 * @method integer      getMonedaId()  Returns the current record's "moneda_id" value
 * @method decimal      getSaldo()     Returns the current record's "saldo" value
 * @method integer      getZonaId()    Returns the current record's "zona_id" value
 * @method date         getUltCobro()  Returns the current record's "ult_cobro" value
 * @method date         getUltVenta()  Returns the current record's "ult_venta" value
 * @method TipoMoneda   getMoneda()    Returns the current record's "Moneda" value
 * @method Zona         getZona()      Returns the current record's "Zona" value
 * @method ClienteSaldo setId()        Sets the current record's "id" value
 * @method ClienteSaldo setApellido()  Sets the current record's "apellido" value
 * @method ClienteSaldo setNombre()    Sets the current record's "nombre" value
 * @method ClienteSaldo setMonedaId()  Sets the current record's "moneda_id" value
 * @method ClienteSaldo setSaldo()     Sets the current record's "saldo" value
 * @method ClienteSaldo setZonaId()    Sets the current record's "zona_id" value
 * @method ClienteSaldo setUltCobro()  Sets the current record's "ult_cobro" value
 * @method ClienteSaldo setUltVenta()  Sets the current record's "ult_venta" value
 * @method ClienteSaldo setMoneda()    Sets the current record's "Moneda" value
 * @method ClienteSaldo setZona()      Sets the current record's "Zona" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseClienteSaldo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cliente_saldo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('apellido', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('saldo', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('ult_cobro', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('ult_venta', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}