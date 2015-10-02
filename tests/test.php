<?php

error_reporting(-1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../defines.php';

class AllTest extends PHPUnit_Framework_TestCase
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



    /**
     * @test
     */
    public function testMyHand()
    {
        $gameStateJson = file_get_contents(__DIR__ . '/fixtures/test.json');
        $gameState = GameState::create(json_decode($gameStateJson, true));
        $player = $gameState->getMyPlayer();

        $this->assertCount(2, $player->getHand());
    }



    /**
     * @test
     */
    public function testPairDetect()
    {
        $this->markTestIncomplete();
        $gameStateJson = file_get_contents(__DIR__ . '/fixtures/pairdetect.json');
        $player = new Player();
        $gameState = GameState::create(json_decode($gameStateJson, true));

        $bet = $player->betRequest($gameState);

        $this->assertSame(240, $bet);
    }



    /**
     * @test
     */
    public function testAllin()
    {
        $this->markTestIncomplete();
        $gameStateJson = file_get_contents(__DIR__ . '/fixtures/allin.json');
        $player = new Player();
        $gameState = GameState::create(json_decode($gameStateJson, true));

        $bet = $player->betRequest($gameState);

        $this->assertSame(100000, $bet);
    }



    /**
     * @test
     */
    public function getPreflop()
    {
        $hand = array(new Card(10, 'spades'), new Card('K', 'hearts'));
        $this->assertSame(3, Detector::create(__DIR__ . '/fixtures/preflop.csv')->check($hand));
    }



    /**
     * @test
     */
    public function getPreflopUnsuited()
    {
        $hand = array(new Card(3, 'spades'), new Card('K', 'hearts'));
        $this->assertSame(-1, Detector::create(__DIR__ . '/fixtures/preflop.csv')->check($hand));
    }



    /**
     * @test
     */
    public function checkSuitedness()
    {
        $this->assertSame(1, Detector::create(__DIR__ . '/fixtures/preflop.csv')->check(array(new Card(3, 'spades'), new Card('K', 'spades'))));
        $this->assertSame(-1, Detector::create(__DIR__ . '/fixtures/preflop.csv')->check(array(new Card(3, 'hearts'), new Card('K', 'spades'))));
    }



    /**
     * @test
     */
    public function whyWouldYouDoThat()
    {
        $gameStateJson = file_get_contents(__DIR__ . '/fixtures/why.json');
        $player = new Player();
        $gameState = GameState::create(json_decode($gameStateJson, true));

        $bet = $player->betRequest($gameState);

        $this->assertSame(240, $bet);
    }
}
