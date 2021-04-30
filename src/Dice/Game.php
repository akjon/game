<?php

declare(strict_types=1);


namespace joka20\Dice;

use function Mos\Functions\{renderView, sendResponse, url};

/**
 * Class Game.
 */
class Game
{
    private int $lastRoll;
    private int $currentScore;
    private string $roll;

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

        $diceHand = new DiceHand($_POST["roll"]);
        $diceHand->roll();

        $data["lastDice"] = $diceHand->getDice();
        $data["diceHandSum"] = $diceHand->getLastSum();

        $this->lastRoll = $diceHand->getLastSum();
        $this->currentScore = $_SESSION["score"] ?? 0;
        $this->roll = $_POST["roll"] ?? null;

        if ($this->currentScore + $this->lastRoll === 21) {
            var_dump("21 congrats!");
        } else if ($this->currentScore + $this->lastRoll > 21) {
            var_dump("Fat loser");
            $this->roboRoll();
        } elseif ($this->roll === "stay") {
            var_dump("STAY");
            $this->roboRoll();
        }

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function roboRoll()
    {
        $cpuHand = new DiceHand(1);
        $cpuHand->roll();
        $roboScore = $cpuHand->getLastSum();

        while ($roboScore < 17) {
            var_dump($roboScore);
            $roboScore += $cpuHand->getLastSum();
            var_dump($roboScore);
            $cpuHand->roll();
            if ($roboScore > 21) {
                var_dump("Human wins");
            } elseif ($roboScore === 21) {
                var_dump("Robot won by rolling 21");
            }
        }
        if ($roboScore > $this->currentScore) {
            var_dump("Robot wins");
        } else {
            var_dump("Human wins");
        }
    }
}
