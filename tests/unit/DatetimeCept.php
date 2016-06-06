<?php
use mole\helpers\Datetime;

function holiday($year, array $include = [], array $exclude = [])
{
    $stamp = strtotime(sprintf('%s-01-01', $year));
    $result = [];

    do {
        if (date('w', $stamp) == 0 || date('w', $stamp) == 6) {
            $result[] = date('Y-m-d', $stamp);
        }
        $stamp = strtotime('+1 day', $stamp);
        if ((int) date('Y', $stamp) > 2016) {
            break;
        }
    } while (true);

    $result = array_merge($result, $include);
    $result = array_diff($result, $exclude);
    sort($result);
    return $result;
}


$I = new UnitTester($scenario);
$I->wantTo('perform actions and see result');
$I->assertTrue(holiday('2016', ['2016-06-12'], ['2016-06-09', '2016-06-10']) ==  Datetime::holiday('2016', ['2016-06-12'], ['2016-06-09', '2016-06-10']));
