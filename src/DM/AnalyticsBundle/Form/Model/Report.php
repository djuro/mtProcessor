<?php
namespace DM\AnalyticsBundle\Form\Model;

/**
* Data underlying class for ReportType form.
*/
class Report
{
	/**
	* @var int
	*/
	public $id;

	/**
	* @var string
	*/
	public $dateFrom;

	/**
	* @var string
	*/
	public $dateTo;

	/**
	* @var string
	*/
	public $trend;
}