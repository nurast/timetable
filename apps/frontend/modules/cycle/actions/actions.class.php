<?php

class cycleActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {
		$this->aCycles = Doctrine_Core::getTable('Cycle')
			->getSelect();
		$this->aDateList = Doctrine_Core::getTable('CycleDate')
			->getSelect($this->aCycles[0]['id']);
	}

	public function executeGetDateList(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$this->aDateList = Doctrine_Core::getTable('CycleDate')
				->getSelect($request->getParameter('cycle_id'));
			return $this->renderPartial('cycle/date_select', array('aDateList' => $this->aDateList));
		}
	}

	public function executeSubjects(sfWebRequest $request) {
		$this->bPlanSubjects = false;

		$this->iCycleId = $request->getParameter('cycle_id');
		$this->sCycleName = Doctrine_Core::getTable('Cycle')
			->getNameWithInstructionAndCourse($this->iCycleId);
		$this->sStart = ($request->getParameter('start_input', null)) ? date('d.m.Y', strtotime($request->getParameter('start_input'))) : date('d.m.Y', strtotime($request->getParameter('start')));
		$this->sFinish = ($request->getParameter('finish_input', null)) ? date('d.m.Y', strtotime($request->getParameter('finish_input'))) : date('d.m.Y', strtotime($request->getParameter('finish')));
		$this->iBrigadeCount = $request->getParameter('brigade_count');
		$this->iHourCount = $request->getParameter('hour_count');
		$this->sTown = $request->getParameter('town', null);

		$iSubjectsCount = TimetableCycleSubjectTable::getInstance()
			->getSubjectsCountByCycleId($this->iCycleId);

		if ((int) $iSubjectsCount <= 0) {
			$bSavePlanSubjects = $request->getParameter('save_plan_subjects', 0);

			if ($bSavePlanSubjects) {
				$aTeacherIds = $request->getParameter('teacher_id');
				$aSubjects = $request->getParameter('subject_name');
				$aTeachers = $request->getParameter('teacher_name');
				$aTeacherContraction = array();
				$iNumber = 1;

				foreach ($aSubjects as $key => $sSubject) {
					$oTimetableCycleSubject = new TimetableCycleSubject();
					$oTimetableCycleSubject->cycle_id = $this->iCycleId;
					$oTimetableCycleSubject->teacher_id = $aTeacherIds[$key];
					$oTimetableCycleSubject->subject_name = $sSubject;
					$oTimetableCycleSubject->subject_contraction = mb_substr($aSubjects[$key], 0, 2, 'UTF-8');

					$iKey = array_search($aTeachers[$key], $aTeacherContraction);
					if (!$iKey) {//если текущему преподу не был присвоен номер ранее
						$oTimetableCycleSubject->teacher_contraction = '№' . $iNumber;
						$aTeacherContraction[$iNumber] = $aTeachers[$key];
						$iNumber++;
					} else {
						$oTimetableCycleSubject->teacher_contraction = '№' . $iKey;
					}

					$oTimetableCycleSubject->save();
				}
				$aActions = Doctrine_Core::getTable('TimetableAction')
					->findAll(Doctrine_Core::HYDRATE_ARRAY);

				foreach ($aActions as $aAction) {
					$oTimetableCycleAction = new TimetableCycleAction();
					$oTimetableCycleAction->cycle_id = $this->iCycleId;
					$oTimetableCycleAction->action_id = $aAction['id'];
					$oTimetableCycleAction->save();
				}
			} else {
				$this->bPlanSubjects = true;
				$this->aSubjects = CycleTeacherTable::getInstance()
					->getSubjects($this->iCycleId);
			}
		}

		if (!$this->bPlanSubjects) {
			$this->forward('cycle', 'timetableSubjects');
		}
	}

	public function executeTimetableSubjects(sfWebRequest $request) {
		$this->iCycleId = $request->getParameter('cycle_id');
		$this->sCycleName = Doctrine_Core::getTable('Cycle')
			->getNameWithInstructionAndCourse($this->iCycleId);
		$this->sStart = ($request->getParameter('start_input', null)) ? date('d.m.Y', strtotime($request->getParameter('start_input'))) : date('d.m.Y', strtotime($request->getParameter('start')));
		$this->sFinish = ($request->getParameter('finish_input', null)) ? date('d.m.Y', strtotime($request->getParameter('finish_input'))) : date('d.m.Y', strtotime($request->getParameter('finish')));
		$this->iBrigadeCount = $request->getParameter('brigade_count');
		$this->iHourCount = $request->getParameter('hour_count');
		$this->sTown = $request->getParameter('town', null);

		$this->iTimetableId = TimetableTable::getInstance()
			->getTimetableId($this->iCycleId, date_format(date_create($this->sStart), 'Y-m-d'), date_format(date_create($this->sFinish), 'Y-m-d'), $this->iBrigadeCount, $this->sTown, $this->iHourCount);
		$this->aTeachers = Doctrine_Core::getTable('TeacherRef')
			->getSelect();
		$this->aSubjects = TimetableCycleSubjectTable::getInstance()
			->getSubjects($this->iCycleId, $this->iTimetableId);
		$this->aActions = Doctrine_Core::getTable('TimetableCycleAction')
			->getActions($this->iCycleId, $this->iTimetableId);

		$oTimetable = new TimetableBuilder($this->iTimetableId);
		$this->aDates = $oTimetable->getDates();
		$this->aDateHeaders = $oTimetable->getDateHeaders();
		$this->aLectures = $oTimetable->getLectures();
		$this->aPractice = $oTimetable->getPractice();
		$this->iFactHourCount = $oTimetable->getHourCount();
	}

	public function executePdfDeputyDirector(sfWebRequest $request) {
		$oTimetableBuilder = new TimetableBuilder($request->getParameter('timetable_id'));
		$aMonths = $oTimetableBuilder->getMonths();
		$aMonthHeaders = $oTimetableBuilder->getMonthHeaders();

		$aTimetableVars = array(
			'aLectures' => $oTimetableBuilder->getLectures(),
			'aPractice' => $oTimetableBuilder->getPractice(),
			'iBrigadeCount' => $oTimetableBuilder->getBrigadeCount()
		);

		$aHeaderVars = array(
			'sCycleName' => $oTimetableBuilder->getCycleName(),
			'sStart' => $oTimetableBuilder->getStart(),
			'sFinish' => $oTimetableBuilder->getFinish(),
			'iPageCount' => $oTimetableBuilder->countPages(),
			'sTown' => $oTimetableBuilder->getTown()
		);

		$iBrigadeCount = $oTimetableBuilder->getBrigadeCount();

		$oPdfBuilder = new TimetablePdfBuilder();
		$aTimetableVars['aDates'] = $aMonths[0];
		$aTimetableVars['aMonthHeaders'] = $aMonthHeaders[0];
		$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('deputy_director_header', $aHeaderVars));
		if ($iBrigadeCount > 3) {
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('lecture_timetable', $aTimetableVars));
		} else {
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('printable_timetable', $aTimetableVars));
		}
		$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('deputy_director_footer'));

		if ($iBrigadeCount > 3) {
			$oPdfBuilder->oMpdf->AddPage('', '', '', '', '', '', '', 15, 15);
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('practice_timetable', $aTimetableVars));
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('deputy_director_footer_brief'));
		}
		$oPdfBuilder->oMpdf->AddPage('', '', '', '', '', '', '', 15, 15);
		$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('contractions', array(
				'aContractions' => $oTimetableBuilder->getContractions(),
				'iTelecommCount' => $oTimetableBuilder->getTelecommCount())));

		if (count($aMonths) > 1) {
			for ($i = 1; $i < count($aMonths); $i++) {
				$aTimetableVars['aDates'] = $aMonths[$i];
				$aTimetableVars['aMonthHeaders'] = $aMonthHeaders[$i];
				$oPdfBuilder->oMpdf->AddPage();
				if ($iBrigadeCount > 3) {
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('lecture_timetable', $aTimetableVars));
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('deputy_director_footer_brief'));
					$oPdfBuilder->oMpdf->AddPage();
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('practice_timetable', $aTimetableVars));
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('deputy_director_footer_brief'));
				} else {
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('printable_timetable', $aTimetableVars));
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('deputy_director_footer_brief'));
				}
			}
		}
		$oPdfBuilder->oMpdf->Output();
		return sfView::NONE;
	}

	public function executePdfDirector(sfWebRequest $request) {
		$oTimetableBuilder = new TimetableBuilder($request->getParameter('timetable_id'));
		$aMonths = $oTimetableBuilder->getMonths();
		$aMonthHeaders = $oTimetableBuilder->getMonthHeaders();

		$aTimetableVars = array(
			'aLectures' => $oTimetableBuilder->getLectures(),
			'aPractice' => $oTimetableBuilder->getPractice(),
			'iBrigadeCount' => $oTimetableBuilder->getBrigadeCount()
		);

		$aHeaderVars = array(
			'sCycleName' => $oTimetableBuilder->getCycleName(),
			'sStart' => $oTimetableBuilder->getStart(),
			'sFinish' => $oTimetableBuilder->getFinish(),
			'iPageCount' => $oTimetableBuilder->countPages(),
			'sTown' => $oTimetableBuilder->getTown()
		);

		$iBrigadeCount = $oTimetableBuilder->getBrigadeCount();

		$oPdfBuilder = new TimetablePdfBuilder();
		$aTimetableVars['aDates'] = $aMonths[0];
		$aTimetableVars['aMonthHeaders'] = $aMonthHeaders[0];
		$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('director_header', $aHeaderVars));
		if ($iBrigadeCount > 3) {
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('lecture_timetable', $aTimetableVars));
		} else {
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('printable_timetable', $aTimetableVars));
		}
		$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('director_footer'));

		if ($iBrigadeCount > 3) {
			$oPdfBuilder->oMpdf->AddPage('', '', '', '', '', '', '', 15, 15);
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('practice_timetable', $aTimetableVars));
			$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('director_footer_brief'));
		}
		$oPdfBuilder->oMpdf->AddPage('', '', '', '', '', '', '', 15, 15);
		$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('contractions', array(
				'aContractions' => $oTimetableBuilder->getContractions(),
				'iTelecommCount' => $oTimetableBuilder->getTelecommCount())));

		if (count($aMonths) > 1) {
			for ($i = 1; $i < count($aMonths); $i++) {
				$aTimetableVars['aDates'] = $aMonths[$i];
				$aTimetableVars['aMonthHeaders'] = $aMonthHeaders[$i];
				$oPdfBuilder->oMpdf->AddPage();
				if ($iBrigadeCount > 3) {
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('lecture_timetable', $aTimetableVars));
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('director_footer_brief'));
					$oPdfBuilder->oMpdf->AddPage();
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('practice_timetable', $aTimetableVars));
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('director_footer_brief'));
				} else {
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('printable_timetable', $aTimetableVars));
					$oPdfBuilder->oMpdf->WriteHTML($this->getPartial('director_footer_brief'));
				}
			}
		}
		$oPdfBuilder->oMpdf->Output();
		return sfView::NONE;
	}

	public function executeUpdateTimetableCycleSubject(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$iEntityId = $request->getParameter('entity_id');
			$sFieldName = $request->getParameter('field_name');
			$sContraction = '';

			$oTimetableCycleSubject = Doctrine_Core::getTable('TimetableCycleSubject')
				->findOneBy('id', $iEntityId);

			if ($sFieldName == 'teacher_id') {
				$sContraction = Doctrine_Core::getTable('TeacherRef')
					->getContraction($request->getParameter('field_value'), $oTimetableCycleSubject->timetable_id);
				$oTimetableCycleSubject->set('teacher_contraction', $sContraction);
			}

			$oTimetableCycleSubject->set($sFieldName, $request->getParameter('field_value'));
			$oTimetableCycleSubject->save();

			return $this->renderText(json_encode(array('status' => 'OK', 'contraction' => $sContraction)));
		}
	}

	public function executeDeleteTimetableCycleSubject(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$oTimetableCycleSubject = Doctrine_Core::getTable('TimetableCycleSubject')
				->findOneBy('id', $request->getParameter('entity_id'));
			$oTimetableCycleSubject->delete();
			return $this->renderText(json_encode(array('status' => 'OK')));
		}
	}

	public function executeCopyTimetableCycleSubject(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$oTimetableCycleSubject = Doctrine_Core::getTable('TimetableCycleSubject')
				->findOneBy('id', $request->getParameter('entity_id'));
			$oCopy = $oTimetableCycleSubject->copy();
			$oCopy->save();
			return $this->renderText(json_encode(array('status' => 'OK', 'id' => $oCopy->getId())));
		}
	}

	public function executeUpdateTimetableCycleAction(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$iEntityId = $request->getParameter('entity_id');
			$sFieldName = $request->getParameter('field_name');
			$iFieldValue = $request->getParameter('field_value');
			$sContraction = '';

			$oTimetableCycleAction = Doctrine_Core::getTable('TimetableCycleAction')
				->findOneBy('id', $iEntityId);

			if ($sFieldName == 'teacher_id') {
				if ($iFieldValue >= 0) {
					$oTimetableCycleAction->set($sFieldName, $iFieldValue);

					$sContraction = Doctrine_Core::getTable('TeacherRef')
						->getContraction($oTimetableCycleAction->teacher_id, $oTimetableCycleAction->timetable_id);
					$oTimetableCycleAction->set('teacher_contraction', $sContraction);
				} else {
					$oTimetableCycleAction->set($sFieldName, null);
					$oTimetableCycleAction->set('teacher_contraction', null);
				}
			}
			$oTimetableCycleAction->save();
			return $this->renderText(json_encode(array('status' => 'OK', 'contraction' => $sContraction)));
		}
	}

	public function executeCreateTimetableItem(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$oTimetableItem = new TimetableItem();
			$oTimetableItem->timetable_id = $request->getParameter('timetable_id');
			$oTimetableItem->entity_id = $request->getParameter('entity_id');
			$oTimetableItem->hour_count = $request->getParameter('hour_count');
			$oTimetableItem->date = $request->getParameter('date');
			$oTimetableItem->is_lecture = $request->getParameter('is_lecture');
			if ($request->getParameter('is_lecture')) {
				$oTimetableItem->class = $request->getParameter('class');
			} else {
				$oTimetableItem->brigade = $request->getParameter('brigade');
				$oTimetableItem->session = $request->getParameter('session');
			}
			$oTimetableItem->save();
			return $this->renderText(json_encode(array('status' => 'OK', 'id' => $oTimetableItem->getId())));
		}
	}

	public function executeDeleteTimetableItem(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$oTimetableItem = Doctrine_Core::getTable('TimetableItem')
				->findOneBy('id', $request->getParameter('item_id'));
			$oTimetableItem->delete();
			return $this->renderText(json_encode(array('status' => 'OK')));
		}
	}

	public function executeChangeHourCount(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$sItemType = $request->getParameter('item_type');
			$oItem = Doctrine_Core::getTable($sItemType)
				->findOneBy('id', $request->getParameter('item_id'));
			$iHourCount = $oItem->hour_count;//старое значение
			$oItem->hour_count = $request->getParameter('hour_count');
			$oItem->save();
			return $this->renderText(json_encode(array('status' => 'OK', 'hour_count' => $iHourCount)));
		}
	}

	public function executeSetTelecommMode(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$sItemType = $request->getParameter('item_type');
			$oItem = Doctrine_Core::getTable($sItemType)
				->findOneBy('id', $request->getParameter('item_id'));
			$oItem->is_telecommunication = $request->getParameter('telecomm_mode');
			$oItem->save();
			return $this->renderText(json_encode(array('status' => 'OK')));
		}
	}

	public function executeChangeTimeOn(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$sItemType = $request->getParameter('item_type');
			$oItem = Doctrine_Core::getTable($sItemType)
				->findOneBy('id', $request->getParameter('item_id'));
			$sTimeOn = trim($request->getParameter('time_on'));
			if ($sTimeOn) {
				$oItem->time_on = $sTimeOn;
			} else {
				$oItem->time_on = null;
			}
			$oItem->save();
			return $this->renderText(json_encode(array('status' => 'OK')));
		}
	}

	public function executeCreateTimetableActionItem(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$oTimetableActionItem = new TimetableActionItem();
			$oTimetableActionItem->timetable_id = $request->getParameter('timetable_id');
			$oTimetableActionItem->entity_id = $request->getParameter('entity_id');
			$oTimetableActionItem->hour_count = $request->getParameter('hour_count');
			$oTimetableActionItem->date = $request->getParameter('date');
			$oTimetableActionItem->is_lecture = $request->getParameter('is_lecture');
			if ($request->getParameter('is_lecture')) {
				$oTimetableActionItem->class = $request->getParameter('class');
			} else {
				$oTimetableActionItem->brigade = $request->getParameter('brigade');
				$oTimetableActionItem->session = $request->getParameter('session');
			}
			$oTimetableActionItem->save();
			return $this->renderText(json_encode(array('status' => 'OK', 'id' => $oTimetableActionItem->getId())));
		}
	}

	public function executeDeleteTimetableActionItem(sfWebRequest $request) {
		if ($request->isXmlHttpRequest()) {
			$oTimetableActionItem = Doctrine_Core::getTable('TimetableActionItem')
				->findOneBy('id', $request->getParameter('item_id'));
			$oTimetableActionItem->delete();
			return $this->renderText(json_encode(array('status' => 'OK')));
		}
	}

