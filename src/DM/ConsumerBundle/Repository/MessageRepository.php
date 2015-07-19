<?php

namespace DM\ConsumerBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Cursor;

use \DateTime;

/**
 * MessageRepository
 *
 * Contains custom query methods for Message retrieval.
 */
class MessageRepository extends DocumentRepository
{

	/**
	* @param string $currencyFrom
	* @param string $currencyTo
	* @param DateTime $dateFrom
	* @param DateTime $dateTo
	* @return Cursor
	*/
	public function findByCurrencyPair($currencyFrom, $currencyTo, DateTime $dateFrom, DateTime $dateTo)
	{
		 $qb = $this->createQueryBuilder('DMConsumerBundle:Message')
        			->field('currencyFrom')->equals($currencyFrom)
        			->field('currencyTo')->equals($currencyTo)
        			->field('timePlaced')->gt($dateFrom)
        			->field('timePlaced')->lte($dateTo)
        			->sort('timePlaced','asc');

        $query = $qb->getQuery();
		$result = $query->execute();
		return $result;
	}

	/**
	* @param DateTime $dateFrom
	* @param DateTime $dateTo
	* @return Cursor
	*/
	public function findPlacedBetween(DateTime $dateFrom, DateTime $dateTo)
	{
		$qb = $this->createQueryBuilder('DMConsumerBundle:Message')
        			->field('timePlaced')->gt($dateFrom)
        			->field('timePlaced')->lte($dateTo);

        $query = $qb->getQuery();
		$result = $query->execute();
		return $result;
	}

	/**
	* @param string $currency
	* @param DateTime $dateFrom
	* @param DateTime $dateTo
	* @return Cursor
	*/
	public function findAmountBuyPlacedBetween($currency, DateTime $dateFrom, DateTime $dateTo)
	{
		$qb = $this->createQueryBuilder('DMConsumerBundle:Message')
        			->field('timePlaced')->gt($dateFrom)
        			->field('timePlaced')->lte($dateTo)
        			->field('currencyTo')->equals($currency);

        $query = $qb->getQuery();
		$result = $query->execute();
		return $result;
	}

}