<?php
namespace mole\helpers;

class Datetime
{
    /**
     *
     * @param $year
     * @param array $include
     * @param array $exclude
     * @return array
     */
    public static function holiday($year, array $include = [], array $exclude = [])
    {
        $now = strtotime(sprintf('%s-01-01', $year));
        $year = date('Y', $now);
        $weekends = [];
        $interval = '+1 day';

        do {
            $weekday = date('w', $now);
            if ($weekday == 0 || $weekday == 6) {
                $weekends[] = date('Y-m-d', $now);
                if ($weekday == 6) {
                    $interval = '+1 week';
                    $tmp = strtotime('+1 day', $now);
                    if ((int) date('Y', $tmp) > $year) {
                        break;
                    } else {
                        $weekends[] = date('Y-m-d', $tmp);
                    }
                }
            }
            $now = strtotime($interval, $now);
            if ((int) date('Y', $now) > $year) {
                break;
            }
        } while (true);

        $weekends = array_merge($weekends, $include);
        $weekends = array_diff($weekends, $exclude);
        sort($weekends);
        return $weekends;
    }
}
