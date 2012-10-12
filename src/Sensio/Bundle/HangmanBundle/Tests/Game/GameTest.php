<?php

namespace Sensio\Bundle\HangmanBundle\Tests\Game;

use Sensio\Bundle\HangmanBundle\Game\Game;

class GameTest extends \PHPUnit_Framework_TestCase
{
	public function testTryCorrectWord()
	{
		$game = new Game('php');
		$this->assertTrue($game->tryWord('php'));
		$this->assertTrue($game->isWon('php'));
		$this->assertTrue($game->isOver());
		$this->assertFalse($game->isHanged('php'));
	}

	public function testTryWrongWord()
	{
		$game = new Game('php');
		$game->tryWord('ruby');
		$this->assertTrue($game->isOver());
		$this->assertEquals(0,$game->getRemainingAttempts());
	}

	public function testTryCorrectLetter()
	{ 
		$game = new Game('php');
		$this->assertTrue($game->tryLetter('P'));
		$this->assertTrue($game->isLetterFound('P'));
		$this->assertContains('p', $game->getFoundLetters());
		$this->assertContains('p', $game->getTriedLetters());
		$this->assertEquals(0, $game->getAttempts());
	}

	public function testTryWrongLetter()
	{ 
		$game = new Game('php');
		$this->assertFalse($game->tryLetter('x'));
		$this->assertFalse($game->isLetterFound('x'));
		$this->assertContains('x', $game->getFoundLetters());
		$this->assertContains('x', $game->getTriedLetters());
		$this->assertEquals(1, $game->getAttempts());
	}
	
    
}
