<?php


class Card
{
    public $rank;
    public $suit;

    public function __construct($rank, $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    public function rankForStat()
    {
        if (10 == $this->rank) {
            return 'T';
        }
        return (string)$this->rank;
    }

    public function __toString()
    {
        return '(' . $this->suit . '|' .  $this->rank . ')';
    }
}
