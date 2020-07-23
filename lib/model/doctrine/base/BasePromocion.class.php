<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Promocion', 'doctrine');

/**
 * BasePromocion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $estado
 * @property date $fecha_ini
 * @property date $fecha_fin
 * @property integer $tipo_id
 * @property integer $min_cant
 * @property integer $cant_regalo
 * @property integer $porc_desc
 * @property integer $aplica_neto
 * @property integer $lista_id
 * @property Doctrine_Collection $Productos
 * @property Doctrine_Collection $Regalos
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getNombre()      Returns the current record's "nombre" value
 * @method string              getDescripcion() Returns the current record's "descripcion" value
 * @method integer             getEstado()      Returns the current record's "estado" value
 * @method date                getFechaIni()    Returns the current record's "fecha_ini" value
 * @method date                getFechaFin()    Returns the current record's "fecha_fin" value
 * @method integer             getTipoId()      Returns the current record's "tipo_id" value
 * @method integer             getMinCant()     Returns the current record's "min_cant" value
 * @method integer             getCantRegalo()  Returns the current record's "cant_regalo" value
 * @method integer             getPorcDesc()    Returns the current record's "porc_desc" value
 * @method integer             getAplicaNeto()  Returns the current record's "aplica_neto" value
 * @method integer             getListaId()     Returns the current record's "lista_id" value
 * @method Doctrine_Collection getProductos()   Returns the current record's "Productos" collection
 * @method Doctrine_Collection getRegalos()     Returns the current record's "Regalos" collection
 * @method Promocion           setId()          Sets the current record's "id" value
 * @method Promocion           setNombre()      Sets the current record's "nombre" value
 * @method Promocion           setDescripcion() Sets the current record's "descripcion" value
 * @method Promocion           setEstado()      Sets the current record's "estado" value
 * @method Promocion           setFechaIni()    Sets the current record's "fecha_ini" value
 * @method Promocion           setFechaFin()    Sets the current record's "fecha_fin" value
 * @method Promocion           setTipoId()      Sets the current record's "tipo_id" value
 * @method Promocion           setMinCant()     Sets the current record's "min_cant" value
 * @method Promocion           setCantRegalo()  Sets the current record's "cant_regalo" value
 * @method Promocion           setPorcDesc()    Sets the current record's "porc_desc" value
 * @method Promocion           setAplicaNeto()  Sets the current record's "aplica_neto" value
 * @method Promocion           setListaId()     Sets the current record's "lista_id" value
 * @method Promocion           setProductos()   Sets the current record's "Productos" collection
 * @method Promocion           setRegalos()     Sets the current record's "Regalos" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePromocion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('promocion');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('descripcion', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('estado', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 1,
             ));
        $this->hasColumn('fecha_ini', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('fecha_fin', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('tipo_id', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('min_cant', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('cant_regalo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('porc_desc', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('aplica_neto', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('lista_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('PromocionProducto as Productos', array(
             'local' => 'id',
             'foreign' => 'promocion_id'));

        $this->hasMany('PromocionRegalo as Regalos', array(
             'local' => 'id',
             'foreign' => 'promocion_id'));
    }
}