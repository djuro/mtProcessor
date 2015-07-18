<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;

use DM\AnalyticsBundle\Document\Result;

/**
* Implements a particular type of desired result format. Child of a context class in Strategy Pattern.
*/
class Count extends TrendResult
{
	
	public function deliverResult()
	{
		$result = $this->analysis->analyse();

		$singleResult = new Result();
		$singleResult->setValue(count($result));

		return array($singleResult);
	}
}