<?php
namespace DM\AnalyticsBundle\Service\Trend;

/**
* Abstract class Trend
* Context class in Strategy pattern solution for extensible Trend reporting feature.
*/
abstract class Trend
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
	* @param string $title
	*/
	protected function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	* @param Analysis $analysis
	*/
	protected function setAnalysis()
	{
		$this->analysis = $analysis;
	}

	/**
	* @param float $result
	*/
	protected function setResult($result)
	{
		$this->result = $result;
	}

	
	abstract function deliverResult();

}