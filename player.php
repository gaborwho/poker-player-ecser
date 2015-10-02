<?php

class Player
{
    const VERSION = "The most awesome player ever";



    public function betRequest(GameState $gameState)
    {
        $myPlayer = $gameState->getMyPlayer();

        $twoCards = new TwoCards();
        $preValue = $twoCards->value($myPlayer->getHand());

        if (count($gameState->getPlayers()) > 2)
        {
            if ($preValue > 0)
            {
                return $gameState->getCurrentBuyIn() - $myPlayer->getBet();
            }
            else
            {
                return 0;
            }
        }

        return 100000;
    }



    public function showdown($game_state)
    {
    }
}
