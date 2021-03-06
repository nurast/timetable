<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version15 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('timetable_action_item', 'timetable_action_item_entity_id_timetable_cycle_action_id', array(
             'name' => 'timetable_action_item_entity_id_timetable_cycle_action_id',
             'local' => 'entity_id',
             'foreign' => 'id',
             'foreignTable' => 'timetable_cycle_action',
             ));

        $this->addIndex('timetable_action_item', 'timetable_action_item_entity_id', array(
             'fields' => 
             array(
              0 => 'entity_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('timetable_action_item', 'timetable_action_item_entity_id_timetable_cycle_action_id');
        $this->removeIndex('timetable_action_item', 'timetable_action_item_entity_id', array(
             'fields' => 
             array(
              0 => 'entity_id',
             ),
             ));
    }
}