<?php
namespace DM\AnalyticsBundle\Service;

use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\Analysis;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\EurToGbp;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\EurToUsd;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\GbpToEur;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\UsdToGbp;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\UsdToEur;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\TotalSell;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\TotalBuy;
use DM\AnalyticsBundle\Document\Report;
use DM\AnalyticsBundle\Service\TrendStrategy\Count;
use DM\AnalyticsBundle\Service\TrendStrategy\Sum;
use DM\AnalyticsBundle\Service\TrendStrategy\Graph;

use Doctrine\ODM\MongoDB\DocumentRepository;

use \InvalidArgumentException;
use \DateTime;

class TrendResultFactory
{

	/**
	* @param Trend $trend
	* @return TrendResult
	*/
	public function create(Report $report, DocumentRepository $messageRepository)
	{
		$trendLabel = $report->getTrend()->getLabel();

		$analysis = $this->createAnalysis($trendLabel, $messageRepository, $report->getDateFrom(), $report->getDateTo());

		switch($trendLabel)
		{
			case 'CURRENCY_PAIR_EUR_GBP':
			case 'CURRENCY_PAIR_EUR_USD':
			case 'CURRENCY_PAIR_GBP_EUR':
			case 'CURRENCY_PAIR_USD_GBP':
			case 'CURRENCY_PAIR_USD_EUR':
				return new Count($analysis);
			case 'TOTAL_AMOUNT_SELL':
			case 'TOTAL_AMOUNT_BUY':
				return new Sum($analysis);
			case 'CURRENCY_PAIR_GRAPH_EUR_GBP':
				return new Graph($analysis, $report->getDateFrom(), $report->getDateTo());
			default:
				throw new Exception(sprintf("Given Trend result type %s not supported.",$trendLabel));
		}
	}

	/**
	* @param string $trendLabel
	* @return Analysis
	*/
	private function createAnalysis($trendLabel, DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo)
	{
	
		switch($trendLabel)
		{
			case 'CURRENCY_PAIR_EUR_GBP':
			case 'CURRENCY_PAIR_GRAPH_EUR_GBP':
				return new EurToGbp($documentRepository, $dateFrom, $dateTo);
			case 'CURRENCY_PAIR_EUR_USD':
				return new EurToUsd($documentRepository, $dateFrom, $dateTo);
			case 'CURRENCY_PAIR_GBP_EUR':
				return new GbpToEur($documentRepository, $dateFrom, $dateTo);
			case 'CURRENCY_PAIR_USD_GBP':
				return new UsdToGbp($documentRepository, $dateFrom, $dateTo);
			case 'CURRENCY_PAIR_USD_EUR':
				return new UsdToEur($documentRepository, $dateFrom, $dateTo);
			case 'TOTAL_AMOUNT_SELL':
				return new TotalSell($documentRepository, $dateFrom, $dateTo);
			case 'TOTAL_AMOUNT_BUY':
				return new TotalBuy($documentRepository, $dateFrom, $dateTo);
			default:
				throw new Exception(sprintf("Given Trend analysis %s not supported.",$trendLabel));
		}
	}
}

