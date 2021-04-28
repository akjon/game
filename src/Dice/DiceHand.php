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
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private int $roll;
    public function __construct($amount = 0)
    {
        $this->diceAmount = $amount;

        for ($i = 0; $i < $this->diceAmount; $i++) {
            $this->dices[$i] = new Dice();
        }
    }
    public function roll(): void
    {

        $this->roll = 0;
        for ($i = 0; $i < $this->diceAmount; $i++) {
            $this->roll += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
