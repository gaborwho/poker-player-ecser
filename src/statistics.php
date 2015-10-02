<?php

class Statistics
{
    public static function getStats($fileName)
    {
        $csv = file_get_contents($fileName);
        var_dump($csv);
        return str_getcsv($csv);
    }
}