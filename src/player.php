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
                $this->logBet('fold', $playerCount, $myHand);
                return $fold;
            }
            $this->logBet('allin', $playerCount, $myHand);
            return $allIn;
        }
        elseif ($value < 8)
        {
            $this->logBet('raise', $playerCount, $myHand);
            return $raise;
        }
        else
        {
            $this->logBet('call', $playerCount, $myHand);
            return $call;
        }

    }



    public function showdown($game_state)
    {
    }



    private function logBet($action, $playerCount, $myHand)
    {
        Logger::log($action . ': ' . $playerCount . ' - ' . $myHand[0] . ':' . $myHand[1]);
    }
}
