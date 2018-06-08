<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PagoCompra', 'doctrine');

/**
 * BasePagoCompra
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $pago_id
 * @property integer $compra_id
 * @property decimal $monto
 * @property Pago $Pago
 * @property Compra $Compra
 * 
 * @method integer    getPagoId()    Returns the current record's "pago_id" value
 * @method integer    getCompraId()  Returns the current record's "compra_id" value
 * @method decimal    getMonto()     Returns the current record's "monto" value
 * @method Pago       getPago()      Returns the current record's "Pago" value
 * @method Compra     getCompra()    Returns the current record's "Compra" value
 * @method PagoCompra setPagoId()    Sets the current record's "pago_id" value
 * @method PagoCompra setCompraId()  Sets the current record's "compra_id" value
 * @method PagoCompra setMonto()     Sets the current record's "monto" value
 * @method PagoCompra setPago()      Sets the current record's "Pago" value
 * @method PagoCompra setCompra()    Sets the current record's "Compra" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePagoCompra extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pago_compra');
        $this->hasColumn('pago_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('compra_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('monto', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pago', array(
             'local' => 'pago_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Compra', array(
             'local' => 'compra_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}