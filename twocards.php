<?php

class TwoCards
{
    /**
     * @param Card[] $cards
     * @return int
     */
    public function value($cards)
    {
        if (count($cards) !== 2) return 0;

        $isPair = ($cards[0]->rank == $cards[1]->rank) ? true : false;

        return $isPair ? 8 : 0;
    }
}
