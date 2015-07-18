<?php
namespace DM\AnalyticsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

use \InvalidParameterException;

/**
 * @MongoDB\EmbeddedDocument
 */
class Trend
{
	/**
     * @MongoDB\Id
     */
	private $id;

	/**
     * @MongoDB\String
     */
	private $label;

	/**
     * @MongoDB\Timestamp
     */
	private $createdAt;

	/**
     * @MongoDB\EmbedMany(targetDocument="Result")
     */
	private $result;

	public function __construct($label)
	{
		if(empty($label))
			throw new InvalidParameterException("Trend instance must have valid label set.");

		$this->label = $label;
	}

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
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set createdAt
     *
     * @param timestamp $createdAt
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
     * @return timestamp $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set result
     *
     * @param string $result
     * @return self
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * Get result
     *
     * @return string $result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Add result
     *
     * @param DM\AnalyticsBundle\Document\Result $result
     */
    public function addResult(\DM\AnalyticsBundle\Document\Result $result)
    {
        $this->result[] = $result;
    }

    /**
     * Remove result
     *
     * @param DM\AnalyticsBundle\Document\Result $result
     */
    public function removeResult(\DM\AnalyticsBundle\Document\Result $result)
    {
        $this->result->removeElement($result);
    }
}
