<?php

/**
 * Description of Timetable
 *
 * @author Nurast
 */
class TimetableBuilder {

	protected $iTimetableId;
	protected $iCycleId;
	protected $sCycleName;
	protected $sStart;
	protected $sFinish;
	protected $sTown;
	protected $iPageCount = 1;
	protected $aDates = array();
	protected $aDateHeaders = array();
	protected $aMonths = array();
	protected $aMonthHeaders = array();
	protected $iHourCount = 0;

	public function __construct($iTimetableId) {
		$this->iTimetableId = $iTimetableId;
		$oTimetable = Doctrine_Core::getTable('Timetable')->findOneBy('id', $this->iTimetableId);
		$this->iCycleId = $oTimetable->cycle_id;
		$this->sCycleName = Doctrine_Core::getTable('Cycle')->getNameWithInstructionAndCourse($oTimetable->cycle_id);
		$oStartDate = date_create($oTimetable->start);
		$oFinishDate = date_create($oTimetable->finish);
		$this->sStart = date_format($oStartDate, 'd.m.Y');
		$this->sFinish = date_format($oFinishDate, 'd.m.Y');
		$this->sTown = $oTimetable->town;
		$this->buildDates($oStartDate, $oFinishDate);
		$this->buildHeaders();
	}

	public function getCycleName() {
		return $this->sCycleName;
	}

	public function getStart() {
		return $this->sStart;
	}

	public function getFinish() {
		return $this->sFinish;
	}

	public function getBrigadeCount() {
		return $this->iBrigadeCount;
	}

	public function getTown() {
		return $this->sTown;
	}

	public function getDates() {
		return $this->aDates;
	}

	public function getMonths() {
		return $this->aMonths;
	}

	public function getDateHeaders() {
		return $this->aDateHeaders;
	}

	public function getMonthHeaders() {
		return $this->aMonthHeaders;
	}
	
	public function getHourCount() {
		return $this->iHourCount;
	}

	public function getLectures() {
		$aLectures = array();
		$aTimetableItems = $this->getTimetableItems(1);
		$aTimetableActionItems = $this->getTimetableActionItems(1);
		foreach ($aTimetableItems as $aItem) {
			//лекция находится на пересечении даты и пары
			$sDate = $aItem['date'];
			$iClass = $aItem['class'];
			$aLectures[$sDate][$iClass]['is_subject'] = true;
			$aLectures[$sDate][$iClass]['item_id'] = $aItem['id'];
			$aLectures[$sDate][$iClass]['subject_contraction'] = $aItem['TimetableCycleSubject']['subject_contraction'];
			$aLectures[$sDate][$iClass]['teacher_contraction'] = $aItem['TimetableCycleSubject']['teacher_contraction'];
			$aLectures[$sDate][$iClass]['hour_count'] = $aItem['hour_count'];
			$aLectures[$sDate][$iClass]['is_telecommunication'] = $aItem['is_telecommunication'];
			if (isset($aItem['time_on']) && $aItem['time_on']) {
				$iTime = strtotime('1970-01-01 ' . $aItem['time_on']);
				$aLectures[$sDate][$iClass]['time_on'] = date('H:i', $iTime);
			}
			$this->iHourCount += $aItem['hour_count'];
		}
		foreach ($aTimetableActionItems as $aItem) {
			$sDate = $aItem['date'];
			$iClass = $aItem['class'];
			$aLectures[$sDate][$iClass]['is_subject'] = false;
			$aLectures[$sDate][$iClass]['item_id'] = $aItem['id'];
			$aLectures[$sDate][$iClass]['subject_contraction'] = $aItem['TimetableCycleAction']['TimetableAction']['contraction'];
			$aLectures[$sDate][$iClass]['teacher_contraction'] = $aItem['TimetableCycleAction']['teacher_contraction'];
			$aLectures[$sDate][$iClass]['hour_count'] = $aItem['hour_count'];
			$aLectures[$sDate][$iClass]['is_telecommunication'] = $aItem['is_telecommunication'];
			if (isset($aItem['time_on']) && $aItem['time_on']) {
				$iTime = strtotime('1970-01-01 ' . $aItem['time_on']);
				$aLectures[$sDate][$iClass]['time_on'] = date('H:i', $iTime);
			}
		}
		return $aLectures;
	}

