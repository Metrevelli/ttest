<?php

    function groupAnagrams(array $arr): array
    {
        $groupedAnagramsArr = [];
        
        for($i = 0; $i < count($arr); $i++) {
            $str = $arr[$i];
            
            $splittedStr = str_split($str);

            sort($splittedStr);
            
            $sortedStr = implode('', $splittedStr);
            
            $groupedAnagramsArr[$sortedStr][] = $str;
        }
        
        return array_values($groupedAnagramsArr);
    }

    echo print_r(groupAnagrams(["eat", "tea", "tan", "ate", "nat", "bat"]));
?>