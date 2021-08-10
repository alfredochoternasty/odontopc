<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pago', 'doctrine');

/**
 * BasePago
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $fecha
 * @property integer $proveedor_id
 * @property integer $moneda_id
 * @property decimal $monto
 * @property integer $tipo_id
 * @property integer $banco_id
 * @property integer $numero
 * @property string $observacion
 * @property string $comprobante
 * @property Proveedor $Proveedor
 * @property TipoCobroPago $Tipo
 * @property TipoMoneda $Moneda
 * @property Banco $Banco
 * @property Compra $Compra
 * 
 * @method integer       getId()           Returns the current record's "id" value
 * @method date          getFecha()        Returns the current record's "fecha" value
 * @method integer       getProveedorId()  Returns the current record's "proveedor_id" value
 * @method integer       getMonedaId()     Returns the current record's "moneda_id" value
 * @method decimal       getMonto()        Returns the current record's "monto" value
 * @method integer       getTipoId()       Returns the current record's "tipo_id" value
 * @method integer       getBancoId()      Returns the current record's "banco_id" value
 * @method integer       getNumero()       Returns the current record's "numero" value
 * @method string        getObservacion()  Returns the current record's "observacion" value
 * @method string        getComprobante()  Returns the current record's "comprobante" value
 * @method Proveedor     getProveedor()    Returns the current record's "Proveedor" value
 * @method TipoCobroPago getTipo()         Returns the current record's "Tipo" value
 * @method TipoMoneda    getMoneda()       Returns the current record's "Moneda" value
 * @method Banco         getBanco()        Returns the current record's "Banco" value
 * @method Compra        getCompra()       Returns the current record's "Compra" value
 * @method Pago          setId()           Sets the current record's "id" value
 * @method Pago          setFecha()        Sets the current record's "fecha" value
 * @method Pago          setProveedorId()  Sets the current record's "proveedor_id" value
 * @method Pago          setMonedaId()     Sets the current record's "moneda_id" value
 * @method Pago          setMonto()        Sets the current record's "monto" value
 * @method Pago          setTipoId()       Sets the current record's "tipo_id" value
 * @method Pago          setBancoId()      Sets the current record's "banco_id" value
 * @method Pago          setNumero()       Sets the current record's "numero" value
 * @method Pago          setObservacion()  Sets the current record's "observacion" value
 * @method Pago          setComprobante()  Sets the current record's "comprobante" value
 * @method Pago          setProveedor()    Sets the current record's "Proveedor" value
 * @method Pago          setTipo()         Sets the current record's "Tipo" value
 * @method Pago          setMoneda()       Sets the current record's "Moneda" value
 * @method Pago          setBanco()        Sets the current record's "Banco" value
 * @method Pago          setCompra()       Sets the current record's "Compra" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePago extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pago');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('proveedor_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('monto', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('tipo_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('banco_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('observacion', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('comprobante', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Proveedor', array(
             'local' => 'proveedor_id',
             'foreign' => 'id'));

        $this->hasOne('TipoCobroPago as Tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Banco', array(
             'local' => 'banco_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Compra', array(
             'local' => 'compra_id',
             'foreign' => 'id'));
    }
}