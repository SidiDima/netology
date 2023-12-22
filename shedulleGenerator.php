<?php
declare(strict_types=1);

function generateSchedule(int $year, int $startMonth, int $monthsCount)
{
    $endMonth = $startMonth + $monthsCount;
    $output = '';
    $lastWorkDay = 1;

    for ($month = $startMonth; $month <= $endMonth; $month++) {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $output .= 'Месяц: ' . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . "\n";
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $isWorkingDay = !in_array(date('w', mktime(0, 0, 0, $month, $day, $year)), [0, 6]);

            if ($month == $startMonth && $day == 1) {
                $daysSinceLastWorkDay = 3;
            } else {
                $daysSinceLastWorkDay = abs($day - $lastWorkDay);
            }

            if ($isWorkingDay && $daysSinceLastWorkDay > 2) {
                $lastWorkDay = $day;
                $output .= "\033[32m" . str_pad((string)$day, 3, ' ', STR_PAD_LEFT) . "\033[0m ";
            } else {
                $output .= str_pad((string)$day, 3, ' ', STR_PAD_LEFT) . ' ';
            }

            if ($day % 7 === 0) {
                $output .= "\n";
            }
        }
        $lastWorkDay = abs($daysInMonth - $lastWorkDay);
        $output .= "\n\n";
    }

    return $output;
}

echo generateSchedule(2023, 2, 5);
