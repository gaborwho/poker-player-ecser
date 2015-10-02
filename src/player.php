<?php

class Player
{
    const VERSION = "The most awesome player ever";



    public function betRequest(GameState $gameState)
    {
        $myPlayer = $gameState->getMyPlayer();
        $myHand = $myPlayer->getHand();

        $twoCards = new TwoCards();
        $preFlopValue = $twoCards->value($myHand);

        $fold = 0;
        $call = $gameState->getCurrentBuyIn() - $myPlayer->getBet();
        $raise = $call + $gameState->getMinimumRaise();

        $detector = Detector::create(__DIR__ . '/../preflop.csv');
        $value = $detector->check($myHand);

        if ($value == -1) {
            return $fold;
        } elseif ($value < 8) {
            return $raise;
        } else {
            return $call;
        }

//        if (count($gameState->getPlayers()) > 2)
//        {
//            return 0;
//        }
//
//
//        return 100000;
    }



    public function showdown($game_state)
    {
    }
}
