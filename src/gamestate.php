<?php

class GameState
{
    /** @var GameStatePlayer[] */
    private $players;
    private $currentBuyIn;
    private $dealer;
    private $minimumRaise;

    /** @var Card[] */
    private $communityCards = array();



    public static function create($game_state)
    {
        $result = new GameState();

        $players = array();
        foreach ($game_state['players'] as $player)
        {
            $players[] = new GameStatePlayer($player);
        }

        $result->players = $players;
        $result->currentBuyIn = $game_state['current_buy_in'];
        $result->dealer = $game_state['dealer'];
        $result->minimumRaise = $game_state['minimum_raise'];
        foreach ($game_state['community_cards'] as $cardData)
        {
            $result->communityCards[] = new Card($cardData['rank'], $cardData['suit']);
        }
        return $result;
    }



    private function __construct()
    {
    }



    public function getCurrentBuyIn()
    {
        return $this->currentBuyIn;
    }



    /**
     * @return GameStatePlayer
     */
    public function getFirstPlayer()
    {
        return $this->players[($this->dealer + 1) % (count($this->players))];
    }



    public function getPlayers()
    {
        return $this->players;
    }



    public function getInGamePlayerCount()
    {
        $active = 0;
        foreach ($this->players as $player)
        {
            if ($player->getStatus() != 'out')
            {
                $active++;
            }
        }
        return $active;
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



    public function getMinimumRaise()
    {
        return $this->minimumRaise;
    }



    public function getCommuntyCards()
    {
        return $this->communityCards;
    }
}
