<?php

declare(strict_types=1);

namespace joka20\Dice;

use function Mos\Functions\{renderView, sendResponse, url};

/**
 * Class Game.
 */
class Game
{
    private string $roll;
    private int $lastRoll;
    private int $humanScore = 0;
    private int $roboScore = 0;
    private array $data = [];

    public function __construct()
    {
        $this->data = [
            "header" => "Play 21",
            "message" => "Choose how many dice to roll.",
            "action" => url("/dice"),
        ];
    }

    public function initGame(): void
    {
        $_SESSION["scores"] ?? null;
        $_SESSION["scores['Human']"] = 0;
        $_SESSION["scores['Robot']"] = 0;
        $body = renderView("layout/dice.php", $this->data);
        sendResponse($body);
    }

    public function playGame(): void
    {
        $this->data["message"] = "Roll again?";
        $this->humanRoll();
        $this->humanScore = $_SESSION["humanScore"] ?? 0;

        if ($this->humanScore === 21) {
            $this->roboRoll();
            $this->data["resultMessage"] = "You rolled 21 and robot rolled " . $this->roboScore . ". Roll again to play another round.";
            $this->data["header"] = "Congratulations you hit 21!";
            $this->gameOver();
            $this->score();
        } else if ($this->humanScore > 21) {
            $this->data["resultMessage"] = "Human is fat at " . ($this->humanScore) . ". Roll again to play another round.";
            $this->gameOver();
            $this->score();
        } elseif ($this->roll == 0) {
            $this->roboRoll();
            $this->data["resultMessage"] = "Human stayed at " . $this->humanScore . ", robot got " . $this->roboScore . ". Roll again to play another round.";
            $this->gameOver();
            $this->score();
        }

        $body = renderView("layout/dice.php", $this->data);
        sendResponse($body);
    }

    public function humanRoll(): void
    {
        $humanHand = new DiceHand($_POST["roll"]);
        $humanHand->roll();
        $graphicalDie1 = new GraphicalDice();
        $graphicalDie2 = new GraphicalDice();

        $this->data["lastDice"] = $humanHand->getDice();
        $this->data["diceHandSum"] = $humanHand->getLastSum();

        $this->lastRoll = $humanHand->getLastSum();
        $this->roll = $_POST["roll"] ?? null;
        $_SESSION["humanScore"] = $this->lastRoll + ($_SESSION["humanScore"] ?? 0);

        $die1 = intval($this->data["lastDice"][0] ?? 0);
        $die2 = intval($this->data["lastDice"][2] ?? 0);

        $_SESSION["die1"] = $graphicalDie1->getGraphicalDie()[$die1] ?? null;
        $_SESSION["die2"] = $graphicalDie2->getGraphicalDie()[$die2] ?? null;
    }

    public function roboRoll(): void
    {

        $roboHand = new DiceHand(1);
        $roboHand->roll();
        $this->roboScore = $roboHand->getLastSum();

        while ($this->roboScore < 17) {
            $this->roboScore += $roboHand->getLastSum();
            $roboHand->roll();
        }
    }

    public function gameOver(): void
    {
        $human = $this->humanScore;
        $robot = $this->roboScore;

        if ($human > $robot && $human <= 21) {
            $_SESSION["scores['Human']"] = 1 + ($_SESSION["scores['Human']"] ?? 0);
            $this->data["message"] = "Human wins!";
        } else if ($robot > 21 && $human <= 21) {
            $_SESSION["scores['Human']"] = 1 + ($_SESSION["scores['Human']"] ?? 0);
            $this->data["message"] = "Human wins!";
        } else if ($human >= 21 && $robot <= 21) {
            $_SESSION["scores['Robot']"] = 1 + ($_SESSION["scores['Robot']"] ?? 0);
            $this->data["message"] = "Robot wins!";
        } else if ($robot > $human && $robot <= 21 || $robot == $human) {
            $_SESSION["scores['Robot']"] = 1 + ($_SESSION["scores['Robot']"] ?? 0);
            $this->data["message"] = "Robot wins!";
        }
    }

    public function score(): void
    {
        $_SESSION["humanScore"] = 0;
    }

    public function resetScores(): void
    {
        $_SESSION["scores['Human']"] = 0;
        $_SESSION["scores['Robot']"] = 0;
    }


}
