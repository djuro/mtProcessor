<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;

use \DateTime;

/**
* Class Analysis
* Represents various behaviours or TrendResult class or serves as an "interface" for TrendResult behaviours.
*/
abstract class Analysis
{
	/**
	* @var DocumentRepository
	*/
	protected $documentRepository;

	/**
	* @var DateTime
	*/
	protected $dateFrom;

	/**
	* @var DateTime
	*/
	protected $dateTo;

	/**
	* @param DocumentRepository $documentRepository
	* @param DateTime $dateFrom
	* @param DateTime $dateTo
	*/
	function __construct(DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo)
	{
		$this->documentRepository = $documentRepository;
		$this->dateFrom = $dateFrom;
		$this->dateTo = $dateTo;
	}

	/**
	* @return mixed
	*/
	abstract function analyse();
}