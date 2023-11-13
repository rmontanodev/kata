<?php

namespace tests\MarsRover;

use App\MarsRover\MarsRover;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\ObjectReflector\InvalidArgumentException;

require_once 'src/MarsRover/Movible.php';
require_once 'src/MarsRover/MarsRover.php';

class MarsRoverTest extends TestCase
{
    public function testInitialPosition()
    {
        $marsRover = new MarsRover();
        $this->assertEquals('0:0:N', $marsRover->execute(''));
    }

    public function testMoveForward()
    {
        $marsRover = new MarsRover();
        $this->assertEquals('0:1:N', $marsRover->execute('M'));
        $marsRover = new MarsRover();
        $this->assertEquals('0:2:N', $marsRover->execute('MM'));
    }

    public function testTurnLeft()
    {
        $marsRover = new MarsRover();
        $this->assertEquals('0:0:W', $marsRover->execute('L'));
    }

    public function testTurnRight()
    {
        $marsRover = new MarsRover();
        $this->assertEquals('0:0:E', $marsRover->execute('R'));
    }

    public function testComplexCommands()
    {
        $marsRover = new MarsRover();
        $this->assertEquals('2:1:N', $marsRover->execute('RMMLM'));
        $marsRover = new MarsRover();
        $this->assertEquals('2:3:N', $marsRover->execute('MMRMMLM'));
        $marsRover = new MarsRover();
        $this->assertEquals('0:0:N', $marsRover->execute('MMMMMMMMMM'));
    }
    public function testInvalidCommand()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid command: X");

        $marsRover = new MarsRover();
        $marsRover->execute('X');
    }


}