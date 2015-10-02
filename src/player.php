<?php

class Player
{
    const VERSION = "The most awesome player ever";



    public function betRequest(GameState $gameState)
    {
        $myPlayer = $gameState->getMyPlayer();

        $twoCards = new TwoCards();
        $preFlopValue = $twoCards->value($myPlayer->getHand());
        $call = $gameState->getCurrentBuyIn() - $myPlayer->getBet();

        if (count($gameState->getPlayers()) > 2)
        {
            if ($preFlopValue > 0)
            {
                return $call;
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
