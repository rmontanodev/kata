<?php

namespace tests\MarsRover;

use App\MarsRover\MarsRover;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\ObjectReflector\InvalidArgumentException;

require_once 'src/MarsRover/Movible.php';
require_once 'src/MarsRover/MarsRover.php';

class MarsRoverTest extends TestCase
{
    private function createMarsRover(): MarsRover
    {
        return new MarsRover();
    }
    public function testInitialPosition()
    {
        $marsRover = $this->createMarsRover();
        $this->assertEquals('0:0:N', $marsRover->execute(''));
    }

    public function testMoveForward()
    {
        $marsRover = $this->createMarsRover();
        $this->assertEquals('0:1:N', $marsRover->execute('M'));
        $marsRover = $this->createMarsRover();
        $this->assertEquals('0:2:N', $marsRover->execute('MM'));
    }

    public function testTurnLeft()
    {
        $marsRover = $this->createMarsRover();
        $this->assertEquals('0:0:W', $marsRover->execute('L'));
    }

    public function testTurnRight()
    {
        $marsRover = $this->createMarsRover();
        $this->assertEquals('0:0:E', $marsRover->execute('R'));
    }

    public function testComplexCommands()
    {
        $marsRover = $this->createMarsRover();
        $this->assertEquals('2:1:N', $marsRover->execute('RMMLM'));
        $marsRover = $this->createMarsRover();
        $this->assertEquals('2:3:N', $marsRover->execute('MMRMMLM'));
        $marsRover = $this->createMarsRover();
        $this->assertEquals('0:0:N', $marsRover->execute('MMMMMMMMMM'));
    }
    public function testInvalidCommand()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid command: X");

        $marsRover = $this->createMarsRover();
        $marsRover->execute('X');
    }


}