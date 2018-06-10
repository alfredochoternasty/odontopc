<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Proveedor', 'doctrine');

/**
 * BaseProveedor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $cuit
 * @property integer $condicionfiscal_id
 * @property string $razon_social
 * @property string $domicilio
 * @property integer $localidad_id
 * @property string $telefono
 * @property string $email
 * @property string $observacion
 * @property Localidad $Localidad
 * @property Doctrine_Collection $Compras
 * @property CondicionFiscal $Condfiscal
 * @property Doctrine_Collection $Pago
 * @property Doctrine_Collection $FactCompra
 * @property Doctrine_Collection $CtaCteProv
 * @property Doctrine_Collection $ProductoTraza
 * @property Doctrine_Collection $ListadoCompras
 * @property Doctrine_Collection $Traza2
 * @property Doctrine_Collection $compra2
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getCuit()               Returns the current record's "cuit" value
 * @method integer             getCondicionfiscalId()  Returns the current record's "condicionfiscal_id" value
 * @method string              getRazonSocial()        Returns the current record's "razon_social" value
 * @method string              getDomicilio()          Returns the current record's "domicilio" value
 * @method integer             getLocalidadId()        Returns the current record's "localidad_id" value
 * @method string              getTelefono()           Returns the current record's "telefono" value
 * @method string              getEmail()              Returns the current record's "email" value
 * @method string              getObservacion()        Returns the current record's "observacion" value
 * @method Localidad           getLocalidad()          Returns the current record's "Localidad" value
 * @method Doctrine_Collection getCompras()            Returns the current record's "Compras" collection
 * @method CondicionFiscal     getCondfiscal()         Returns the current record's "Condfiscal" value
 * @method Doctrine_Collection getPago()               Returns the current record's "Pago" collection
 * @method Doctrine_Collection getFactCompra()         Returns the current record's "FactCompra" collection
 * @method Doctrine_Collection getCtaCteProv()         Returns the current record's "CtaCteProv" collection
 * @method Doctrine_Collection getProductoTraza()      Returns the current record's "ProductoTraza" collection
 * @method Doctrine_Collection getListadoCompras()     Returns the current record's "ListadoCompras" collection
 * @method Doctrine_Collection getTraza2()             Returns the current record's "Traza2" collection
 * @method Doctrine_Collection getCompra2()            Returns the current record's "compra2" collection
 * @method Proveedor           setId()                 Sets the current record's "id" value
 * @method Proveedor           setCuit()               Sets the current record's "cuit" value
 * @method Proveedor           setCondicionfiscalId()  Sets the current record's "condicionfiscal_id" value
 * @method Proveedor           setRazonSocial()        Sets the current record's "razon_social" value
 * @method Proveedor           setDomicilio()          Sets the current record's "domicilio" value
 * @method Proveedor           setLocalidadId()        Sets the current record's "localidad_id" value
 * @method Proveedor           setTelefono()           Sets the current record's "telefono" value
 * @method Proveedor           setEmail()              Sets the current record's "email" value
 * @method Proveedor           setObservacion()        Sets the current record's "observacion" value
 * @method Proveedor           setLocalidad()          Sets the current record's "Localidad" value
 * @method Proveedor           setCompras()            Sets the current record's "Compras" collection
 * @method Proveedor           setCondfiscal()         Sets the current record's "Condfiscal" value
 * @method Proveedor           setPago()               Sets the current record's "Pago" collection
 * @method Proveedor           setFactCompra()         Sets the current record's "FactCompra" collection
 * @method Proveedor           setCtaCteProv()         Sets the current record's "CtaCteProv" collection
 * @method Proveedor           setProductoTraza()      Sets the current record's "ProductoTraza" collection
 * @method Proveedor           setListadoCompras()     Sets the current record's "ListadoCompras" collection
 * @method Proveedor           setTraza2()             Sets the current record's "Traza2" collection
 * @method Proveedor           setCompra2()            Sets the current record's "compra2" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProveedor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('proveedor');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('cuit', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('condicionfiscal_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('razon_social', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('domicilio', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('localidad_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('telefono', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Localidad', array(
             'local' => 'localidad_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('Compra as Compras', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));

        $this->hasOne('CondicionFiscal as Condfiscal', array(
             'local' => 'condicionfiscal_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('Pago', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));

        $this->hasMany('FactCompra', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));

        $this->hasMany('CtaCteProv', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));

        $this->hasMany('ProductoTraza', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));

        $this->hasMany('ListadoCompras', array(
             'local' => 'id',
             'foreign' => 'prov_id'));

        $this->hasMany('Traza2', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));

        $this->hasMany('compra2', array(
             'local' => 'id',
             'foreign' => 'proveedor_id'));
    }
}