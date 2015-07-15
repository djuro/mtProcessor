<?php
namespace DM\AnalyticsBundle\Service;

use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\Analysis;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\EurToGbp;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\EurToUsd;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\GbpToEur;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\UsdToGbp;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\TotalSell;
use DM\AnalyticsBundle\Service\TrendStrategy\Analysis\TotalBuy;
use DM\AnalyticsBundle\Document\Trend;
use DM\AnalyticsBundle\Service\TrendStrategy\Sum;

use \InvalidArgumentException;
use \DateTime;

class TrendResultFactory
{

	/**
	* @param Trend $trend
	* @return TrendResult
	*/
	public function create(Trend $trend, DateTime $dateFrom, DateTime $dateTo)
	{
		$analysis = $this->selectAnalysis($trend->getLabel());

		$trendResult = new Sum($analysis, $dateFrom, $dateTo);

		return $trendResult;
	}

	/**
	* @param string $trendLabel
	* @return Analysis
	*/
	private function selectAnalysis($trendLabel)
	{
		if(empty($trendLabel))
			throw new InvalidArgumentException("Trend label missing for analysis selection.");

		switch($trendLabel)
		{
			case 'CURRENCY_PAIR_EUR_GBP':
				return new EurToGbp;

			case 'CURRENCY_PAIR_EUR_USD':
				return new EurToUsd;

			case 'CURRENCY_PAIR_GBP_EUR':
				return new GbpToEur;

			case 'CURRENCY_PAIR_USD_GBP':
				return new UsdToGbp;

			case 'TOTAL_AMOUNT_SELL':
				return new TotalSell;

			case 'TOTAL_AMOUNT_BUY':
				return new TotalBuy;
		}
	}
}