//	public function executeShow(sfWebRequest $request) {
//		$this->cycle = Doctrine_Core::getTable('Cycle')->find(array($request->getParameter('id')));
//		$this->forward404Unless($this->cycle);
//	}
//
//	public function executeNew(sfWebRequest $request) {
//		$this->form = new CycleForm();
//	}
//
//	public function executeCreate(sfWebRequest $request) {
//		$this->forward404Unless($request->isMethod(sfRequest::POST));
//
//		$this->form = new CycleForm();
//
//		$this->processForm($request, $this->form);
//
//		$this->setTemplate('new');
//	}
//
//	public function executeEdit(sfWebRequest $request) {
//		$this->forward404Unless($cycle = Doctrine_Core::getTable('Cycle')->find(array($request->getParameter('id'))), sprintf('Object cycle does not exist (%s).', $request->getParameter('id')));
//		$this->form = new CycleForm($cycle);
//	}
//
//	public function executeUpdate(sfWebRequest $request) {
//		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
//		$this->forward404Unless($cycle = Doctrine_Core::getTable('Cycle')->find(array($request->getParameter('id'))), sprintf('Object cycle does not exist (%s).', $request->getParameter('id')));
//		$this->form = new CycleForm($cycle);
//
//		$this->processForm($request, $this->form);
//
//		$this->setTemplate('edit');
//	}
//
//	public function executeDelete(sfWebRequest $request) {
//		$request->checkCSRFProtection();
//
//		$this->forward404Unless($cycle = Doctrine_Core::getTable('Cycle')->find(array($request->getParameter('id'))), sprintf('Object cycle does not exist (%s).', $request->getParameter('id')));
//		$cycle->delete();
//
//		$this->redirect('cycle/index');
//	}
//
//	protected function processForm(sfWebRequest $request, sfForm $form) {
//		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
//		if ($form->isValid()) {
//			$cycle = $form->save();
//
//			$this->redirect('cycle/edit?id=' . $cycle->getId());
//		}
//	}

}
