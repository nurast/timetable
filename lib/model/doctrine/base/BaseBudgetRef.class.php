<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('BudgetRef', 'doctrine');

/**
 * BaseBudgetRef
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Cycle
 * @property Doctrine_Collection $Managercycle
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getName()         Returns the current record's "name" value
 * @method Doctrine_Collection getCycle()        Returns the current record's "Cycle" collection
 * @method Doctrine_Collection getManagercycle() Returns the current record's "Managercycle" collection
 * @method BudgetRef           setId()           Sets the current record's "id" value
 * @method BudgetRef           setName()         Sets the current record's "name" value
 * @method BudgetRef           setCycle()        Sets the current record's "Cycle" collection
 * @method BudgetRef           setManagercycle() Sets the current record's "Managercycle" collection
 * 
 * @package    timetable
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBudgetRef extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('budget_ref');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Cycle', array(
             'local' => 'id',
             'foreign' => 'budget_id'));

        $this->hasMany('Managercycle', array(
             'local' => 'id',
             'foreign' => 'budjet_id'));
    }
}