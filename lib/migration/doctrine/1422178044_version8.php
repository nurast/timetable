<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version8 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('timetable', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'cycle_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '4',
             ),
             'start' => 
             array(
              'type' => 'date',
              'notnull' => '1',
              'length' => '25',
             ),
             'finish' => 
             array(
              'type' => 'date',
              'notnull' => '1',
              'length' => '25',
             ),
             'brigade_count' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
        $this->createTable('timetable_item', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'timetable_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'timetable_cycle_subject_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'hour_count' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'date' => 
             array(
              'type' => 'date',
              'notnull' => '1',
              'length' => '25',
             ),
             'is_lecture' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'length' => '25',
             ),
             'class' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'brigade' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'session' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('timetable');
        $this->dropTable('timetable_item');
    }
}