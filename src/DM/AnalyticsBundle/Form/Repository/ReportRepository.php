<?php
namespace DM\AnalyticsBundle\Form\Repository;

use DM\AnalyticsBundle\Form\Model\Report as FormReport;
use DM\AnalyticsBundle\Document\Report;
use DM\AnalyticsBundle\Document\Trend;

use \DateTime;
use \DateTimeZone;

/**
* Class ReportRepository
* Serves to transform entity (domain) class to form underlying class, and vice versa.
*/
class ReportRepository
{
	/**
	* @param FormReport $formReport
	* @return Report
	*/
	public function store(FormReport $formReport)
	{
		$report = new Report();
		$report->setCreatedAt(new DateTime(null,new DateTimeZone('Europe/London')));
		$report->setDateFrom($formReport->dateFrom);
		$report->setDateTo($formReport->dateTo);
		$report->setTrend(new Trend($formReport->trend));

		return $report;
	}

	/**
	* @param Report $report
	* @return FormReport
	*/
	public function retrieve(Report $report)
	{
		// implement for editing Report
	}
}