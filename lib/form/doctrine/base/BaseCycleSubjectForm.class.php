<?php

/**
 * CycleSubject form base class.
 *
 * @method CycleSubject getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCycleSubjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cycle_id'      => new sfWidgetFormInputHidden(),
      'subject_id'    => new sfWidgetFormInputHidden(),
      'all'           => new sfWidgetFormInputText(),
      'all_corr'      => new sfWidgetFormInputText(),
      'theory'        => new sfWidgetFormInputText(),
      'theory_corr'   => new sfWidgetFormInputText(),
      'practice'      => new sfWidgetFormInputText(),
      'practice_corr' => new sfWidgetFormInputText(),
      'group'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cycle_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cycle_id')), 'empty_value' => $this->getObject()->get('cycle_id'), 'required' => false)),
      'subject_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('subject_id')), 'empty_value' => $this->getObject()->get('subject_id'), 'required' => false)),
      'all'           => new sfValidatorInteger(),
      'all_corr'      => new sfValidatorInteger(array('required' => false)),
      'theory'        => new sfValidatorInteger(array('required' => false)),
      'theory_corr'   => new sfValidatorInteger(array('required' => false)),
      'practice'      => new sfValidatorInteger(array('required' => false)),
      'practice_corr' => new sfValidatorInteger(array('required' => false)),
      'group'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cycle_subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CycleSubject';
  }

}