	public function getPractice() {
		$aPractice = array();
		$aTimetableItems = $this->getTimetableItems(0);
		$aTimetableActionItems = $this->getTimetableActionItems(0);

		foreach ($aTimetableItems as $aItem) {
			//практика находится на пересечении даты, бригады и смены
			$sDate = $aItem['date'];
			$iBrigade = $aItem['brigade'];
			if ($iBrigade > $this->iBrigadeCount) {
				$this->iBrigadeCount = $iBrigade;
			}
			$iSession = $aItem['session'];
			$aPractice[$sDate][$iBrigade][$iSession]['is_subject'] = true;
			$aPractice[$sDate][$iBrigade][$iSession]['item_id'] = $aItem['id'];
			$aPractice[$sDate][$iBrigade][$iSession]['subject_contraction'] = $aItem['TimetableCycleSubject']['subject_contraction'];
			$aPractice[$sDate][$iBrigade][$iSession]['teacher_contraction'] = $aItem['TimetableCycleSubject']['teacher_contraction'];
			$aPractice[$sDate][$iBrigade][$iSession]['hour_count'] = $aItem['hour_count'];
			$aPractice[$sDate][$iBrigade][$iSession]['is_telecommunication'] = $aItem['is_telecommunication'];
			if (isset($aItem['time_on']) && $aItem['time_on']) {
				$iTime = strtotime('1970-01-01 ' . $aItem['time_on']);
				$aPractice[$sDate][$iBrigade][$iSession]['time_on'] = date('H:i', $iTime);
			}
			$this->iHourCount += $aItem['hour_count'];
		}
		foreach ($aTimetableActionItems as $aItem) {
			$sDate = $aItem['date'];
			$iBrigade = $aItem['brigade'];
			if ($iBrigade > $this->iBrigadeCount) {
				$this->iBrigadeCount = $iBrigade;
			}
			$iSession = $aItem['session'];
			$aPractice[$sDate][$iBrigade][$iSession]['is_subject'] = false;
			$aPractice[$sDate][$iBrigade][$iSession]['item_id'] = $aItem['id'];
			$aPractice[$sDate][$iBrigade][$iSession]['subject_contraction'] = $aItem['TimetableCycleAction']['TimetableAction']['contraction'];
			$aPractice[$sDate][$iBrigade][$iSession]['teacher_contraction'] = $aItem['TimetableCycleAction']['teacher_contraction'];
			$aPractice[$sDate][$iBrigade][$iSession]['hour_count'] = $aItem['hour_count'];
			$aPractice[$sDate][$iBrigade][$iSession]['is_telecommunication'] = $aItem['is_telecommunication'];
			if (isset($aItem['time_on']) && $aItem['time_on']) {
				$iTime = strtotime('1970-01-01 ' . $aItem['time_on']);
				$aPractice[$sDate][$iBrigade][$iSession]['time_on'] = date('H:i', $iTime);
			}
		}
		return $aPractice;
	}

	public function getContractions() {
		$aItems = TimetableCycleSubjectTable::getInstance()
				->getContractions($this->iTimetableId);
		$aActionItems = TimetableCycleActionTable::getInstance()
				->getContractions($this->iTimetableId);
		return array_merge($aItems, $aActionItems);
	}

	public function getTelecommCount() {
		$count = (TimetableItemTable::getInstance()->getTelecommCount($this->iTimetableId) +
				TimetableActionItemTable::getInstance()->getTelecommCount($this->iTimetableId));
		return $count;
	}

