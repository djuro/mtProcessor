<?php
namespace DM\ConsumerBundle\Service;

use DM\ConsumerBundle\Document\Message;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;

use \Exception;

class MessageService
{
	private $doctrine;

	public function __construct(ManagerRegistry $doctrine)
	{
		$this->doctrine = $doctrine;
	}

	/**
	* @param string[] $messageValues
	* @throws Exception
	*/
	public function handleMessage($messageValues)
	{
		if(empty($messageValues))
			throw new Exception("Received message is empty.");

		$message = $this->create($messageValues);

		$em = $this->doctrine->getManager();

		$em->persist($message);

		$em->flush();
	}


	private function create($messageValues)
	{
		$message = new Message();
		$message->setUserId($messageValues['userId'])
			->setCurrencyFrom($messageValues['currencyFrom'])
			->setCurrencyTo($messageValues['currencyTo'])
			->setAmountSell($messageValues['amountSell'])
			->setAmountBuy($messageValues['amountBuy'])
			->setRate($messageValues['rate'])
			->setTimePlaced($messageValues['timePlaced'])
			->setOriginatingCountry($messageValues['originatingCountry']);

		return $message;
	}
}