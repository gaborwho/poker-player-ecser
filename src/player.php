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

        $players = $gameState->getPlayers();
        $playerCount = count($players);

        // POST
        if (count($gameState->getCommuntyCards()))
        {
            $allCards = array_merge($gameState->getCommuntyCards(), $myHand);

            $rankClient = new RankClient();
            $before = microtime(true);
            $handRank = $rankClient->getRank($allCards)->rank;
            Logger::log('response time: ' . (microtime(true) - $before));
            if (in_array($handRank, array(0)))
            {
                $this->logBet('fold', $playerCount, $myHand);
                return $fold;
            }
            if (in_array($handRank, array(1, 2, 3)))
            {
                $this->logBet('call', $playerCount, $myHand);
                return $call;
            }
            if (in_array($handRank, array(4, 5, 6)))
            {
                $this->logBet('raise', $playerCount, $myHand);
                return $raise;
            }
            return $allIn;
        }


        // PRE
        $detector = Detector::create(__DIR__ . '/../preflop.csv');
        $value = $detector->check($myHand);


        $playerCount = $gameState->getInGamePlayerCount();
        if ($playerCount > 2)
        {
            if ($value == -1)
            {
                $this->logBet('fold', $playerCount, $myHand);
                return $fold;
            }
            elseif ($value < 8)
            {
                $this->logBet('raise', $playerCount, $myHand);
                return $raise;
            }
            else
            {
                if ($call < 200) {
                    $this->logBet('call', $playerCount, $myHand);
                    return $call;
                }
                $this->logBet('fold', $playerCount, $myHand);
                return $fold;
            }
        }

        $this->logBet('allin', $playerCount, $myHand);
        return $allIn;
    }



    public function showdown($game_state)
    {
    }



    private function logBet($action, $playerCount, $myHand)
    {
        Logger::log($action . ': ' . $playerCount . ' - ' . $myHand[0] . ':' . $myHand[1]);
    }
}
