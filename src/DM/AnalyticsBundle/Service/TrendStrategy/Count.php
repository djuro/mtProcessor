<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;


class Count extends TrendResult
{
	
	public function deliverResult()
	{
		$result = $this->analysis->analyse();

		return count($result);
	}
}