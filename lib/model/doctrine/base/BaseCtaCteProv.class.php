<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CtaCteProv', 'doctrine');

/**
 * BaseCtaCteProv
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $concepto
 * @property integer $numero
 * @property date $fecha
 * @property integer $proveedor_id
 * @property integer $cuenta_id
 * @property integer $moneda_id
 * @property decimal $debe
 * @property decimal $haber
 * @property string $observacion
 * @property Proveedor $Proveedor
 * @property TipoMoneda $Moneda
 * @property Cuenta $Cuenta
 * 
 * @method integer    getId()           Returns the current record's "id" value
 * @method string     getConcepto()     Returns the current record's "concepto" value
 * @method integer    getNumero()       Returns the current record's "numero" value
 * @method date       getFecha()        Returns the current record's "fecha" value
 * @method integer    getProveedorId()  Returns the current record's "proveedor_id" value
 * @method integer    getCuentaId()     Returns the current record's "cuenta_id" value
 * @method integer    getMonedaId()     Returns the current record's "moneda_id" value
 * @method decimal    getDebe()         Returns the current record's "debe" value
 * @method decimal    getHaber()        Returns the current record's "haber" value
 * @method string     getObservacion()  Returns the current record's "observacion" value
 * @method Proveedor  getProveedor()    Returns the current record's "Proveedor" value
 * @method TipoMoneda getMoneda()       Returns the current record's "Moneda" value
 * @method Cuenta     getCuenta()       Returns the current record's "Cuenta" value
 * @method CtaCteProv setId()           Sets the current record's "id" value
 * @method CtaCteProv setConcepto()     Sets the current record's "concepto" value
 * @method CtaCteProv setNumero()       Sets the current record's "numero" value
 * @method CtaCteProv setFecha()        Sets the current record's "fecha" value
 * @method CtaCteProv setProveedorId()  Sets the current record's "proveedor_id" value
 * @method CtaCteProv setCuentaId()     Sets the current record's "cuenta_id" value
 * @method CtaCteProv setMonedaId()     Sets the current record's "moneda_id" value
 * @method CtaCteProv setDebe()         Sets the current record's "debe" value
 * @method CtaCteProv setHaber()        Sets the current record's "haber" value
 * @method CtaCteProv setObservacion()  Sets the current record's "observacion" value
 * @method CtaCteProv setProveedor()    Sets the current record's "Proveedor" value
 * @method CtaCteProv setMoneda()       Sets the current record's "Moneda" value
 * @method CtaCteProv setCuenta()       Sets the current record's "Cuenta" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCtaCteProv extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cta_cte_prov');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('concepto', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
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
        $this->hasColumn('cuenta_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('debe', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('haber', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Proveedor', array(
             'local' => 'proveedor_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Cuenta', array(
             'local' => 'cuenta_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}