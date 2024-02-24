<?php

    function intersectedIntervals(array $arr): array
    {
        usort($arr, fn ($prevInterval, $currInterval) => $prevInterval[0] - $currInterval[0]);
        
        $intersectedIntervalsArr = !empty($arr) ? [$arr[0]] : [];
        
        for ($i = 1; $i < count($arr); $i++) {
            [$currIntervalStart, $currIntervalEnd] = $currInterval = $arr[$i];
            [, $prevIntervalEnd] = $prevInterval = &$intersectedIntervalsArr[array_key_last($intersectedIntervalsArr)];
            
            if ($prevIntervalEnd > $currIntervalStart) {
                    $prevInterval[1] = $currIntervalEnd;
                    continue;
            }

            $intersectedIntervalsArr[] = $currInterval;
        }

        return $intersectedIntervalsArr;
    }

echo(print_r(intersectedIntervals([[1,3],[2,6],[8,10],[15,18]])));

?>