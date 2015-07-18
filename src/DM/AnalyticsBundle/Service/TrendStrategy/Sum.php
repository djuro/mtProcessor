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

		$singleResult = new Result();
		$singleResult->setValue(number_format(array_sum($result),2,'.',','));

		return array($singleResult);
	}
}