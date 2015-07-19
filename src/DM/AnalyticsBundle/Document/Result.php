<?php
namespace DM\AnalyticsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

use \InvalidParameterException;

/**
 * @MongoDB\EmbeddedDocument
 */
class Result
{
	/**
     * @MongoDB\Id
     */
	private $id;

	/**
     * @MongoDB\String
     */
	private $type;
    
    /**
     * @MongoDB\String
     */
    private $label;

    /**
     * @MongoDB\Integer
     */
	private $value = 0;

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
     * Set value
     *
     * @param integer $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return integer $value
     */
    public function getValue()
    {
        return $this->value;
    }

    public function incrementValue()
    {
        $this->value += 1;
        return $this;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
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
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }
}
