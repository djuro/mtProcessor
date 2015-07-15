<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy\Analysis;

use Doctrine\ODM\MongoDB\DocumentRepository;

use \DateTime;

class EurToGbp implements Analysis
{
	public function analyse(DocumentRepository $messageRepository, DateTime $dateFrom, DateTime $dateTo)
	{
		$messages = $messageRepository->findBy(array('currencyFrom'=>'EUR','currencyTo'=>'GBP'));

		return $messages;
	}
}