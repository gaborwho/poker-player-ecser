<?php

class Player
{
    const VERSION = "The most awesome player ever";



    public function betRequest(GameState $gameState)
    {
        $myPlayer = $gameState->getMyPlayer();
        $myHand = $myPlayer->getHand();

        $allIn = 100000;
        $fold = 0;
        $call = $gameState->getCurrentBuyIn() - $myPlayer->getBet();
        $raise = $call + $gameState->getMinimumRaise();

        $detector = Detector::create(__DIR__ . '/../preflop.csv');
        $value = $detector->check($myHand);

        if ($value == -1)
        {
            if (count($gameState->getPlayers()) > 2)
            {
                return $fold;
            }
            return $allIn;
        }
        elseif ($value < 8)
        {
            return $raise;
        }
        else
        {
            return $call;
        }

    }



    public function showdown($game_state)
    {
    }
}
