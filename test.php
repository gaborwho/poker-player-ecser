<?php

require_once 'vendor/autoload.php';
require_once 'defines.php';

class GameStateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function firstTest()
    {
        $gameStateJson = file_get_contents('test.json');
        $gameState = GameState::create(json_decode($gameStateJson, true));

        $this->assertEquals(2, $gameState->activePlayers());
    }

    /**
     * @test
     */
    public function testMyHand()
    {
        $gameStateJson = file_get_contents('test.json');
        $gameState = GameState::create(json_decode($gameStateJson, true));
        $player = $gameState->getMyPlayer();

        $this->assertCount(2, $player->getHand());
    }
}
