<?php

class Statistics
{
    public static function getStats($fileName)
    {
        $result = array();
        foreach(file($fileName) as $line) {
            $result []= str_getcsv($line);
        }
        return $result;
//        $csv = file_get_contents($fileName);
////        var_dump($csv);
//        return str_getcsv($csv);
    }
}