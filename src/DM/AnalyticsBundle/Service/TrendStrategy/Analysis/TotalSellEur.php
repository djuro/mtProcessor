<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Cursor;

use \DateTime;

class TotalSellEur extends Analysis
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
		$result = $this->documentRepository->findAmountSellPlacedBetween('EUR',$this->dateFrom, $this->dateTo);

		$amountsSell = [];
		if($result instanceof Cursor)
		{
			foreach($result as $document)
			{
				$amountsSell[] = $document->getAmountSell();
			}
		}
		return $amountsSell;
	}
}