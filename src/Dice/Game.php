<?php

declare(strict_types=1);

namespace joka20\Dice;

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

    public function initGame(): void
    {
        $_SESSION["message"] = "Choose how many dice to roll.<br><br>";
    }

    public function playGame(): void
    {
        $_SESSION["message"] = "Roll again or stay?<br><br>";
        $this->humanRoll();
        $this->humanScore = $_SESSION["humanScore"] ?? 0;

        if ($this->humanScore === 21) {
            $this->roboRoll();
            $_SESSION["message"] = "<strong>Congratulations!</strong> You rolled 21, robot rolled " . $this->roboScore;
            $this->gameOver();
            $this->score();
        } else if ($this->humanScore > 21) {
            $_SESSION["message"] = "Human is fat at " . ($this->humanScore);
            $this->gameOver();
            $this->score();
        } elseif ($this->roll == 0) {
            $this->roboRoll();
            $_SESSION["message"] = "Human stayed at " . $this->humanScore . ", robot got " . $this->roboScore;
            $this->gameOver();
            $this->score();
        }
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
        $_SESSION["lastDice"] .= " " . $this->lastRoll;

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

        if ($human > $robot && $human <= 21 || $robot > 21 && $human <= 21) {
            $_SESSION["scores['Human']"] = 1 + ($_SESSION["scores['Human']"] ?? 0);
            $_SESSION["message"] .= " - <strong>Human wins!</strong><br>Roll again to play another round.";
        } else if ($human >= 21 && $robot <= 21 || $robot > $human && $robot <= 21 || $robot == $human) {
            $_SESSION["scores['Robot']"] = 1 + ($_SESSION["scores['Robot']"] ?? 0);
            $_SESSION["message"] .= " - Robot wins!<br>Roll again to play another round.";
        }
    }

    public function score(): void
    {
        $_SESSION["humanScore"] = 0;
        $_SESSION["lastDice"] = "";
    }
}
