<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CobroResumen', 'doctrine');

/**
 * BaseCobroResumen
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cobro_id
 * @property integer $resumen_id
 * @property decimal $monto
 * @property Cobro $Cobro
 * @property Resumen $Resumen
 * 
 * @method integer      getCobroId()    Returns the current record's "cobro_id" value
 * @method integer      getResumenId()  Returns the current record's "resumen_id" value
 * @method decimal      getMonto()      Returns the current record's "monto" value
 * @method Cobro        getCobro()      Returns the current record's "Cobro" value
 * @method Resumen      getResumen()    Returns the current record's "Resumen" value
 * @method CobroResumen setCobroId()    Sets the current record's "cobro_id" value
 * @method CobroResumen setResumenId()  Sets the current record's "resumen_id" value
 * @method CobroResumen setMonto()      Sets the current record's "monto" value
 * @method CobroResumen setCobro()      Sets the current record's "Cobro" value
 * @method CobroResumen setResumen()    Sets the current record's "Resumen" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCobroResumen extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cobro_resumen');
        $this->hasColumn('cobro_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('resumen_id', 'integer', 4, array(
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
        $this->hasOne('Cobro', array(
             'local' => 'cobro_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Resumen', array(
             'local' => 'resumen_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}