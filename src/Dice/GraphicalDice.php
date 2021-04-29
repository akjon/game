<?php

declare(strict_types=1);

namespace joka20\Dice;

use function Mos\Functions\url;
/**
 * Class GraphicalDice
 */
class GraphicalDice extends diceHand
{
    const FACES = [
        "/img/dice-1.png",
        "/img/dice-2.png",
        "/img/dice-3.png",
        "/img/dice-4.png",
        "/img/dice-5.png",
        "/img/dice-6.png",
    ];
    
    public function __construct()
    {
       parent::__construct(6);
    }

    public function diceGraphics(): void
    {
        ?>
        <img src="<?= url(self::FACES[$this->getDice()]) ?>" alt="apa">
        <?php
    }
}