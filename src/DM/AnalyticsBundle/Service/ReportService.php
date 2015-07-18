<?php
namespace DM\AnalyticsBundle\Service;

use DM\AnalyticsBundle\Document\Report;
use DM\PresentationBundle\Resources\views\Model\ReportView;
use DM\AnalyticsBundle\Service\TrendStrategy\TrendEnumerator;

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
	/**
	* @param Report $report
	*/
	public function researchForTrend(Report $report)
	{
		$messageRepository = $this->doctrine->getRepository('DMConsumerBundle:Message');
		$trendResult = $this->trendResultFactory->create($report,$messageRepository);
		$result = $trendResult->deliverResult();
		$report->getTrend()->setResult($result);
		$this->store($report);
	}

	/**
	* @param Report $report
	*/
	private function store(Report $report)
	{
		$reportRepository = $this->doctrine->getRepository('DMAnalyticsBundle:Report');
		$documentManager = $this->doctrine->getManager();
		$documentManager->persist($report);
		$documentManager->flush();
	}

	/**
	* @param Report $report
	* @return ReportView $view
	*/
	public function createView(Report $report)
	{
		$view = new ReportView();
		$view->report = $report;
		$trendLabels = TrendEnumerator::trends();

		$view->trendLabel = $trendLabels[$report->getTrend()->getLabel()];
		
		$trendResult = $report->getTrend()->getResult();

		foreach($trendResult as $result)
		{
			$view->results[] = $result;
		}
//dd($view);
		return $view;
	}
}