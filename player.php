<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest(GameState $gameState)
    {
        if ($gameState->activePlayers() > 2) {
            return 0;
        }
        return 10000;
    }

    public function showdown($game_state)
    {
    }
}
