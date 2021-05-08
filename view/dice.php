<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$url = url("/dice/reset");
$action = $action ?? null;
$_SESSION["scores['Human']"] = $_SESSION["scores['Human']"] ?? 0;
$_SESSION["scores['Robot']"] = $_SESSION["scores['Robot']"] ?? 0;
$_SESSION["humanScore"] = $_SESSION["humanScore"] ?? 0;
$_SESSION["die1"] = $_SESSION["die1"] ?? "";
$_SESSION["die2"] = $_SESSION["die2"] ?? ""; 
$die1 = url($_SESSION["die1"]);
$die2 = url($_SESSION["die2"]);
$_SESSION["lastDice"] = $_SESSION["lastDice"] ?? null; 

?><h1>Play 21</h1>
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

<p><?= "Current hand sum = " . $_SESSION["humanScore"] ?></p>
<p><?= "Previous hands: " . $_SESSION["lastDice"] ?></p>
<p><?= $_SESSION["message"] ?? null ?></p>
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
<a href="<?= $url ?>">Reset score</a>
