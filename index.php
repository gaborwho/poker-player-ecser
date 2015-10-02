<?php

require_once('player.php');
require_once('gamestate.php');

$player = new Player();

switch ($_POST['action'])
{
    case 'bet_request':
        $state = GameState::create(json_decode($_POST['game_state'], true));
        echo $player->betRequest($state);
        break;
    case 'showdown':
        $player->showdown(json_decode($_POST['game_state'], true));
        break;
    case 'version':
        echo Player::VERSION;
}

class Logger
{
    public static function log($message)
    {
        $stderr = fopen('php://stderr', 'w');
        fwrite($stderr, $message);
        fclose($stderr);
    }
}