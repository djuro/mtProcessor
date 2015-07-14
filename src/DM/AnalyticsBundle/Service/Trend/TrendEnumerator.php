<?php
namespace DM\AnalyticsBundle\Service\Trend;


class TrendEnumerator
{
	private static $trends = [	"CURRENCY_PAIR_EUR_GBP" => "Currency pair EUR/GBP",
								"CURRENCY_PAIR_EUR_USD" => "Currency pair EUR/USD",
								"CURRENCY_PAIR_GBP_EUR" => "Currency pair GBP/EUR",
								"CURRENCY_PAIR_EUR_GBP" => "Currency pair USD/EUR",
								"TOTAL_AMOUNT_SELL" => "Total amount sell",
								"TOTAL_AMOUNT_BUY" => "Total amount buy",
							];
	

	public static function trends()
	{
		return self::$trends;
	}
}