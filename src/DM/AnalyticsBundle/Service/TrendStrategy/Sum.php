<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;

class Sum extends TrendResult
{
	
	protected function deliverResult()
	{
		$result = $this->analysis->analyse($this->messageRepository, $this->dateFrom, $this->dateTo);

		dd($result);
	}
}