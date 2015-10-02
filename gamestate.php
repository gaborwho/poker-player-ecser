<?php

class GameState
{
    /** @var GameStatePlayer[] */
    private $players;
    private $currentBuyIn;


    public static function create($game_state)
    {
        $result = new GameState();

        $players = array();
        foreach ($game_state['players'] as $player) {
            $players[] = new GameStatePlayer($player);
        }

        $result->players = $players;
        $result->currentBuyIn = $game_state['current_buy_in'];
        return $result;
    }

    private function __construct()
    {
    }


    public function getCurrentBuyIn()
    {
        return $this->currentBuyIn;
    }


    public function getPlayers()
    {
        return $this->players;
    }



    public function activePlayers()
    {
        $active = 0;
        foreach ($this->players as $player)
        {
            if ($player->getStatus() == 'active')
            {
                $active++;
            }
        }
        return $active;
    }

    public function getMyPlayer()
    {
        foreach ($this->players as $player)
        {
            if (!empty($player->getHand()))
            {
                return $player;
            }
        }
    }
}
