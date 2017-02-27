<?php

/**
 * Description of TimetablePdfBuilder
 *
 * @author Nurast
 */
include('../../../../../../../server/mpdf/mpdf.php');

class TimetablePdfBuilder {

	public $oMpdf;

	public function __construct() {
		$this->oMpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 10, 10, 0, 0);
	}

}
