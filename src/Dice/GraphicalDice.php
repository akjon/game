<?php

declare(strict_types=1);

namespace joka20\Dice;

/**
 * Class GraphicalDice
 */
class GraphicalDice extends Dice
{
    public array $graphicalFaces = [1 =>
    // "⚀",
    // "⚁",
    // "⚂",
    // "⚃",
    // "⚄",
    // "⚅"
        "/img/dice-1.png",
        "/img/dice-2.png",
        "/img/dice-3.png",
        "/img/dice-4.png",
        "/img/dice-5.png",
        "/img/dice-6.png",
    ];

    public function getGraphicalDie(): array
    {
        return $this->graphicalFaces;
    }
}
