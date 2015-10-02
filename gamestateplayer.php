<?php

class GameStatePlayer
{
    public $status;
    public $cards;

    public function __construct($player)
    {
        $this->status = $player['status'];
        $this->name = $player['name'];
        $this->cards = array_key_exists('hole_cards', $player) ? $player['hole_cards'] : array();
    }
}