	protected function buildDates($oStartDate, $oFinishDate) {
		$aDates = array();
		$aDates[] = array('day' => date_format($oStartDate, 'd'), 'date' => date_format($oStartDate, 'Y-m-d'), 'n' => date_format($oStartDate, 'N'), 'month_number' => date_format($oStartDate, 'n'));
		while ($oStartDate < $oFinishDate) {
			date_add($oStartDate, date_interval_create_from_date_string('1 days'));
			$aDate = array('day' => date_format($oStartDate, 'd'), 'date' => date_format($oStartDate, 'Y-m-d'), 'n' => date_format($oStartDate, 'N'), 'month_number' => date_format($oStartDate, 'n'));
			$aDates[] = $aDate;
		}
		$this->aDates = $aDates;

		if (count($aDates) <= 28) {
			$this->aMonths[0] = $aDates;
		} elseif ($aDates[0]['n'] == 1) {
			$this->aMonths = array_chunk($aDates, 28);
		} else {
			$aVars = array();
			$i = 0;
			while ($aDates[$i]['n'] != 1) {
				$aVars[] = $aDates[$i];
				$i++;
			}
			$aDates = array_slice($aDates, $i);
			$this->aMonths = array_chunk($aDates, 28);
			$this->aMonths[0] = array_merge($aVars, $this->aMonths[0]);
		}
		$iMonthCount = count($this->aMonths);
		if (count($this->aMonths) > 1 && count($this->aMonths[$iMonthCount - 1]) < 7) {
			$this->aMonths[$iMonthCount - 2] = array_merge($this->aMonths[$iMonthCount - 2], $this->aMonths[$iMonthCount - 1]);
			unset($this->aMonths[$iMonthCount - 1]);
		}
	}

	protected function buildHeaders() {
		$aNames = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март',
			4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
			7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь',
			10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');

		$iMonthNumber = $this->aDates[0]['month_number'];
		$i = 0;
		foreach ($this->aDates as $aDate) {
			if ($aDate['month_number'] == $iMonthNumber) {
				$i++;
			} else {
				$this->aDateHeaders[] = array('name' => $aNames[$iMonthNumber], 'count' => $i);
				$iMonthNumber = $aDate['month_number'];
				$i = 1;
			}
		}
		$this->aDateHeaders[] = array('name' => $aNames[$iMonthNumber], 'count' => $i);

		foreach ($this->aMonths as $key => $aMonth) {
			$this->aMonthHeaders[$key] = array();
			$iMonthNumber = $aMonth[0]['month_number'];
			$i = 0;
			while ($aMonth[$i]['month_number'] == $iMonthNumber) {
				$i++;
			}
			$this->aMonthHeaders[$key][] = array('name' => $aNames[$iMonthNumber], 'count' => $i);
			if ($i < count($aMonth)) {
				$iMonthNumber++;
				if ($iMonthNumber > 12) {
					$iMonthNumber = 1;
				}
				$this->aMonthHeaders[$key][] = array('name' => $aNames[$iMonthNumber], 'count' => count($aMonth) - $i);
			}
		}
	}

	public function countPages() {
		$this->iPageCount = 1;
		$iMonthCount = count($this->aMonths);
		if ($iMonthCount > 1) {
			$this->iPageCount += $iMonthCount - 1;
		}
		if ($this->iBrigadeCount > 3) {
			if ($iMonthCount > 1) {
				$this->iPageCount += $iMonthCount;
			} else {
				$this->iPageCount++;
			}
		}
		return $this->iPageCount;
	}

	protected function getTimetableItems($bIsLecture) {
		return Doctrine_Core::getTable('TimetableItem')
						->createQuery('ti')
						->leftJoin('ti.TimetableCycleSubject e')
						->where('ti.timetable_id = ?', $this->iTimetableId)
						->andWhere('ti.is_lecture = ?', $bIsLecture)
						->fetchArray();
	}

	protected function getTimetableActionItems($bIsLecture) {
		return Doctrine_Core::getTable('TimetableActionItem')
						->createQuery('tai')
						->leftJoin('tai.TimetableCycleAction e')
						->leftJoin('e.TimetableAction')
						->where('tai.timetable_id = ?', $this->iTimetableId)
						->andWhere('tai.is_lecture = ?', $bIsLecture)
						->fetchArray();
	}

}
