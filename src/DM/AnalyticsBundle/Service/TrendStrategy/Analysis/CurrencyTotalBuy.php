<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Cursor;

use \DateTime;

class CurrencyTotalBuy extends Analysis
{
	/**
	* @var string
	*/
	private $currency;

	/**
	* @param DocumentRepository $documentRepository
	* @param DateTime $dateFrom
	* @param DateTime $dateTo
	* @param string $currency
	*/
	public function __construct(DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo, $currency)
	{
		parent::__construct($documentRepository, $dateFrom, $dateTo);
	}

	/**
	* @return float[]
	*/
	public function analyse()
	{
		$result = $this->documentRepository->findAmountBuyPlacedBetween($this->currency, $this->dateFrom, $this->dateTo);

		$amountsBuy = [];
		if($result instanceof Cursor)
		{
			foreach($result as $document)
			{
				$amountsBuy[] = $document->getAmountBuy();
			}
		}
		return $amountsBuy;
	}
}