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
		$this->doctrine = $doctrine;
	}

	public function researchForTrend(Report $report)
	{
		$messageRepository = $this->doctrine->getRepository('DMConsumerBundle:Message');
		$trendResult = $this->trendResultFactory->create($report,$messageRepository);
		$result = $trendResult->deliverResult();
		$report->getTrend()->setResult($result);
		$this->store($report);
	}


	private function store(Report $report)
	{
		$reportRepository = $this->doctrine->getRepository('DMAnalyticsBundle:Report');
		$documentManager = $this->doctrine->getManager();
		$documentManager->persist($report);
		$documentManager->flush();
	}
}