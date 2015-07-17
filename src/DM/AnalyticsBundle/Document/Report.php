<?php
namespace DM\AnalyticsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Report
{
	/**
     * @MongoDB\Id
     */
	private $id;

    /**
     * @MongoDB\Date
     */
    private $createdAt;
    
	/**
     * @MongoDB\Date
     */
	private $dateFrom;

	/**
     * @MongoDB\Date
     */
	private $dateTo;

    /**
     * @MongoDB\EmbedOne(targetDocument="Trend")
     */
    private $trend;


    

   

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
     * Set createdAt
     *
     * @param date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set dateFrom
     *
     * @param date $dateFrom
     * @return self
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return date $dateFrom
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param date $dateTo
     * @return self
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * Get dateTo
     *
     * @return date $dateTo
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set trend
     *
     * @param DM\AnalyticsBundle\Document\Trend $trend
     * @return self
     */
    public function setTrend(\DM\AnalyticsBundle\Document\Trend $trend)
    {
        $this->trend = $trend;
        return $this;
    }

    /**
     * Get trend
     *
     * @return DM\AnalyticsBundle\Document\Trend $trend
     */
    public function getTrend()
    {
        return $this->trend;
    }
}
