<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TipoMoneda', 'doctrine');

/**
 * BaseTipoMoneda
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $simbolo
 * @property Doctrine_Collection $Resumenes
 * @property Doctrine_Collection $Ventas
 * @property Doctrine_Collection $Cobros
 * @property Doctrine_Collection $Compras
 * @property Doctrine_Collection $Producto
 * @property Doctrine_Collection $DetalleResumen
 * @property Doctrine_Collection $CtaCte
 * @property Doctrine_Collection $ListaPrecio
 * @property Doctrine_Collection $ListadoCobros
 * @property Doctrine_Collection $ListadoCompras
 * @property Doctrine_Collection $ClienteSaldo
 * @property Doctrine_Collection $ListaPrecioDetalle
 * @property Doctrine_Collection $PagoComision
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getNombre()             Returns the current record's "nombre" value
 * @method string              getSimbolo()            Returns the current record's "simbolo" value
 * @method Doctrine_Collection getResumenes()          Returns the current record's "Resumenes" collection
 * @method Doctrine_Collection getVentas()             Returns the current record's "Ventas" collection
 * @method Doctrine_Collection getCobros()             Returns the current record's "Cobros" collection
 * @method Doctrine_Collection getCompras()            Returns the current record's "Compras" collection
 * @method Doctrine_Collection getProducto()           Returns the current record's "Producto" collection
 * @method Doctrine_Collection getDetalleResumen()     Returns the current record's "DetalleResumen" collection
 * @method Doctrine_Collection getCtaCte()             Returns the current record's "CtaCte" collection
 * @method Doctrine_Collection getListaPrecio()        Returns the current record's "ListaPrecio" collection
 * @method Doctrine_Collection getListadoCobros()      Returns the current record's "ListadoCobros" collection
 * @method Doctrine_Collection getListadoCompras()     Returns the current record's "ListadoCompras" collection
 * @method Doctrine_Collection getClienteSaldo()       Returns the current record's "ClienteSaldo" collection
 * @method Doctrine_Collection getListaPrecioDetalle() Returns the current record's "ListaPrecioDetalle" collection
 * @method Doctrine_Collection getPagoComision()       Returns the current record's "PagoComision" collection
 * @method TipoMoneda          setId()                 Sets the current record's "id" value
 * @method TipoMoneda          setNombre()             Sets the current record's "nombre" value
 * @method TipoMoneda          setSimbolo()            Sets the current record's "simbolo" value
 * @method TipoMoneda          setResumenes()          Sets the current record's "Resumenes" collection
 * @method TipoMoneda          setVentas()             Sets the current record's "Ventas" collection
 * @method TipoMoneda          setCobros()             Sets the current record's "Cobros" collection
 * @method TipoMoneda          setCompras()            Sets the current record's "Compras" collection
 * @method TipoMoneda          setProducto()           Sets the current record's "Producto" collection
 * @method TipoMoneda          setDetalleResumen()     Sets the current record's "DetalleResumen" collection
 * @method TipoMoneda          setCtaCte()             Sets the current record's "CtaCte" collection
 * @method TipoMoneda          setListaPrecio()        Sets the current record's "ListaPrecio" collection
 * @method TipoMoneda          setListadoCobros()      Sets the current record's "ListadoCobros" collection
 * @method TipoMoneda          setListadoCompras()     Sets the current record's "ListadoCompras" collection
 * @method TipoMoneda          setClienteSaldo()       Sets the current record's "ClienteSaldo" collection
 * @method TipoMoneda          setListaPrecioDetalle() Sets the current record's "ListaPrecioDetalle" collection
 * @method TipoMoneda          setPagoComision()       Sets the current record's "PagoComision" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoMoneda extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_moneda');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('simbolo', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Resumen as Resumenes', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('Venta as Ventas', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('Cobro as Cobros', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('Compra as Compras', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('Producto', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('DetalleResumen', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('CtaCte', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('ListaPrecio', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('ListadoCobros', array(
             'local' => 'id',
             'foreign' => 'moneda'));

        $this->hasMany('ListadoCompras', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('ClienteSaldo', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('ListaPrecioDetalle', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));

        $this->hasMany('PagoComision', array(
             'local' => 'id',
             'foreign' => 'moneda_id'));
    }
}