<?php
namespace DM\AnalyticsBundle\Service;

use DM\AnalyticsBundle\Document\Report;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;


class ReportService
{
	/**
	* @var ManagerRegistry
	*/
	private $doctrine;

	/**
	* @var TrendResultFactory
	*/
	private $trendResultFactory;

	/**
	* @param ManagerRegistry $doctrine
	* @param TrendResultFactory $trendResultFactory 
	*/
	public function __construct(ManagerRegistry $doctrine, TrendResultFactory $trendResultFactory)
	{
		$this->trendResultFactory = $trendResultFactory;
	}

	public function researchForTrend(Report $report)
	{
		$trendResult = $this->trendResultFactory->create($report->getTrend(), $report->getDateFrom(), $report->getDateTo());
	}
}