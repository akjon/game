<?php

declare(strict_types=1);

namespace joka20\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private $diceAmount;
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

    public function getLastSum(): int
    {
        return $this->roll;
    }

    public function getDice(): string
    {
        $res = '';
        for ($i = 0; $i < $this->diceAmount; $i++) {
            $res .= $this->dices[$i]->getLastSum() . ' ';
        }
        return $res;
    }
}
