<?php

class Detector
{
    /**
     * @var array
     */
    private $statistics;

    public static function create($fileName)
    {
        return new Detector(Statistics::getStats($fileName));
    }

    public function __construct(array $statistics)
    {
        $this->statistics = $statistics;
    }

    /**
     * @param Card[] $hand
     * @return bool
     */
    public function check($hand)
    {
        foreach ($this->statistics as $statLine)
        {
            if ($statLine[0] == $hand[0]->suitForStat() . $hand[1]->suitForStat() || $statLine[0] == $hand[1]->suitForStat() . $hand[0]->suitForStat()) {
                return true;
            }
        }
        return false;
    }
}
