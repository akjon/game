<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$url = url("/session/destroy");
$header = $header ?? null;
$message = $message ?? null;
$resultMessage = $resultMessage ?? null;
$action = $action ?? null;
$lastDice = $lastDice ?? null;
$humanScore = $humanScore ?? 0;
// $game = $_SESSION["game"] ?? null;
$_SESSION["scores[]"] = $_SESSION["scores[]"] ?? null;
$_SESSION["humanScore"] = $_SESSION["humanScore"] ?? 0;

?><h1><?= $header ?></h1>


<div class="choices">
    <form action="<?= $action ?>" class="button" method="POST">
        <input type="hidden" name="roll" value="1">
        <button type="submit">Roll one</button>
    </form>
    <form action="<?= $action ?>" class="button" method="POST">
        <input type="hidden" name="roll" value="2">
        <button type="submit">Roll two</button>
    </form>
    <form action="<?php $action ?>" class="button" method="POST">
        <input type="hidden" name="roll" value="0">
        <button type="submit">Stay</button>
    </form>
    <br>
</div>
<p><?= $resultMessage ?></p>
<p><strong><?= $message ?></strong></p>
<div>
        <h3>Dice rolled</h3>
        <p><?= $lastDice . "<br>Current score: " . $_SESSION["humanScore"] ?></p>

        <h4>
        Human: <?= $_SESSION["scores['Human']"] . " - " . "Robot: " . $_SESSION["scores['Robot']"] ?? null ?>
        </h4>
        <br>
</div>
<?php
echo <<<EOD
<?php><a href="$url">destroy the session</a></?php>
EOD;;