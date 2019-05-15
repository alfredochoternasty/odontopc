<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Compra', 'doctrine');

/**
 * BaseCompra
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $cuenta_id
 * @property integer $tipofactura_id
 * @property integer $numero
 * @property date $fecha
 * @property integer $proveedor_id
 * @property integer $moneda_id
 * @property string $observacion
 * @property integer $pagado
 * @property integer $usuario
 * @property integer $zona_id
 * @property integer $remito_id
 * @property Proveedor $Proveedor
 * @property Doctrine_Collection $Detalles
 * @property TipoFactura $Tipofactura
 * @property Cuenta $Cuenta
 * @property TipoMoneda $Moneda
 * @property sfGuardUser $sfGuardUser
 * @property Zona $Zona
 * @property Resumen $Remito
 * @property Doctrine_Collection $Lote
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method integer             getCuentaId()       Returns the current record's "cuenta_id" value
 * @method integer             getTipofacturaId()  Returns the current record's "tipofactura_id" value
 * @method integer             getNumero()         Returns the current record's "numero" value
 * @method date                getFecha()          Returns the current record's "fecha" value
 * @method integer             getProveedorId()    Returns the current record's "proveedor_id" value
 * @method integer             getMonedaId()       Returns the current record's "moneda_id" value
 * @method string              getObservacion()    Returns the current record's "observacion" value
 * @method integer             getPagado()         Returns the current record's "pagado" value
 * @method integer             getUsuario()        Returns the current record's "usuario" value
 * @method integer             getZonaId()         Returns the current record's "zona_id" value
 * @method integer             getRemitoId()       Returns the current record's "remito_id" value
 * @method Proveedor           getProveedor()      Returns the current record's "Proveedor" value
 * @method Doctrine_Collection getDetalles()       Returns the current record's "Detalles" collection
 * @method TipoFactura         getTipofactura()    Returns the current record's "Tipofactura" value
 * @method Cuenta              getCuenta()         Returns the current record's "Cuenta" value
 * @method TipoMoneda          getMoneda()         Returns the current record's "Moneda" value
 * @method sfGuardUser         getSfGuardUser()    Returns the current record's "sfGuardUser" value
 * @method Zona                getZona()           Returns the current record's "Zona" value
 * @method Resumen             getRemito()         Returns the current record's "Remito" value
 * @method Doctrine_Collection getLote()           Returns the current record's "Lote" collection
 * @method Compra              setId()             Sets the current record's "id" value
 * @method Compra              setCuentaId()       Sets the current record's "cuenta_id" value
 * @method Compra              setTipofacturaId()  Sets the current record's "tipofactura_id" value
 * @method Compra              setNumero()         Sets the current record's "numero" value
 * @method Compra              setFecha()          Sets the current record's "fecha" value
 * @method Compra              setProveedorId()    Sets the current record's "proveedor_id" value
 * @method Compra              setMonedaId()       Sets the current record's "moneda_id" value
 * @method Compra              setObservacion()    Sets the current record's "observacion" value
 * @method Compra              setPagado()         Sets the current record's "pagado" value
 * @method Compra              setUsuario()        Sets the current record's "usuario" value
 * @method Compra              setZonaId()         Sets the current record's "zona_id" value
 * @method Compra              setRemitoId()       Sets the current record's "remito_id" value
 * @method Compra              setProveedor()      Sets the current record's "Proveedor" value
 * @method Compra              setDetalles()       Sets the current record's "Detalles" collection
 * @method Compra              setTipofactura()    Sets the current record's "Tipofactura" value
 * @method Compra              setCuenta()         Sets the current record's "Cuenta" value
 * @method Compra              setMoneda()         Sets the current record's "Moneda" value
 * @method Compra              setSfGuardUser()    Sets the current record's "sfGuardUser" value
 * @method Compra              setZona()           Sets the current record's "Zona" value
 * @method Compra              setRemito()         Sets the current record's "Remito" value
 * @method Compra              setLote()           Sets the current record's "Lote" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCompra extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('compra');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('cuenta_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('tipofactura_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
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
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('pagado', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 1,
             ));
        $this->hasColumn('usuario', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('remito_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Proveedor', array(
             'local' => 'proveedor_id',
             'foreign' => 'id'));

        $this->hasMany('DetalleCompra as Detalles', array(
             'local' => 'id',
             'foreign' => 'compra_id'));

        $this->hasOne('TipoFactura as Tipofactura', array(
             'local' => 'tipofactura_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Cuenta', array(
             'local' => 'cuenta_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'usuario',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Resumen as Remito', array(
             'local' => 'remito_id',
             'foreign' => 'id'));

        $this->hasMany('Lote', array(
             'local' => 'id',
             'foreign' => 'compra_id'));
    }
}