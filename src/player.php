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

//        // POST
//        if (count($gameState->getCommuntyCards()))
//        {
//            $allCards = array_merge($gameState->getCommuntyCards(), $myHand);
//
//            $rankClient = new RankClient();
//            $handRank =  $rankClient->getRank($allCards)->rank;
//            if (in_array($handRank, array(0))) return $fold;
//            if (in_array($handRank, array(1, 2, 3))) return $call;
//            if (in_array($handRank, array(4, 5, 6))) return $raise;
//            return $allIn;
//        }


        // PRE
        $detector = Detector::create(__DIR__ . '/../preflop.csv');
        $value = $detector->check($myHand);


        $states = array_map(function(GameStatePlayer $p){return $p->getStatus();}, $players);
        Logger::log('states: ' . implode(',', $states));

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
