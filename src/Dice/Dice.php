<?php

declare(strict_types=1);

namespace joka20\Dice;

/**
 * Class Dice.
 */
class Dice
{
    public int $faces = 6;
    private ?int $roll;

    public function roll(): ?int
    {
        $this->roll = rand(1, intval($this->faces));

        return $this->roll;
    }

    public function setFaces($faces): void
    {
        $this->faces = $faces;
    }

    public function getLastSum(): ?int
    {
        return $this->roll;
    }
}
