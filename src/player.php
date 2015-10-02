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

        $playerCount = count($gameState->getPlayers());
        if ($value == -1)
        {
            if ($playerCount > 2)
            {
                Logger::log('folding: ' . $playerCount . ' - ' . $myHand[0]->rankForStat() . ':' . $myHand[1]->rankForStat());
                return $fold;
            }
            Logger::log('allin: ' . $playerCount . ' - ' . $myHand[0]->rankForStat() . ':' . $myHand[1]->rankForStat());
            return $allIn;
        }
        elseif ($value < 8)
        {
            Logger::log('raise: ' . $playerCount . ' - ' . $myHand[0]->rankForStat() . ':' . $myHand[1]->rankForStat());
            return $raise;
        }
        else
        {
            Logger::log('call: ' . $playerCount . ' - ' . $myHand[0]->rankForStat() . ':' . $myHand[1]->rankForStat());
            return $call;
        }

    }



    public function showdown($game_state)
    {
    }
}
