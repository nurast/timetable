<?php

/**
 * TimetableCycle form base class.
 *
 * @method TimetableCycle getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTimetableCycleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'cycle_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cycle'), 'add_empty' => false)),
      'start'    => new sfWidgetFormDate(),
      'finish'   => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cycle_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cycle'))),
      'start'    => new sfValidatorDate(),
      'finish'   => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('timetable_cycle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TimetableCycle';
  }

}
