<?php

/**
 * TimetableCycleAction form base class.
 *
 * @method TimetableCycleAction getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTimetableCycleActionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'cycle_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cycle'), 'add_empty' => false)),
      'timetable_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Timetable'), 'add_empty' => true)),
      'action_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TimetableAction'), 'add_empty' => false)),
      'teacher_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TeacherRef'), 'add_empty' => true)),
      'teacher_contraction' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cycle_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cycle'))),
      'timetable_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Timetable'), 'required' => false)),
      'action_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TimetableAction'))),
      'teacher_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TeacherRef'), 'required' => false)),
      'teacher_contraction' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('timetable_cycle_action[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TimetableCycleAction';
  }

}
