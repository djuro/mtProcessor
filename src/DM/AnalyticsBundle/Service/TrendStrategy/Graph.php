<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;

use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\Analysis;
use DM\AnalyticsBundle\Document\Result;

use Doctrine\ODM\MongoDB\Cursor;

use \DateTime;
use \DateInterval;
use \DatePeriod;

/**
* Implements a particular type of desired result format. Child of a context class in Strategy Pattern.
*/
class Graph extends TrendResult
{

	/**
	* @var DateTime
	*/
	private $dateFrom;
	
	/**
	* @var DateTime
	*/
	private $dateTo;


	public function __construct(Analysis $analysis, DateTime $dateFrom, DateTime $dateTo)
	{
		parent::__construct($analysis);

		$this->dateFrom = $dateFrom;
		$this->dateTo = $dateTo;
	}

	public function deliverResult()
	{
		$result = $this->analysis->analyse();

		$daysCount = $this->dateFrom->diff($this->dateTo)->format("%a");

		$messages = $this->formatMessages($result);

		if($daysCount > 30)
		{
			/* @var DateTime[] Used for generating labels on x axis */
			$xMarks = $this->findMonths();
			$resultCollection = $this->mapMessageCountToMonthTimeLine($messages,$xMarks);
		}
		else
		{
			$xMarks = $this->findDays();
			$resultCollection = $this->mapMessageCountToDayTimeLine($messages,$xMarks);
		}

		return $resultCollection;
	}

	/**
	* @param TimePlaced[] $messages
	* @param DateTime[] $timeLine
	* @return Result[]
	*/
	private function mapMessageCountToDayTimeLine($messages, $timeLine)
	{
		$resultCollection = [];
		foreach($timeLine as $day)
		{
			$result = new Result();
			$result->setLabel($day->format("d.m.Y."));
			foreach($messages as $iDtimePlaced)
			{
				$timePlaced = $iDtimePlaced->time;
				if(!$timePlaced instanceof DateTime)
					throw new Exception(sprintf("TimePlaced DTO property for Message ID: %s is not valid", $iDtimePlaced->messageId));

				$timePlacedString = $timePlaced->format('Y-m-d');
				$comparingDate = new DateTime($timePlacedString);
				if($comparingDate == $day)
				{
					$result->incrementValue();
				}
			}
			$resultCollection[] = $result;
		}
		return $resultCollection;
	}

	/**
	* @param TimePlaced[] $messages
	* @param DateTime[] $timeLine
	* @return Result[]
	*/
	private function mapMessageCountToMonthTimeLine($messages, $timeLine)
	{
		$resultCollection = [];
		foreach($timeLine as $month)
		{
			$result = new Result();
			$result->setLabel($month->format("M.Y."));
			foreach($messages as $iDtimePlaced)
			{
				$timePlaced = $iDtimePlaced->time;

				if(!$timePlaced instanceof DateTime)
					throw new Exception(sprintf("TimePlaced DTO property for Message ID: %s is not valid", $iDtimePlaced->messageId));

				$timePlacedString = $timePlaced->format('Y-m');
				$timePlacedMonth = new DateTime($timePlacedString);
				$comparingMonth = new DateTime($timePlacedString);
				if($timePlacedMonth == $month)
				{
					$result->incrementValue();
				}
			}
			$resultCollection[] = $result;
		}
		return $resultCollection;
	}

	/**
	* @return DateTime[]
	*/
	private function findMonths()
	{
		$xMarks = [];

		$start    = $this->dateFrom->modify('first day of this month');
		$end      = $this->dateTo->modify('first day of this month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);

		foreach ($period as $dt)
		{
		    $xMarks[] = $dt;
		}

		return $xMarks;
	}

	/**
	* @return DateTime[]
	*/
	private function findDays()
	{
		$xMarks = [];

		$start    = $this->dateFrom;
		$end      = $this->dateTo;
		$interval = DateInterval::createFromDateString('1 day');
		$period   = new DatePeriod($start, $interval, $end);

		foreach ($period as $dt) 
		{
		    $xMarks[] = $dt;
		}
		return $xMarks;
	}

	/**
	* @param Cursor $messages
	* @return IdTimePlaced[]
	*/
	private function formatMessages(Cursor $messages)
	{
		$dtoCollection = [];
		foreach($messages as $message)
		{
			$iDtimePlacedDTO = new IdTimePlaced($message->getId(),$message->getTimePlaced());
			$dtoCollection[] = $iDtimePlacedDTO;
		}
		return $dtoCollection;
	}

}