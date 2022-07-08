<?php

function swap(&$list){
    [$list[0], $list[1]] = [$list[1], $list[0]];
    return $list;
}

function pa(&$listA, &$listB){
    array_unshift($listB, $listA[0]);
    array_shift($listA);
    return [$listA, $listB];
}

function list_sorted($listA){
    $i = 0;
    while ($i < count($listA) - 1) {
        if(isset($listA[$i+1]) && $listA[$i] > $listA[$i+1]){
            return false;
        }
        $i++;
    }
    return true;
}

function a_list_sort(&$listA, &$listB, &$res_string){
    while (count($listA) > 0){
        if (isset($listA[1]) && $listA[0] > $listA[1]){
            swap($listA);
            $res_string .= "sa ";
            pa($listA, $listB);
            $res_string .= "pb ";

        } else {
            pa($listA, $listB);
            $res_string .= "pb ";
        }
    }
}

function b_list_sort(&$listA, &$listB, &$res_string){
    while (count($listB) > 0){
        if (isset($listB[1]) && $listB[0] < $listB[1]){
            swap($listB);
            $res_string .= "sb ";
            pa($listB, $listA);
            $res_string .= "pa ";
        } else {
            pa($listB, $listA);
            $res_string .= "pa ";
        }
    }
}

function main($list){
    $a_list = array_slice($list, 1);
    $b_list = [];
    $result_string = "";

    while (!list_sorted($a_list)) {
        a_list_sort($a_list, $b_list, $result_string);
        b_list_sort($a_list, $b_list, $result_string);    
    }
    echo trim($result_string, " "), "\n";
    
}

main($argv);