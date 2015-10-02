<?php

class GameState
{
    public $players;


    public static function create($game_state)
    {
        $players = array();
        foreach ($game_state['players'] as $player) {
            $players[] = new GameStatePlayer($player);
        }
        return new GameState($players);
    }

    /**
     * @param GameStatePlayer[] $players
     */
    public function __construct(array $players)
    {
        $this->players = $players;
    }


    public function activePlayers()
    {
        $active = 0;
        foreach ($this->players as $player)
        {
            if ($player->status == 'active')
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
            if (!empty($player->cards))
            {
                Logger::log('my name is ' . $player->name);
                return $player;
            }
        }
        Logger::log('failed to get my player');
    }
}
