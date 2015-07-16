<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;

use \DateTime;

class UsdToEur extends Analysis
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
		$result = $this->documentRepository->findByCurrencyPair('USD', 'EUR', $this->dateFrom, $this->dateTo);

		if($result instanceof Cursor)
			return $result;
	}
}