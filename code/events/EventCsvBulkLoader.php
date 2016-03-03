<?php

/**
 * PlayerCsvBulkLoader
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   October 2015
 */
class EventCsvBulkLoader extends CsvBulkLoader {

	private static $dateFormat = 'm/d/Y';
	private static $timeFormat = 'H:i';

	public $columnMap = array(
		'Title' => 'Title',
		'Start Date' => '->importStartDate',
		'Start Time' => '->importStartTime',
		'End Date' => '->importEndDate',
		'End Time' => '->importEndTime',
		'Calendar' => 'Calendar.Title',
	);

	/**
	 * @var array
	 */
	public $relationCallbacks = array(
		'Calendar.Title' => array(
			'relationname' => 'Calendar',
			'callback' => 'getCalendarByTitle'
		)
	);

	/**
	 * @param $val
	 * @return string|DateTime
	 */
	protected static function importDate($val, $rt = 'string') {
		$dateFormat = Config::inst()->get('EventCsvBulkLoader', 'dateFormat');
		$dateTime = date_create_from_format($dateFormat . 'H:i', $val . '0:00');

		if ($rt == 'string') {
			return $dateTime->format('Y-m-d H:i:s');
		} else {
			return $dateTime;
		}
	}

	/**
	 * @param $obj
	 * @param $val
	 * @param $record
	 */
	public static function importStartDate(&$obj, $val, $record) {
		$dateTime = self::importDate($val);
		$obj->TimeFrameType = 'DateTime';
		$obj->StartDateTime = $dateTime;
		$obj->AllDay = true;
	}

	/**
	 * @param $obj
	 * @param $val
	 * @param $record
	 */
	public static function importStartTime(&$obj, $val, $record) {
		if (!strlen($val)) {
			return;
		}
		$dt = new DateTime($obj->StartDateTime);
		$date = $dt->format('Y-m-d');
		$obj->StartDateTime = $date . ' ' . $val;
		$obj->AllDay = false;
	}

	/**
	 * @param $obj
	 * @param $val
	 * @param $record
	 */
	public static function importEndDate(&$obj, $val, $record) {
		$dateTime = self::importDate($val);
		$obj->EndDateTime = $dateTime;
	}

	/**
	 * @param $obj
	 * @param $val
	 * @param $record
	 */
	public static function importEndTime(&$obj, $val, $record) {
		if (!strlen($val)) {
			return;
		}
		$dt = new DateTime($obj->EndDateTime);
		$date = $dt->format('Y-m-d');
		$obj->EndDateTime = $date . ' ' . $val;
	}

	/**
	 * @param $obj
	 * @param $val
	 * @param $record
	 * @return DataObject
	 */
	public static function getCalendarByTitle(&$obj, $val, $record) {
		$c = PublicCalendar::get()->filter('Title', $val)->First();
		if ($c && $c->exists()) {
			return $c;
		} else {
			$c = new PublicCalendar();
			$c->Title = $val;
			$c->write();
			return $c;
		}
	}


}