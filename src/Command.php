<?php
require_once 'MarsRover/MarsRover.php';

use App\MarsRover\MarsRover;

// Example usage:
$marsRover = new MarsRover();
$result = $marsRover->execute('MMRMMLM');
echo $result;  // Output: 2:3:N
