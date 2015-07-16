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


	abstract function deliverResult();

}