<?php

include_once 'src/BowlingGame.php';

class BowlingGameTest extends PHPUnit_Framework_TestCase {
	
	private $game;

	public function setUp(){
		$this->game = new BowlingGame();
	}

	public function testStartHere(){
		$this->fail('');
	}
}