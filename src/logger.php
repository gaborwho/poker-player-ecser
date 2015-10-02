<?php

class Logger
{
    public static function log($message)
    {
        $stderr = fopen('php://stderr', 'w');
        fwrite($stderr, 'poker logger: ' .$message . "\n");
        fclose($stderr);
    }
}
