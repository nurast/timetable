<?php

/**
 * CycleDate form base class.
 *
 * @method CycleDate getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCycleDateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cycle_id' => new sfWidgetFormInputHidden(),
      'start'    => new sfWidgetFormInputHidden(),
      'finish'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'cycle_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cycle_id')), 'empty_value' => $this->getObject()->get('cycle_id'), 'required' => false)),
      'start'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('start')), 'empty_value' => $this->getObject()->get('start'), 'required' => false)),
      'finish'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('finish')), 'empty_value' => $this->getObject()->get('finish'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cycle_date[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CycleDate';
  }

}
