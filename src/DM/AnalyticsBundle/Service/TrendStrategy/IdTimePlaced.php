<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;

use \DateTime;

/**
* Data transfer class, used in Graph class to avoid complex array.
*/
class IdTimePlaced
{
	/**
	* @var DateTime
	*/
	public $time;

	/**
	* @var string
	*/
	public $messageId;

	public function __construct($messageId, DateTime $time)
	{
		$this->time = $time;
		$this->messageId = $messageId;
	}
}