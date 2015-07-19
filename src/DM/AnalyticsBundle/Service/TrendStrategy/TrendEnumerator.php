<?php
namespace DM\AnalyticsBundle\Service\TrendStrategy;


class TrendEnumerator
{
	private static $trends = [	"CURRENCY_PAIR_EUR_GBP" => "Currency pair EUR - GBP",
								"CURRENCY_PAIR_EUR_USD" => "Currency pair EUR - USD",
								"CURRENCY_PAIR_GBP_EUR" => "Currency pair GBP - EUR",
								"CURRENCY_PAIR_USD_GBP" => "Currency pair USD - GBP",
								"CURRENCY_PAIR_USD_EUR" => "Currency pair USD - EUR",
								"TOTAL_BUY_EUR" => "Total amount EUR buy",
								"TOTAL_BUY_GBP" => "Total amount GBP buy",
								"CURRENCY_PAIR_GRAPH_EUR_GBP" => "Graph EUR - GBP",
								"CURRENCY_PAIR_GRAPH_GBP_EUR" => "Graph GBP - EUR",
								"CURRENCY_PAIR_GRAPH_EUR_USD" => "Graph EUR - USD",
								"CURRENCY_PAIR_GRAPH_USD_EUR" => "Graph USD - EUR",
							];
	

	public static function trends()
	{
		return self::$trends;
	}
}