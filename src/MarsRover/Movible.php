<?php

declare(strict_types=1);


namespace App\MarsRover;

interface Movible
{
    public function execute(string $commands): string;
}