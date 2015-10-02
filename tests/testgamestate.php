<?php

error_reporting(-1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../defines.php';

class GameStateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function firstTest()
    {
        $gameStateJson = file_get_contents(__DIR__ . '/fixtures/test.json');
        $gameState = GameState::create(json_decode($gameStateJson, true));

        $this->assertEquals(2, $gameState->activePlayers());
    }
}
