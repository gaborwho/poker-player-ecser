<?php

class Ranker
{

    /**
     * @param $cards Card[]
     * @return int
     */
    public function rank($cards)
    {
        if (count($cards) < 5)
        {
            $twoRanker = new TwoCards();
            return (int) $twoRanker->value($cards);
        }

        $rankClient = new RankClient();
        return $rankClient->getRank($cards)->rank;
    }

}
