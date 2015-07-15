<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;

use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\Analysis;

use \DateTime;
/**
* Abstract class Result
* Context class in Strategy pattern solution for scalable Trend reporting feature.
*/
abstract class TrendResult
{
	/**
	* @var string
	*/
	protected $title;

	/**
	* @var float
	*/
	protected $result;

	/**
	* @var Analysis
	*/
	protected $analysis;

	/**
	* @var DateTime
	*/
	protected $dateFrom;

	/**
	* @var DateTime
	*/
	protected $dateTo;


	public function __construct(Analysis $analysis)
	{
		$this->analysis = $analysis;
	}

	/**
	* @param string $title
	*/
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	* @param float $result
	*/
	public function setResult($result)
	{
		$this->result = $result;
	}

	public function setDateTo(DateTime $dateTo)
	{
		$this->dateTo = $dateTo;
	}

	public function setDateFrom(DateTime $dateFrom)
	{
		$this->dateFrom = $dateFrom;
	}
	
	public function getDateTo()
	{
		return $this->dateTo;
	}

	public function getDateFrom()
	{
		return $this->dateFrom;
	}

	abstract protected function deliverResult();

}