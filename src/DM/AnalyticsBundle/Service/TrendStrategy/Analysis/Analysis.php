<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;

use \DateTime;

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

	function __construct(DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo)
	{
		$this->documentRepository = $documentRepository;
		$this->dateFrom = $dateFrom;
		$this->dateTo = $dateTo;
	}

	abstract function analyse();
}