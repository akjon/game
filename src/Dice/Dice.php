<?php

declare(strict_types=1);

namespace joka20\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class Dice.
 */
class Dice
{
    public $faces = 6;

    private ?int $roll = 0;

    public function roll(): ?int
    {
        $this->roll = rand(1, $this->faces);

        return $this->roll;
    }

    public function getLastSum(): ?int
    {
        return $this->roll;
    }
}
