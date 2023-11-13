<?php

declare(strict_types=1);


namespace App\MarsRover;

use SebastianBergmann\ObjectReflector\InvalidArgumentException;

require_once 'Movible.php';

class MarsRover implements Movible
{

    private const DIRECTIONS = ['N', 'E', 'S', 'W'];
    private const GRID_SIZE = 10;

    private int $x;
    private int $y;
    private string $direction;
    private int $directionLength;

    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->direction = self::DIRECTIONS[0];// Inicializa la dirección a 'N'
        $this->directionLength = count(self::DIRECTIONS);
    }

    public function execute(string $commands): string
    {
        foreach (str_split($commands) as $command) {
            $this->processCommand($command);
        }

        return "{$this->x}:{$this->y}:{$this->direction}";
    }

    private function processCommand(string $command): void
    {
        if ($command !== '') {
            match ($command) {
                'L' => $this->turnLeft(),
                'R' => $this->turnRight(),
                'M' => $this->move(),
                default => throw new InvalidArgumentException("Invalid command: $command")/* Handle invalid command */
            };
        }
    }

    private function turnLeft(): void
    {
        $currentDirectionIndex = array_search($this->direction, self::DIRECTIONS);
        $this->direction = self::DIRECTIONS[($currentDirectionIndex - 1 + $this->directionLength) % $this->directionLength];
    }

    private function turnRight(): void
    {
        $currentDirectionIndex = array_search($this->direction, self::DIRECTIONS);
        $this->direction = self::DIRECTIONS[($currentDirectionIndex + 1) % $this->directionLength];
    }

    private function move(): void
    {
        match ($this->direction) {
            'N' => $this->y = ($this->y + 1) % self::GRID_SIZE,
            'E' => $this->x = ($this->x + 1) % self::GRID_SIZE,
            'S' => $this->y = ($this->y - 1 + self::GRID_SIZE) % self::GRID_SIZE,
            'W' => $this->x = ($this->x - 1 + self::GRID_SIZE) % self::GRID_SIZE
        };
    }
}