<?php

require_once('defines.php');

$player = new Player();

switch ($_POST['action'])
{
    case 'bet_request':
        try
        {
            $state = GameState::create(json_decode($_POST['game_state'], true));
            echo $player->betRequest($state);
        } catch (Exception $ex)
        {
            Logger::log((string)$ex);
            echo 0;
        }
        break;
    case 'showdown':
        $player->showdown(json_decode($_POST['game_state'], true));
        break;
    case 'version':
        echo Player::VERSION;
}
