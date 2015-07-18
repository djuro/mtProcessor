<?php
namespace DM\PresentationBundle\Resources\views\Model;

/**
* View Object/Presenter pattern class, for displaying Graph report.
*/
class ReportView
{
	/**
	* @var DM\AnalyticsBundle\Document\Report
	*/
	public $report;

	/**
	* @var DM\AnalyticsBundle\Document\Result[]
	*/
	public $results = [];

	/**
	* @var string[]
	*/
	public $trendLabel;
}