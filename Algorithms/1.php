<?php

    function findMissingNum(array $arr): int
    {
        $length = count($arr);

        $expectedSum = (($length + 1) * ($length + 2)) / 2;
        $actualSum = array_sum($arr);

        return $expectedSum - $actualSum;
    }

    echo findMissingNum([5,1,2,4,6]);

?>