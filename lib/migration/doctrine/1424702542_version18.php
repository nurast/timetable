<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version18 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('timetable_action_item', 'time_on', 'time', '25', array(
             ));
        $this->addColumn('timetable_item', 'time_on', 'time', '25', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('timetable_action_item', 'time_on');
        $this->removeColumn('timetable_item', 'time_on');
    }
}