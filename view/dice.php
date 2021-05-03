<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$url = url("/dice/destroy");
$header = $header ?? null;
$message = $message ?? "";
$resultMessage = $resultMessage ?? "<br>";
$action = $action ?? null;
$lastDice = $lastDice ?? null;
$humanScore = $humanScore ?? 0;
$_SESSION["scores[]"] = $_SESSION["scores[]"] ?? null;
$_SESSION["humanScore"] = $_SESSION["humanScore"] ?? 0;
$_SESSION["die1"] = $_SESSION["die1"] ?? "";
$_SESSION["die2"] = $_SESSION["die2"] ?? "";
$die1 = url($_SESSION["die1"]);
$die2 = url($_SESSION["die2"]);

?><h1><?= $header ?></h1>
<div class="dice">
    <?php if (strlen($die1) < 45) : ?>
        <img src="<?= url("/img/dice-1.png") ?>" alt="">
        <img src="<?= url("/img/dice-6.png") ?>" alt="">
    <?php endif; ?>

    <?php if (strlen($die1) > 45) : ?>
        <img src="<?= $die1 ?>" alt="">
        <img src="<?= $die2 ?>" alt="">
    <?php endif; ?>
</div>
<h4>Human: <?= $_SESSION["scores['Human']"] . " - " . "Robot: " . $_SESSION["scores['Robot']"] ?? null ?></h4>

<p><?= "Current score: " . $_SESSION["humanScore"] ?></p>
<p><?= $message ?></p>
<p><?= $resultMessage ?></p>
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
<br>

<a href="<? $url ?>">Reset score</a>