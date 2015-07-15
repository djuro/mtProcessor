<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;

use \DateTime;

interface Analysis
{
	public function analyse(DocumentRepository $documentRepository, DateTime $dateFrom, DateTime $dateTo);
}