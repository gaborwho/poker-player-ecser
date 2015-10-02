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
            if ($statLine[2] && $hand[0]->suit !== $hand[1]->suit) {
                continue;
            }
            if ($statLine[0] == $hand[0]->rankForStat() . $hand[1]->rankForStat() || $statLine[0] == $hand[1]->rankForStat() . $hand[0]->rankForStat()) {
                return true;
            }
        }
        return false;
    }
}
