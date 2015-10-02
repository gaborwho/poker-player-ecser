<?php

class Player
{
    const VERSION = "The most awesome player ever";

    public function betRequest(GameState $gameState)
    {
        try
        {
            $myPlayer = $gameState->getMyPlayer();

            if (count($gameState->getPlayers()) > 2)
            {
                return 0;
            }

            return 10000;
        }
        catch (Exception $e)
        {
            return 0;
        }
    }

    public function showdown($game_state)
    {
    }
}
