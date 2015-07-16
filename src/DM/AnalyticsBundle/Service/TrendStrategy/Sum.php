<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;


class Sum extends TrendResult
{
	
	public function deliverResult()
	{
		$result = $this->analysis->analyse();

		return number_format(array_sum($result),2,'.',',');
	}
}