<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Cursor;

use \DateTime;

class EurToUsd extends Analysis
{
	
	public function __construct(DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo)
	{
		parent::__construct($documentRepository, $dateFrom, $dateTo);
	}

	/**
	* @return Doctrine\ODM\MongoDB\Cursor
	*/
	public function analyse()
	{
		$result = $this->documentRepository->findByCurrencyPair('EUR', 'USD', $this->dateFrom, $this->dateTo);

		
	}
}