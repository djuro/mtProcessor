<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;

use DM\AnalyticsBundle\Document\Result;

/**
* Implements a particular type of desired result format. Child of a context class in Strategy Pattern.
*/
class Sum extends TrendResult
{
	
	public function deliverResult()
	{
		$result = $this->analysis->analyse();

		$sumTotal = array_sum($result);
		
		$singleResult = new Result();
		$singleResult->setValue($sumTotal);
		$singleResult->setType('amount');
		
		return array($singleResult);
	}
}