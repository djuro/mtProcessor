<?php
namespace DM\ConsumerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

use \InvalidArgumentException;

/**
 * @MongoDB\Document
 */
class Message
{
	/**
     * @MongoDB\Id
     */
	protected $id;

	/**
     * @MongoDB\String
     */
	protected $userId;

	/**
     * @MongoDB\String
     */
	protected $currencyFrom;

	/**
     * @MongoDB\String
     */
	protected $currencyTo;

	/**
     * @MongoDB\Float
     */
	protected $amountSell;

	/**
     * @MongoDB\Float
     */
	protected $amountBuy;

	/**
     * @MongoDB\Float
     */
	protected $rate;

	/**
     * @MongoDB\String
     */
	protected $timePlaced;

	/**
     * @MongoDB\String
     */
	protected $originatingCountry;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param string $userId
     * @return self
     */
    public function setUserId($userId)
    {
    	if(empty($userId))
    		throw new InvalidArgumentException("User ID value is required.");
    	
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get userId
     *
     * @return string $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set currencyFrom
     *
     * @param string $currencyFrom
     * @return self
     */
    public function setCurrencyFrom($currencyFrom)
    {
        $this->currencyFrom = $currencyFrom;
        return $this;
    }

    /**
     * Get currencyFrom
     *
     * @return string $currencyFrom
     */
    public function getCurrencyFrom()
    {
        return $this->currencyFrom;
    }

    /**
     * Set currencyTo
     *
     * @param string $currencyTo
     * @return self
     */
    public function setCurrencyTo($currencyTo)
    {
        $this->currencyTo = $currencyTo;
        return $this;
    }

    /**
     * Get currencyTo
     *
     * @return string $currencyTo
     */
    public function getCurrencyTo()
    {
        return $this->currencyTo;
    }

    /**
     * Set amountSell
     *
     * @param float $amountSell
     * @return self
     */
    public function setAmountSell($amountSell)
    {
        $this->amountSell = $amountSell;
        return $this;
    }

    /**
     * Get amountSell
     *
     * @return float $amountSell
     */
    public function getAmountSell()
    {
        return $this->amountSell;
    }

    /**
     * Set amountBuy
     *
     * @param float $amountBuy
     * @return self
     */
    public function setAmountBuy($amountBuy)
    {
        $this->amountBuy = $amountBuy;
        return $this;
    }

    /**
     * Get amountBuy
     *
     * @return float $amountBuy
     */
    public function getAmountBuy()
    {
        return $this->amountBuy;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * Get rate
     *
     * @return float $rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set timePlaced
     *
     * @param string $timePlaced
     * @return self
     */
    public function setTimePlaced($timePlaced)
    {
        $this->timePlaced = $timePlaced;
        return $this;
    }

    /**
     * Get timePlaced
     *
     * @return string $timePlaced
     */
    public function getTimePlaced()
    {
        return $this->timePlaced;
    }

    /**
     * Set originatingCountry
     *
     * @param string $originatingCountry
     * @return self
     */
    public function setOriginatingCountry($originatingCountry)
    {
        $this->originatingCountry = $originatingCountry;
        return $this;
    }

    /**
     * Get originatingCountry
     *
     * @return string $originatingCountry
     */
    public function getOriginatingCountry()
    {
        return $this->originatingCountry;
    }
}
