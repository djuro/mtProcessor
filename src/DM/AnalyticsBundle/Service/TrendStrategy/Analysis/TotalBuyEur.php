<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Cursor;

use \DateTime;

class TotalBuyEur extends Analysis
{
	
	public function __construct(DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo)
	{
		parent::__construct($documentRepository, $dateFrom, $dateTo);
	}

	/**
	* @return float[]
	*/
	public function analyse()
	{

		$result = $this->documentRepository->findAmountBuyPlacedBetween('EUR',$this->dateFrom, $this->dateTo);
		
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