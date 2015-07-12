<?php
namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Message
{
	 /**
     * @MongoDB\Id
     */
	private $id;

	/**
     * @MongoDB\String
     */
	private $currencyFrom;

	/**
     * @MongoDB\String
     */
	private $currencyTo;

	/**
     * @MongoDB\Float
     */
	private $amount;


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
     * Set amount
     *
     * @param float $amount
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     *
     * @return float $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
