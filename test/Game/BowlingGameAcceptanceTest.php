<?php

namespace Game;

class BowlingGameAcceptanceTest extends \PHPUnit_Framework_TestCase {
	
	private $game;

	public function setUp(){
		$this->game = new BowlingGame();
	}

	public function testPerfectGame(){
		for($i = 0; $i < 12; $i++){
			$this->game->bowl(10);
		}

		$this->assertEquals(300, $this->game->getScore());
	}

	public function testAllSpares(){
		for($i = 0; $i < 10; $i++){
			$this->game->bowl(9);
			$this->game->bowl(1);
		}
			$this->game->bowl(9);
		$this->assertEquals(190, $this->game->getScore());	
	}

	public function testNoSpares(){
		for($i = 0; $i < 10; $i++){
			$this->game->bowl(8);
			$this->game->bowl(1);
		}
		$this->assertEquals(90, $this->game->getScore());	
	}


	public function testAllGutterBalls(){
		for($i = 0; $i < 20; $i++){
			$this->game->bowl(0);
		}

		$this->assertEquals(0, $this->game->getScore());
	}

	public function testThrowsExceptionIfScoreIsAbove10(){
		try{
			$this->game->bowl(11);
			$this->fail('Should have thrown an exception');
		}catch(\Exception $e){
			$this->assertEquals("Illegal Throw", $e->getMessage());
		}
	}

	public function testThrowsExceptionIfScoreIsBelowZero(){
		try{
			$this->game->bowl(-1);
			$this->fail('Should have thrown an exception');
		}catch(\Exception $e){
			$this->assertEquals("Illegal Throw", $e->getMessage());
		}
	}

	public function testThrowsExceptionIfConsecutiveThrowsAreAbove10(){
		try{
			$this->game->bowl(7);
			$this->game->bowl(7);
			$this->fail('Should have thrown an exception');
		}catch(\Exception $e){
			$this->assertEquals("Illegal Throw", $e->getMessage());
		}
	}

	public function testDoesNotThrowExceptionIfConsecutiveThrowsAreAbove10OnDifferentFrames(){
		try{
			$this->game->bowl(10);
			$this->game->bowl(7);
			$this->game->bowl(3);
		}catch(\Exception $e){
			$this->fail('Should not have thrown an exception');
		}
	}

	public function testARealisticBowlingGame(){
		$scores = array(2,6,10,9,0,9,1,10,2,6,8,2,10,9,0,0,10,1);

		foreach($scores as $score){
			$this->game->bowl($score);
		}

		$this->assertEquals(141, $this->game->getScore());
	}

	public function testAllSparesAllDifferent(){
		$scores = array(9,1,8,2,7,3,6,4,5,5,4,6,3,7,2,8,1,9,0,10,0);

		foreach($scores as $score){
			$this->game->bowl($score);
		}

		$this->assertEquals(136, $this->game->getScore());
	}
}