<?php

declare(strict_types=1);


namespace joka20\Dice;

use function Mos\Functions\{renderView, sendResponse, url};

/**
 * Class Game.
 */
class Game
{
    public function initGame(): void
    {
        $data = [
            "header" => "Play 21",
            "message" => "Choose how many dice to roll.",
            "action" => url("/dice"),
        ];

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function playGame(): void
    {
        $data = [
            "header" => "Play 21",
            "message" => "Roll again or stay?",
            "action" => url("/dice"),
        ];

        $die = new Dice();
        $die->roll();
        $diceHand = new DiceHand($_POST["dice"]);
        $diceHand->roll();

        $data["lastDice"] = $diceHand->getDice();
        $data["diceHandSum"] = $diceHand->getLastSum();
        // $diceHand->roll();

        // $data["diceHandRoll2"] = $diceHand->getLastRoll();
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}
