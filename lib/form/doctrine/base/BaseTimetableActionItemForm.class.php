<?php

/**
 * TimetableActionItem form base class.
 *
 * @method TimetableActionItem getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTimetableActionItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'timetable_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Timetable'), 'add_empty' => false)),
      'entity_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TimetableCycleAction'), 'add_empty' => false)),
      'hour_count'           => new sfWidgetFormInputText(),
      'date'                 => new sfWidgetFormDate(),
      'is_lecture'           => new sfWidgetFormInputCheckbox(),
      'class'                => new sfWidgetFormInputText(),
      'brigade'              => new sfWidgetFormInputText(),
      'session'              => new sfWidgetFormInputText(),
      'is_telecommunication' => new sfWidgetFormInputCheckbox(),
      'time_on'              => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'timetable_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Timetable'))),
      'entity_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TimetableCycleAction'))),
      'hour_count'           => new sfValidatorInteger(),
      'date'                 => new sfValidatorDate(),
      'is_lecture'           => new sfValidatorBoolean(),
      'class'                => new sfValidatorInteger(array('required' => false)),
      'brigade'              => new sfValidatorInteger(array('required' => false)),
      'session'              => new sfValidatorInteger(array('required' => false)),
      'is_telecommunication' => new sfValidatorBoolean(array('required' => false)),
      'time_on'              => new sfValidatorTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('timetable_action_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TimetableActionItem';
  }

}
