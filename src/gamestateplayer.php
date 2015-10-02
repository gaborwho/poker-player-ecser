<?php

class GameStatePlayer
{
    private $name;
    private $status;
    private $cards;
    private $bet;



    public function __construct($player)
    {
        $this->status = $player['status'];
        $this->name = $player['name'];
        $this->bet = $player['bet'];
        $this->cards = array_key_exists('hole_cards', $player) ? $player['hole_cards'] : array();
    }



    public function getHand()
    {
        $hand = array();
        foreach ($this->cards as $card)
        {
            $hand[] = new Card($card['rank'], $card['suit']);
        }
        return $hand;
    }



    public function getStatus()
    {
        return $this->status;
    }



    public function getBet()
    {
        return $this->bet;
    }



    public function getName()
    {
        return $this->name;
    }
}
